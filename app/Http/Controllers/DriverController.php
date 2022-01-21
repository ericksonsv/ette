<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('drivers.index', ['drivers' => Driver::whereNotIn('id',[1])->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (request()->user()->cannot('store-driver')) {
            return redirect()->route('drivers.index')->with('warning', __('Action not Authorized.'));
        }

        return view('drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (request()->user()->cannot('store-driver')) {
            return redirect()->route('drivers.index')->with('warning', __('Action not Authorized.'));
        }

        $request->validate([
            'name' => ['required', 'string', 'min:6', 'max:25'],
        ]);

        $driver = Driver::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'active' => $request->active,
        ]);

        session()->flash('success', __('Driver created.'));

        return redirect()->route('drivers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        if (request()->user()->cannot('update-driver')) {
            return redirect()->route('drivers.index')->with('warning', __('Action not Authorized.'));
        }

        return view('drivers.edit', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        if (request()->user()->cannot('update-driver')) {
            return redirect()->route('drivers.index')->with('warning', __('Action not Authorized.'));
        }

        $request->validate([
            'name' => ['required', 'string', 'min:8', 'max:25'],
        ]);

        $driver->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'active' => $request->active,
        ]);

        session()->flash('success', __('Driver updated.'));

        return redirect()->route('drivers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        //
    }
}
