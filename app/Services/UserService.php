<?php

namespace App\Services;

use App\Exceptions\User\UserException;
use App\Repositories\JwtTokenRepository;
use App\Repositories\UserRepository;
use Symfony\Component\HttpFoundation\Response;

class UserService
{
    public function __construct(
        private JwtService $jwtService,
        private UserRepository $userRepository,
        private JwtTokenRepository $jwtTokenRepository
    )
    {
    }

    public function login(string $email, string $password)
    {
        $user = $this->userRepository->findByEmailAndPassword($email, $password);

        if (is_null($user)) {
            throw UserException::notFound("User not found", Response::HTTP_BAD_REQUEST);
        }

        $token = $this->jwtService->login($user);
        $this->userRepository->updateLastLoginAt($user);
        $this->jwtTokenRepository->create($user);

        return [$user, $token];
    }
}
