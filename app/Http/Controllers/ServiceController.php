<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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
            'agency', 'validity', 'service_type', 'by', 'order', 'q'
        ]);


        if($request->has('no_pagination')) {
            $services = Service::filter($filters)->get();
        } else {
            $services = Service::filter($filters)->paginate(20);
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
        $service = Service::findOrFail($id);
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

        if($validator->fails()){
            return response([
                'errors' => $validator->errors(),
            ], 422);
        }
        
        $service = Service::findOrFail($request->id);

        if($request->name) {
            $service->name = $request->name;
        }
        if($request->price) {
            $service->price = $request->price;
        }
        if($request->credit) {
            $service->credit = $request->credit;
        }
        if($request->debit) {
            $service->debit = $request->debit;
        }

        if($request->validity) {
            $service->validity = $request->validity;
        }

        if($request->agency) {
            $service->agency = $request->agency;
        }

        if($request->service_type) {
            $service->service_type = $request->service_type;
        }

        if($request->description) {
            $service->description = $request->description;
        }
        $service->update();
        $response = [
            'service' => $service,
            'message' => "Service successfully updated",
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
        $user = $request->user();
        if (! Hash::check($request->password, $user->password)) {
            $response = [
                'password' => 'Wrong password.'
            ];
            return response($response, 422);
        }
 
        $service = Service::find($request->id);
        if($service) {
            // check if the service has already been buy
            if( $service->users()->exists() ) {
                $response = [
                    'error' => 'The service '.$service->name.' has already been purchased. You can not delete it',
                ];
                return response($response, 422);
            } else {
                $service->delete();
                $response = [
                    'message' => "Service successfully deleted",
                ];
                return response($response, 201);
            }
        } else {
            $response = [
                'errors' => 'Service not found',
            ];
            return response($response, 404);
        }


    }
}
