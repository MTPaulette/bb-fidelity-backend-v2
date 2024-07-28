<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserAccountController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return response([
                'errors' => $validator->errors(),
            ], 500);
        }

        $user = User::create($validator->validated());

        $user = User::where('email', $request->email)->first();

        if($request->role_id == 1) {
            $user->role_id = 1;
            $user->save();

            $token = $user->createToken('bb-fidelity-syst-token', ['admin'])->plainTextToken;
        } else {
            $token = $user->createToken('bb-fidelity-syst-token', ['view-profile', 'view-historic'])->plainTextToken;
        }

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
        if(!Auth::attempt($request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]), true)) {
            throw ValidationException::withMessages([
                'email' => 'Auth failed. Email not found or incorrect password'
            ]);
            return response([
                'message' => ['These credentials do not match our records.']
            ], 422);
        }
        $user = User::where('email', $request->email)->first();

        $user->tokens()->delete();
        if($user->role_id == 1) {
            $token = $user->createToken('bb-fidelity-syst-token', ['admin'])->plainTextToken;
        } else {
            $token = $user->createToken('bb-fidelity-syst-token', ['view-profile', 'view-historic'])->plainTextToken;
        }

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    /**
     * Update the user's informations.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find($request->id);
        
        if($request->has('name') && isset($request->name)) {
            $user->name = $request->name;
        }

        if($request->has('email') && isset($request->email)) {
            $user->email = $request->email;
        }

        $user->update();
        $response = [
            'user' => $user,
            'message' => 'profile updated.',
        ];

        return response($response, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request) {
        $user = User::find($request->id);
        $user->tokens()->delete();
        return response([
            'message' => 'Logout user',
        ], 201);
    }
    
}
