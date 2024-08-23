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
            'is_registered' => 'boolean',
            'user_type' => 'string',
            'point' => 'numeric|min:0',
            'malus' => 'boolean'
        ]);

        if($validator->fails()){
            return response([
                'errors' => $validator->errors(),
            ], 500);
        }

        $user = User::findOrFail($request->id);
        if($request->point) {
            if($request->malus) {
                $user->balance = $user->balance - $request->point;
                if($user->balance < 0) {
                    $user->balance = 0;
                }
            }   else {
                $user->balance = $user->balance + $request->point;
            }
        }
        if($request->is_registered) {
            $user->is_registered = $request->is_registered;
        }
        if($request->user_type) {
            $user->user_type = $request->user_type;
        }
        $user->update();
        $response = [
            'message' => "$user->name 's informations updated.",
        ];

        return response($response, 201);
    }
}
