<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = [
            'services' => Service::orderBy('name', 'asc')->get(),
        ];
        return response($response, 201);
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
            'price' => 'required|integer',
            'point' => 'required|integer',
            'validity' => 'required',
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
            'message' => 'Service successfully created.'
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
        $service = Service::find($id);
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
        $service = Service::find($request->id);
        $validator = Validator::make($request->all(),[
            'name' => 'required|string'
        ]);

        if($validator->fails()){
            return response([
                'errors' => $validator->errors(),
            ], 422);
        }

        if($request->name) {
            $service->name = $request->name;
        }
        if($request->price) {
            $service->price = $request->price;
        }

        if($request->point) {
            $service->point = $request->point;
        }

        if($request->validity) {
            $service->validity = $request->validity;
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
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
}
