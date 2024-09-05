<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $response = [
            'notifications' => $request->user()->notifications()->paginate(10)
        ];
        return response($response, 201);
    }
}
