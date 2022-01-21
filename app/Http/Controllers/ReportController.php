<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    function index()
    {
        return view('reports.index', ['services' => Service::all()]);
    }
}
