<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Driver;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        if (request()->user()->cannot('update-service', $service)) {
            session()->flash('warning', __('Action not Authorized.'));
            return redirect()->route('dashboard');
        }

        if ($service->editable) {
            $drivers = Driver::whereNotIn('id', [1])->where('active', true)->pluck('name', 'id');
            return view('services.edit', compact('drivers', 'service'));
        } else {
            session()->flash('warning', __('This service has been completed, cannot be edited'));
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        if (request()->user()->cannot('update-service', $service)) {
            session()->flash('warning', __('Action not Authorized.'));
            return redirect()->route('dashboard');
        }

        if ($service->editable) {

            $order = Order::find($service->order_id);

            $request->validate([
                'company' => ['required_if:client_name,null'],
                'client_name' => ['required_if:company,null'],
                'client_email' => ['nullable', 'email'],
                'date' => ['required'],
                'time' => ['required'],
                'flight' => ['required'],
                'flight_time' => ['required'],
                'passengers' => ['required'],
                'currency' => ['required'],
                'amount' => ['required'],
                'type' => ['required'],
                'status' => ['required'],
                'driver' => ['required'],
                'pickup' => ['required'],
                'dropoff' => ['required'],
                'note' => ['required']
            ]);

            $order->update([
                'company' => $request->company,
                'client_name' => $request->client_name,
                'client_email' => $request->client_email,
                'client_phone' => $request->client_phone
            ]);

            $service->update([
                'date' => $request->date,
                'time' => $request->time,
                'flight' => $request->flight,
                'flight_time' => $request->flight_time,
                'passengers' => $request->passengers,
                'currency' => $request->currency,
                'amount' => $request->amount,
                'type' => $request->type,
                'status' => $request->status,
                'driver_id' => $request->driver,
                'pickup' => $request->pickup,
                'dropoff' => $request->dropoff,
                'note' => $request->note
            ]);

            if ($service->status == 'completado') {
                $service->update([
                    'editable' => false
                ]);
            }

            session()->flash('success', __('Service updated.'));
            return redirect()->route('orders.index');

        } else {

            session()->flash('warning', __('This service has been completed, cannot be edited'));
            return redirect()->back();

        }
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

    /**
     * Print the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function print(Service $service)
    {
        // dd(Setting::all()->first()->toArray());

        return view('services.print', [
            'settings' => Setting::find(1),
            'service' => Service::with('driver:id,name')->where('id', $service->id)->first()
        ]);
    }

    /**
     * Print the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function invoice(Service $service)
    {
        // dd(Setting::all()->first()->toArray());

        return view('services.invoice', [
            'settings' => Setting::find(1),
            'service' => Service::with('driver:id,name')->where('id', $service->id)->first()
        ]);
    }
}
