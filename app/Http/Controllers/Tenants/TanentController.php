<?php

namespace App\Http\Controllers\Tenants;

use App\Models\User;
use App\Models\Tenant;
use  App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TenantRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class TanentController extends Controller
{


    public function login(TenantRequest $request) : Response
    {

        $tenant = Tenant::firstWhere('email', $request->email);
        if ($tenant) {
            if (Hash::check($request->password, $tenant->password)) {
                return Response(['token' =>  $tenant->createToken('access_token')->accessToken]);
            }
        } else {
            // return response()->json(['error' => 'Tenant not found'], 422);
        }
    }
}
