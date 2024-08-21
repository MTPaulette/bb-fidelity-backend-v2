<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('no_pagination')) {
            $users =  User::orderBy('name', 'asc')->get();
        } else {
            $users = User::orderBy('name', 'asc')->paginate(10);
        }

        $response = [
            'users' => $users,
        ];
        return response($response, 201);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'point' => 'required|numeric',
            'password' => 'required|string',
        ]);

        if($validator->fails()){
            return response([
                'errors' => $validator->errors(),
            ], 500);
        }
        
        if( $request->point < 0 ) {
            $response = [
                'error' => 'Point must be a positive number.',
            ];
            return response($response, 500);
        }

        $auth = $request->user();
        if (! Hash::check($request->password, $auth->password)) {
            $response = [
                'password' => 'Wrong password.'
            ];
            return response($response, 422);
        }

        $user = User::findOrFail($request->id);
        if($request->point) {
            if($request->malus) {
                $user->balance = $user->balance - $request->point;
            }else {
            $user->balance = $user->balance + $request->point;
            }
        }
        $user->update();
        $response = [
            'message' => "user's point updated",
        ];

        return response($response, 201);
    }
}
