<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Laravel\Sanctum\HasApiTokens;

class CustomerController extends Controller
{
    use HasApiTokens;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

}
