<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserLogin;
use App\Services\UserService;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function __invoke(UserService $service, UserLogin $request)
    {
        $token = $service->login($request->get('email'), $request->get('password'));
        return response()->json(['token' => $token], Response::HTTP_OK);
    }
}
