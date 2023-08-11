<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;

class CustomerController extends Controller
{
    use HasApiTokens;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function searchByName(Request $request)
    {
        $searchTerm = $request->input('name');

        $clients = Customer::where('name', 'like', "%$searchTerm%")->get();

        return response()->json($clients);
    }
}
