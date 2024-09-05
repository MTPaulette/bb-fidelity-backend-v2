<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LogActivityController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*
        $logs = \LogActivity::logActivityLists();
        $response = [
            'logs' => $logs,
        ];
        return response($response, 201);

        */

        $filters = $request->only([
            'by', 'order', 'q'
        ]);
        //$logs = LogActivity::filter($filters)->paginate(2);
        $logs = LogActivity::join('users', 'users.id', '=', 'log_activities.user_id')
                                ->select('log_activities.*', 'users.name as user_name')
                                ->filter($filters)
                                ->paginate(10);

        if(sizeof($logs) == 0) {
            return response([
                'errors' => 'No result.',
            ], 422);
        } else {
            $response = [
                'logs' => $logs,
            ];
            return response($response, 201);
        }

    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \LogActivity::addToLog($request->description);
        $response = [
            'message' => "log insert successfully.",
        ];
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
        LogActivity::truncate();
        \LogActivity::addToLog('Clearing activity logs.');
        $response = [
            'message' => 'Activity logs cleared.'
        ];
        return response($response, 201);
    }
}
