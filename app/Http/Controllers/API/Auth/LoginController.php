<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserLogin;
use App\Services\UserService;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /**
     * @OA\Post(
     *      path="/user/login",
     *      operationId="login",
     *      tags={"Authentication"},
     *      summary="User login",
     *      description="Returns user token",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 ref="#/components/schemas/UserLogin",
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *       @OA\Response(
     *          response=422,
     *          description="Unprocessable Content",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="User not found",
     *          @OA\JsonContent()
     *      ),
     *     )
     */
    public function __invoke(UserService $service, UserLogin $request)
    {
        $token = $service->login($request->get('email'), $request->get('password'));
        return response()->json(['token' => $token], Response::HTTP_OK);
    }
}
