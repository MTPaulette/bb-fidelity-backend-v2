<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $response = [
            // 'users' => User::orderBy('name', 'asc')->get(),
            'users' => User::orderBy('name', 'asc')->paginate(10),
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
}
