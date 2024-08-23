<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'current_password' => ['required','string','min:6'],
            'password' => ['required', 'string', 'min:6']
        ]);
        
        $currentPasswordHash= Hash::check($request->current_password, $user->password);
        if($currentPasswordHash){

            $user->password = $request->password;
            $user->update();

            if($user->role_id == 1) {
                $token = $user->createToken('bb-fidelity-syst-token', ['admin'])->plainTextToken;
            } else {
                $token = $user->createToken('bb-fidelity-syst-token', ['view-profile', 'view-historic'])->plainTextToken;
            }

            $response = [
                'user' => $user,
                'token' => $token,
                'message' => "Password Updated Successfully"
            ];
            return response($response, 201);

        }else{
            $response = [
                'errors' => 'Current Password does not match with Old Password',
            ];
            return response($response, 500);
        }
    }
    
    public function sendResetLinkEmail(Request $request) {
        //$request->validate(['email' => 'required|email']);
    
        $validator = Validator::make($request->all(),[
            'email' => 'required|email'
        ]);

        if($validator->fails()){
            return response([
                'errors' => $validator->errors(),
            ], 500);
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        /* if($status == Password::RESET_LINK_SENT) {
            $response = [
                'message' => "Reset link sent to your email.",
            ];
            return response($response, 201);
        } else {
            $response = [
                'errors' => "Failed to send reset link.",
            ];
            return response($response, 500);
        } */

        
        if($status == Password::RESET_LINK_SENT) {
        $response = [
            'message' => [__($status)],
        ];
        return response($response, 201);
    } else {
        $response = [
            'errors' => [__($status)],
        ];
        return response($response, 500);
    }


    }
    
    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return response([
                'errors' => $validator->errors(),
            ], 500);
        }

        $user = null;

        $status = Password::reset(
            $request->only('email', 'password', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]); //->setRememberToken(Str::random(60));

                $user->save();
                $user = $user;
                //event(new PasswordReset($user));
            }
        );
     
        if($status === Password::PASSWORD_RESET) {
            $response = [
                'user' => $user,
                'message' => [__($status)],
            ];
            return response($response, 201);
        } else {
            $response = [
                'errors' => [__($status)],
            ];
            return response($response, 500);
        }
    }
}