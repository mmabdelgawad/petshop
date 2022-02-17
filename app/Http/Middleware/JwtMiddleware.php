<?php

namespace App\Http\Middleware;

use App\Exceptions\BearerToken;
use App\Exceptions\User\UserException;
use App\Repositories\UserRepository;
use App\Services\JwtService;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware
{
    public function __construct(
        private JwtService $jwtService,
        private UserRepository $userRepository
    )
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|RedirectResponse
     * @throws BearerToken
     * @throws UserException
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            throw BearerToken::missing("Bearer Token is missing", Response::HTTP_BAD_REQUEST);
        }

        $tokenData = $this->jwtService->parseToken($token);
        $this->jwtService->checkIfTokenExpired($tokenData['exp']);
        $uuid = $tokenData['uuid'];

        $user = $this->userRepository->getUserByUuid($uuid);

        if (!$user) {
            throw UserException::notFound("User not found", Response::HTTP_BAD_REQUEST);
        }

        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        return $next($request);
    }
}
