<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        //$user = User::find($request->id);
        $user = $request->user();
        $request->validate([
            'current_password' => ['required','string','min:6'],
            'password' => ['required', 'string', 'min:6']
        ]);
        
        $currentPasswordHash= Hash::check($request->current_password, $user->password);
        if($currentPasswordHash){

            $user->password = $request->password;
            $user->update();
            $response = [
                'user' => $user,
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
}
