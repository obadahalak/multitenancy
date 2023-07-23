<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Facade\Tenant;
use App\Models\Service;
use App\Traits\UploadImages;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\AvilableService;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    use UploadImages;


    public function user()
    {
        return auth('api')->user();
    }

    public function store(UserRequest $request)
    {
        $user = User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'image' => $this->uploadImage($request->image, 'userImages'),

            ]
        );
        $token = $user->createToken('Token Name')->accessToken;
        return response()->json(['token' => $token]);
    }
}
