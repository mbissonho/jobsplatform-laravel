<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\NewUserRequest;
use App\Http\Resources\Api\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(NewUserRequest $request)
    {
        $attributes = $request->validated();

        $attributes['password'] = Hash::make($attributes['password']);

        $user = User::create($attributes);

        return (new UserResource($user))
            ->response()
            ->setStatusCode(201);
    }

    public function login(LoginRequest $request)
    {
        if(Auth::attempt($request->validated())) {
            return new UserResource(Auth::user());
        }

        return response()->json([
            'errors' => [
                'user' => [trans('auth.failed')],
            ],
        ], 422);
    }

}
