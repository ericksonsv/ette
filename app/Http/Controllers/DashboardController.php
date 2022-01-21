<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Driver;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        $services = Service::where('status','pendiente')->get()->map(function ($service) {
            return [
                'title' => $service->driver->name,
                'start' => $service->date->format('Y-m-d').'T'.$service->time->format('H:i:s'),
                'url' => route('services.edit', $service->id)
            ];
        });

        return view('dashboard.index', [
            'services' => $services,
            'drivers' => Driver::whereNotIn('id', [1])->count(),
            'servicesCount' => Service::count(),
            'users' => User::whereNotIn('id',[1])->count()
        ]);
    }
}
