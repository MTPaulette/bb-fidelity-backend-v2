<?php

namespace App\Helpers;

use Request;
use App\Models\LogActivity as LogActivityModel;


class LogActivity
{
    public static function addToLog($description)
    {
        //return Request::user();
    	$log = [];
    	$log['description'] = $description;
    	$log['url'] = Request::fullUrl();
    	$log['method'] = Request::method();
    	$log['ip'] = Request::ip();
    	$log['agent'] = Request::header('user-agent');
    	$log['user_id'] = auth()->user()->id;
    	//$log['user_id'] = auth()->check() ? auth()->user()->id : 1;
    	LogActivityModel::create($log);
    }


    public static function logActivityLists()
    {
        return LogActivityModel::latest()->paginate(1);//->get();
    }

}