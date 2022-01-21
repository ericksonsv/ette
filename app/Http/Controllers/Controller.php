<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function($request,$next){
            if (session('success')) {
                // Alert::success(session('success'));
                toast(session('success'),'success');
            }

            if (session('warning')) {
                // Alert::warning(session('warning'));
                toast(session('warning'),'warning');
            }

            if ($request->has('errors')) {
                // Alert::error(session('error'));
                toast('Please check the errors listed below.','error');
            }

            return $next($request);
        });
    }
}
