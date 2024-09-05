<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\RegisteredUser;

use Illuminate\Support\Facades\Notification;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_purchases = array();
        $purchases = DB::table('purchases')->select('id', 'user_id')->orderByDesc('created_at')->get();
        foreach ($purchases as $p) {
            $user = User::findOrFail($p->user_id);

            $purchase = $user->services()->having('pivot_id', $p->id)->first();

            $purchase["user_name"] = $user->name;
            array_push($all_purchases, (Object) $purchase );
        };

        $response = [
            'purchases' => $all_purchases,
        ];
        return response($response, 201); 
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
        //return gettype($service->debit);

        try {
            if($user->role_id != 2) {
                return response([
                    'errors' => "Only client can make purchase. not Admin",
                ], 422);
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
                    return response([
                        'errors' => 'Only users registered with the loyalty program can make a payment by points.',
                    ], 422);
                } else {
                    $new_balance = $user->balance - $service->debit;

                    // check if user cant pay service with his balance
                    if($new_balance < 0) {
                        return response([
                            'errors' => 'Your balance is insuffisant.',
                        ], 422);
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
            // return $new_balance;
            $user->balance = $new_balance;
            $user->save();
            
            if($message == '') {
                $message = 'Purchase successfully saved.';
            }

            $admins = User::allAdmin()->get();
            $response = [
                'message' => $message.' The user new balance is '.$user->balance,
                'admins' => $admins
            ];

            if($new_registered_user) {
                $user->notify(new RegisteredUser($user, $service));
                Notification::sendNow($admins, new RegisteredUser($user, $service));
            }
            // $user->notify(new SuccessfulPurchase($service));
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
    public function allServicesOfUser($user_id)
    {
        $user = User::findOrFail($user_id);
        if($user->services()->exists()) {
            $user_services = $user->services()->orderBy('created_at', 'desc')->paginate(10);

            foreach ($user_services as $s) {
                $s["user_name"] = $user->name;
            }
            $response = [
                'services' => (Object) $user_services,
            ];
            return response($response, 201);
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
    public function allUsersOfService($service_id)
    {
        $service = Service::findOrFail($service_id);
        if( $service->users()->exists() ) {
            $service_users = $service->users()->orderBy('created_at', 'desc')->paginate(10);
            
            foreach ($service_users as $s) {
                $s["service_name"] = $service->name;
            }
            $response = [
                'users' => (Object) $service_users,
            ];
            return response($response, 201);
        } else {
            return response([
                'errors' => 'The service '.$service->name.' has not been purchased by any user.',
            ], 422);
        }
    }
}

