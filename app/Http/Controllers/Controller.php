<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    function __construct() {
        
    }
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    function jsonResponse($resp) {
        return response()->json($resp);
    }
}
