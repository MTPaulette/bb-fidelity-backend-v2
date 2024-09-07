<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Notifications\CreatedService;
use App\Notifications\DeletedService;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'agency', 'validity', 'service_type', 'by', 'order', 'q', 'date'
        ]);


        $services_query = Service::filter($filters)->serviceWithAdminName();

        if($request->has('no_pagination')) {
            $services = $services_query->get();
        } else {
            $services = $services_query->paginate(20);
        }
        
        if(sizeof($services) == 0) {
            return response([
                'errors' => 'No result.',
            ], 422);
        } else {
            $response = [
                'services' => $services,
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
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|unique:services',
            'price' => 'required|numeric|min:1',
            'credit' => 'required|numeric',
            'debit' => 'required|numeric',
            'validity' => 'required',
            'service_type' => 'required|string',
            'agency' => 'required|string',
            'description' => 'required|string',
        ]);

        if($validator->fails()){
            \LogActivity::addToLog("Service creation failed.<br/> Error: ".$validator->errors());
            return response([
                'errors' => $validator->errors(),
            ], 422);
        }

        $service = Service::create($validator->validated());
        $service = Service::where('name', $request->name)->first();
        $service->user_id = $request->user()->id;

        $service->save();
        $response = [
            'service_id' => $service->id,
            'message' => 'The service '.$service->name.' was successfully created',
        ];

        \LogActivity::addToLog("New service created.<br/> Service name: {$service->name} | Type of service: {$service->service_type} | Price: {$service->price} <br/>Agency: {$service->agency} | Validity: {$service->validity} | Credit: {$service->credit} | Debit: {$service->debit}.");
        
        /*sending notification email when new service is created */
        $admins = User::allAdmin()->get();
        foreach($admins as $admin) {
            $admin->notify(new CreatedService($service, $admin, $request->user()->name));
        }
        return response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::serviceWithAdminName()->findOrFail($id);
        $response = [
            'service' => $service,
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
        $recent_service_id = Service::orderByDesc('id')->get('id')->first();
        return response($recent_service_id, 201);
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
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'price' => 'required|numeric|min:1',
            'credit' => 'required|numeric',
            'debit' => 'required|numeric',
            'validity' => 'required',
            'service_type' => 'required|string',
            'agency' => 'required|string',
            'description' => 'required|string',
        ]);

        $service = Service::findOrFail($request->id);
    
        if($validator->fails()){
            \LogActivity::addToLog("Service update failed.<br/> Service name: ".$service->name." | error: ".$validator->errors());
            return response([
                'errors' => $validator->errors(),
            ], 422);
        }

        if($request->name) {
            if($request->name != $service->name) {
                $messageLog = $messageLog.'Old name: '.$service->name.', New name: '.$request->name." | ";
            }
            $service->name = $request->name;
        }
        if($request->price) {
            if($request->price != $service->price) {
                $messageLog = $messageLog.'Old price: '.$service->price.', New price: '.$request->price." | ";
            }
            $service->price = $request->price;
        }
        if($request->credit) {
            if($request->credit != $service->credit) {
                $messageLog = $messageLog.'Old credit: '.$service->credit.', New credit: '.$request->credit." | ";
            }
            $service->credit = $request->credit;
        }
        if($request->debit) {
            if($request->debit != $service->debit) {
                $messageLog = $messageLog.'Old debit: '.$service->debit.', New debit: '.$request->debit." | ";
            }
            $service->debit = $request->debit;
        }

        if($request->validity) {
            if($request->validity != $service->validity) {
                $messageLog = $messageLog.'<br/> Old validity: '.$service->validity.', New validity: '.$request->validity." | ";
            }
            $service->validity = $request->validity;
        }

        if($request->agency) {
            if($request->agency != $service->agency) {
                $messageLog = $messageLog.'Old agency: '.$service->agency.', New agency: '.$request->agency." | ";
            }
            $service->agency = $request->agency;
        }

        if($request->service_type) {
            if($request->service_type != $service->service_type) {
                $messageLog = $messageLog.'Old type of service: '.$service->service_type.', New type of service: '.$request->service_type." | ";
            }
            $service->service_type = $request->service_type;
        }

        if($request->description) {
            if($request->description != $service->description) {
                $messageLog = $messageLog.'description updated.';
            }
            $service->description = $request->description;
        }
        $service->update();
        $response = [
            'messageLog' => $messageLog,
            'service' => $service,
            'message' => "Service successfully updated",
        ];
        \LogActivity::addToLog("Service updated.<br/>".$messageLog);
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
        $user = $request->user();
        $service = Service::findOrFail($request->id);

        if (! Hash::check($request->password, $user->password)) {
            $response = [
                'password' => 'Wrong password.'
            ];
            \LogActivity::addToLog("Service deletion failed.<br/> Service name: ".$service->name." | error: ".$response['password']);
            return response($response, 422);
        }

        // check if the service has already been buy
        if( $service->users()->exists() ) {
            $response = [
                'error' => 'The service '.$service->name.' has already been purchased. You can not delete it',
            ];
            \LogActivity::addToLog("Service deletion failed.<br/> Service name: ".$service->name." | Error: ".$response['error']);

            return response($response, 422);
        } else {
            $service->delete();
            /*sending notification email when new service is deleted */
            $admins = User::allAdmin()->get();
            foreach($admins as $admin) {
                $admin->notify(new DeletedService($service, $admin, $request->user()->name));
            }
            \LogActivity::addToLog('Service '.$service->name.' deleted');
            $response = [
                'message' => "Service successfully deleted",
            ];
            return response($response, 201);
        }
    }
}
