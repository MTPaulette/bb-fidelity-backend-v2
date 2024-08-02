<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $user = User::find($p->user_id);

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
        $service = Service::find($request->service_id);
        $user = User::find($request->user_id);
        // $admin_id = $request->admin_id;
        $admin_id = $request->user()->id;
        $by_cash = $request->by_cash;

        $new_balance = 0;

        try {
            if($user->role_id == 1) {
                return response([
                    'errors' => "Only client can make purchase. not Admin",
                ], 422);
            }
            if($by_cash) {
                $new_balance = $user->balance + $service->credit;
                $user->services()->attach($service, [
                    'by_cash' => true, 
                    'credit ' => $service->credit, 
                    'debit ' => 0, 
                    'user_balance' => $new_balance, 
                    'admin_id' => $admin_id
                ]);
            } else {
                $new_balance = $user->balance - $service->debit;

                // check if user cant pay service with his balance
                if($new_balance < 0) {
                    return response([
                        'message' => 'Your balance is insuffisant.',
                    ], 422);
                } else {
                    $user->services()->attach($service, [
                        'by_cash' => false, 
                        'credit' => 0,
                        'debit ' => $service->debit, 
                        'user_balance' => $new_balance, 
                        'admin_id' => $admin_id
                    ]);
                }
            }

            $user->balance = $new_balance;
            $user->update();

            $response = [
                'message' => 'Purchase successfully saved.'
            ];

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
        $purchase = DB::table('purchases')->select('user_id')->find($id);
        $user = User::find($purchase->user_id);


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
        $user = User::find($user_id);
        // return $user;
        if($user->services()->exists()) {
            $user_services = $user->services()->orderBy('created_at', 'desc')->get();

            foreach ($user_services as $s) {
                $s["user_name"] = $user->name;
            }
            $response = [
                'services' => (Object) $user_services,
            ];
            return response($response, 201);
        } else {
            return response([
                'errors' => 'This user has not yet made a purchase of services.',
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
        $service = Service::find($service_id);
        if( $service->users()->exists() ) {
            $service_users = $service->users()->orderBy('created_at', 'desc')->get();
            
            foreach ($service_users as $s) {
                $s["service_name"] = $service->name;
            }
            $response = [
                'users' => (Object) $service_users,
            ];
            return response($response, 201);
        } else {
            return response([
                'errors' => 'This service has not been purchased by any user.',
            ], 422);
        }
    }
}

