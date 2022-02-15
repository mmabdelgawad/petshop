<?php

namespace App\Services;

use App\Exceptions\User\UserException;
use App\Repositories\JwtTokenRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Config;

class UserService
{
    public function __construct(
        private UserRepository $userRepository,
        private JwtTokenRepository $jwtTokenRepository
    )
    {
    }

    public function login(string $email, string $password)
    {
        $user = $this->userRepository->findByEmailAndPassword($email, $password);

        if (is_null($user)) {
            throw UserException::notFound("User not found", 404);
        }

        $config = Config::get('jwtConfig');
        $now = now()->toImmutable();
        $token = $config->builder()
            ->issuedBy(config('app.url'))
            ->permittedFor(config('app.url'))
            ->issuedAt($now)
            ->expiresAt($now->modify('+5 hour'))
            ->withClaim('uuid', $user->uuid)
            ->getToken($config->signer(), $config->signingKey());

        $this->userRepository->updateLastLoginAt($user);
        $this->jwtTokenRepository->create($user);

        return $token->toString();
    }
}
