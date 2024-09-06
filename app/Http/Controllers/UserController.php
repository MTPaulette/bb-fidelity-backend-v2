<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\CreatedUser;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'by', 'order', 'q', 'is_registered', 'date'
        ]);
        if($request->has('no_pagination')) {
            $users =  User::filter($filters)->get();
        } else {
            $users = User::filter($filters)->paginate(10);
        }
        
        if(sizeof($users) == 0) {
            return response([
                'errors' => 'No result.',
            ], 422);
        } else {
            $response = [
                'users' => $users,
            ];
            return response($response, 201);
        }

    }
    
    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $response = [
            'user' => $user,
        ];
        return response($response, 201);
    }

    /**
     * Display the specified id resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function recent()
    {
        $recent_user_id = User::orderByDesc('id')->get('id')->first();
        return response($recent_user_id, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'balance' => 'numeric|min:0',
            'is_registered' => 'boolean',
        ]);

        if($validator->fails()){
            \LogActivity::addToLog("User creation failed.<br/>".$validator->errors());
            return response([
                'errors' => $validator->errors(),
            ], 500);
        }

        $user = User::create($validator->validated());

        $user = User::where('email', $request->email)->first();

        if($request->has('role_id')) {
            $user->role_id = $request->role_id;
        } else {
            $user->role_id = 2; //2 for role client
        }

        $user->user_id = $request->user()->id;
        $user->save();
        $response = [
            'user_id' => $user->id,
            'message' => 'The user '.$user->name.' account successfully created',
        ];

        \LogActivity::addToLog('New user created.<br/> User name: '.$user->name);

        /*sending notification email */
        $admins = User::allAdmin()->get();
        $user->notify(new CreatedUser($user, $request->password, $user));
        foreach($admins as $admin) {
            $admin->notify(new CreatedUser($user, $request->password, $admin));
        }
        return response($response, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $messageLog = '';
        $new_balance = 0;
        $user = User::findOrFail($request->id);

        $validator = Validator::make($request->all(),[
            'is_registered' => 'boolean',
            'point' => 'numeric|min:0',
            'malus' => 'boolean'
        ]);

        if($validator->fails()){
            \LogActivity::addToLog("User update failed.<br/> User name: ".$user->name."<br/>".$validator->errors());
            return response([
                'errors' => $validator->errors(),
            ], 500);
        }

        if($request->has("point")) {
            if($request->malus) {
                $new_balance = $user->balance - $request->point;
                if($user->balance < 0) {
                    $new_balance = 0;
                }
            }   else {
                $new_balance = $user->balance + $request->point;
            }

            if($new_balance != $user->balance) {
                $messageLog = " | Old balance: ".$user->balance.", New balance: ".$new_balance;
            }
            $user->balance = $new_balance;
        }
        if($request->has("is_registered")) {
            if($request->is_registered != $user->is_registered) {
                if($request->is_registered) {
                    $messageLog = $messageLog.' | Registered user to the bb-fidelity program.';
                } else {
                    $messageLog = $messageLog.' | Unregistered user to the bb-fidelity program.';
                }
            }
            $user->is_registered = $request->is_registered;
        }
        $user->update();
        $response = [
            'message' => "$user->name, 's informations updated.",
        ];
        \LogActivity::addToLog("User updated.<br/> User name: ".$user->name." ".$messageLog);
        return response($response, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $authenticated_user = $request->user();
        if (! Hash::check($request->password, $authenticated_user->password)) {
            $response = [
                'password' => 'Wrong password.'
            ];
            return response($response, 422);
        }
 
        $user = User::findOrFail($request->id);

        if($authenticated_user->role_id != 3) {
            if($user->role_id == 3) {
                $response = [
                    'error' => 'Only superadmin can delete another one',
                ];
                return response($response, 422);
            } else if($user->role_id == 1) {
                $response = [
                    'error' => 'Only superadmin can delete an admin',
                ];
                return response($response, 422);
            }
        }

        // check if the user has already been buy a service
        if( $user->services()->exists() ) {
            $response = [
                'error' => 'The user '.$user->name.' has already been maked purchase. You can not delete it',
            ];
            return response($response, 422);
        } else {
            $user->delete();
            $response = [
                'message' => "User successfully deleted",
            ];

            \LogActivity::addToLog('User '.$user->name.' deleted');
            return response($response, 201);
        }
    }
}
