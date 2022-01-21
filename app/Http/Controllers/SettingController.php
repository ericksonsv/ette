<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if (request()->user()->cannot('update-settings')) {
            return redirect()->route('dashboard')->with('warning', __('Action not Authorized.'));
        }

        return view('settings.edit', ['setting' => Setting::find(1)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        if (request()->user()->cannot('update-settings')) {
            return redirect()->route('dashboard')->with('warning', __('Action not Authorized.'));
        }

        $request->validate(
            [
                'name' => ['required', 'string'],
                'address' => ['required', 'string'],
                'phone' => ['required'],
                'email' => ['required', 'email'],
                'site' => ['required'],
                'facebook' => ['required'],
                'instagram' => ['required'],
            ]
        );

        $setting = Setting::find(1);

        $setting->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'site' => $request->site,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram
        ]);

        return redirect()->route('dashboard')->with('success', __('Settings updated.'));
    }

}
