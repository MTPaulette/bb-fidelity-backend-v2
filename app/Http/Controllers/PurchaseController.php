<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\RegisteredUser;
use App\Notifications\PurchaseMade;
use App\Notifications\PurchaseFailed;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    protected $sortable = [
        'user_name', 'service_name', 'price', 'credit', 'debit', 'user_balance', 'validity', 'agency', 'admin_name', 'created_at',
    ];

    public function purchaseQuery()
    {
        return DB::table('purchases')
        ->join('users', 'purchases.user_id', '=', 'users.id')
        ->join('users as users_1', 'purchases.admin_id', '=', 'users_1.id')
        ->join('services', 'purchases.service_id', '=', 'services.id')
        ->select('purchases.*', 'users.name as user_name', 'users.balance as user_current_balance', 'users_1.name as admin_name', 'services.name as service_name', 'services.price as price', 'services.validity as validity', 'services.agency as agency', 'services.service_type as service_type');
    }

    public function index(Request $request)
    {
        $filters = $request->only([
            'agency', 'validity', 'service_type', 'by', 'order', 'q', 'date'
        ]);

        $purchases = $this->purchaseQuery()
                        ->when(
                            $filters['agency'] ?? false,
                            fn ($query, $value) => $query->where('agency', '=', $value)
                        )->when(
                            $filters['validity'] ?? false,
                            fn ($query, $value) => $query->where('validity', '=', $value)
                        )->when(
                            $filters['service_type'] ?? false,
                            fn ($query, $value) => $query->where('service_type', '=', $value)
                        )->when(
                            $filters['by'] ?? false,
                            fn ($query, $value) =>
                            !in_array($value, $this->sortable)
                                ? $query :
                                $query->orderBy($value, $filters['order'] ?? 'asc')
                        )
                        ->when(
                            $filters['q'] ?? false,
                            fn ($query, $value) => $query->where('users.name', 'LIKE', "%{$value}%")
                                                        ->orWhere('services.name', 'LIKE', "%{$value}%")
                        )->when(
                            $filters['date'] ?? false,
                            fn ($query, $value) => $query->whereDate('purchases.created_at', date('Y-m-d', strtotime($value)))
                        )->paginate(25);

        if(sizeof($purchases) == 0) {
            return response([
                'errors' => 'No result.',
            ], 422);
        } else {
            $response = [
                'filters' =>$filters,
                'purchases' => $purchases,
            ];
            return response($response, 201);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_registered_user = false;
        $service = Service::findOrFail($request->service_id);
        $user = User::findOrFail($request->user_id);
        $admin_id = $request->user()->id;
        $by_cash = $request->by_cash;

        $new_balance = 0;
        $message = '';
        $payment_mode = '';
        $admins = User::allAdmin()->get();
        //return gettype($service->debit);

        try {
            if($user->role_id != 2) {
                $response = [
                    'errors' => "Only client can make purchase. Not Admin",
                ];
                \LogActivity::addToLog("Purchase creation failed.<br/> Error: ".$response['errors']);

                /* send notification for purchase failed */ 
                $user->notify(new PurchaseFailed($user, $service, $user, $response['errors']));
                foreach($admins as $admin) {
                    $admin->notify(new PurchaseFailed($user, $service, $admin, $response['errors']));
                }
                return response($response, 422);
            }
            if($by_cash) {
                $payment_mode = 'by cash';
                $new_balance = $user->balance + $service->credit;
                $user->services()->attach($service, [
                    'by_cash' => true,
                    'credit' => doubleval($service->credit),
                    'debit ' => 0,
                    'user_balance' => $new_balance,
                    'admin_id' => $admin_id
                ]);

                if(!$user->is_registered) {
                    if($new_balance >= 50) {
                        $new_balance = $new_balance - 50;
                        $user->is_registered = true;
                        $new_registered_user = true;
                        $message= "Purchase successfully saved. This user is now registered with the loyalty program and can benefit from all the advantages offered by this program.";
                    }
                }

            } else {
                $payment_mode = 'by point';
                if(!$user->is_registered) {
                    $response = [
                        'errors' => "Only users registered with the loyalty program can make a payment by points.",
                    ];
                    \LogActivity::addToLog("Purchase creation failed.<br/> Error: ".$response['errors']);

                    /* send notification for purchase failed */
                    $user->notify(new PurchaseFailed($user, $service, $user, $response['errors']));
                    foreach($admins as $admin) {
                        $admin->notify(new PurchaseFailed($user, $service, $admin, $response['errors']));
                    }
                    return response($response, 422);
                } else {
                    $new_balance = $user->balance - $service->debit;

                    // check if user cant pay service with his balance
                    if($new_balance < 0) {
                        $response = [
                            'errors' => "The user balance is insuffisant.",
                        ];
                        \LogActivity::addToLog("Purchase creation failed.<br/> Error: ".$response['errors']);

                        /* send notification for purchase failed */
                        $user->notify(new PurchaseFailed($user, $service, $user, $response['errors']));
                        foreach($admins as $admin) {
                            $admin->notify(new PurchaseFailed($user, $service, $admin, $response['errors']));
                        }
            
                        return response($response, 422);
                    } else {
                        $user->services()->attach($service, [
                            'by_cash' => false,
                            'credit' => 0,
                            'debit' => doubleval($service->debit),
                            'user_balance' => $new_balance,
                            'admin_id' => $admin_id
                        ]);
                    }
                }
            }

            \LogActivity::addToLog('New purchase created.<br/> User name: '.$user->name.', Service name: '.$service->name. ',<br/> Payment mode: '.$payment_mode.', Old user balance: '.$user->balance.', New user balance: '.$new_balance);
            $user->balance = $new_balance;
            $user->save();
            
            if($message == '') {
                $message = 'Purchase successfully saved.';
            }

            $response = [
                'message' => $message.' The user new balance is '.$user->balance,
            ];

            /*sending notification email when new registered user */
            if($new_registered_user) {
                $user->notify(new RegisteredUser($user, $service, $user));
                foreach($admins as $admin) {
                    $admin->notify(new RegisteredUser($user, $service, $admin));
                }
            }

            /* send notification for success purchase */
            $user->notify(new PurchaseMade($user, $service, $user, $request->by_cash, $new_balance));
            foreach($admins as $admin) {
                $admin->notify(new PurchaseMade($user, $service, $admin, $request->by_cash, $new_balance));
            }

            return response($response, 201);

        } catch (\Throwable $th) {
            return $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchase = DB::table('purchases')->select('user_id')->findOrFail($id);
        $user = User::findOrFail($purchase->user_id);

        $purchase = $user->services()->having('pivot_id', $id)->first();

        $response = [
            'purchase' => $purchase,
            'user' => $user,
        ];
        return response($response, 201);
    }

    /**
     * Display all purchases of the specified user.
     *
     * @param $user_id
     * @return \Illuminate\Http\Response
     */
    public function allServicesOfUser($user_id, Request $request)
    {
        $filters = $request->only([
            'agency', 'validity', 'service_type', 'by', 'order', 'q', 'date'
        ]);

        $user = User::findOrFail($user_id);
        if($user->services()->exists()) {
            $purchases = $this->purchaseQuery()
                            ->when(
                                $filters['agency'] ?? false,
                                fn ($query, $value) => $query->where('agency', '=', $value)
                            )->when(
                                $filters['validity'] ?? false,
                                fn ($query, $value) => $query->where('validity', '=', $value)
                            )->when(
                                $filters['service_type'] ?? false,
                                fn ($query, $value) => $query->where('service_type', '=', $value)
                            )->when(
                                $filters['by'] ?? false,
                                fn ($query, $value) =>
                                !in_array($value, $this->sortable)
                                    ? $query :
                                    $query->orderBy($value, $filters['order'] ?? 'asc')
                            )->when(
                                $filters['date'] ?? false,
                                fn ($query, $value) => $query->whereDate('purchases.created_at', date('Y-m-d', strtotime($value)))
                            )
                            ->where('purchases.user_id', '=', $user_id)->paginate(25);

            if(sizeof($purchases) == 0) {
                return response([
                    'errors' => 'No result.',
                ], 422);
            } else {
                $response = [
                    'purchases' => $purchases,
                    'user_name' => $user->name
                ];
                return response($response, 201);
            }
        } else {
            return response([
                'errors' =>  'The user '.$user->name.' has not yet made a purchase of services.',
            ], 422);
        }
    }


    /**
     * Display all user of the specified purchase.
     *
     * @param $service_id
     * @return \Illuminate\Http\Response
     */
    public function allUsersOfService($service_id, Request $request)
    {
        $filters = $request->only([
            'agency', 'validity', 'service_type', 'by', 'order', 'q', 'date'
        ]);

        $service = Service::findOrFail($service_id);
        if( $service->users()->exists() ) {
            $purchases = $this->purchaseQuery()
                            ->when(
                                $filters['agency'] ?? false,
                                fn ($query, $value) => $query->where('agency', '=', $value)
                            )->when(
                                $filters['validity'] ?? false,
                                fn ($query, $value) => $query->where('validity', '=', $value)
                            )->when(
                                $filters['service_type'] ?? false,
                                fn ($query, $value) => $query->where('service_type', '=', $value)
                            )->when(
                                $filters['by'] ?? false,
                                fn ($query, $value) =>
                                !in_array($value, $this->sortable)
                                    ? $query :
                                    $query->orderBy($value, $filters['order'] ?? 'asc')
                            )->when(
                                $filters['date'] ?? false,
                                fn ($query, $value) => $query->whereDate('purchases.created_at', date('Y-m-d', strtotime($value)))
                            )
                            ->where('purchases.service_id', '=', $service_id)->paginate(25);

            if(sizeof($purchases) == 0) {
                return response([
                    'errors' => 'No result.',
                ], 422);
            } else {
                $response = [
                    'purchases' => $purchases,
                    'service_name' => $service->name
                ];
                return response($response, 201);
            }
        } else {
            return response([
                'errors' => 'The service '.$service->name.' has not been purchased by any user.',
            ], 422);
        }
    }

}

