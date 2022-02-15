<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;

class JwtService
{
    public function login($user)
    {
        $config = Config::get('jwtConfig');
        $now = now()->toImmutable();
        $token = $config->builder()
            ->issuedBy(config('app.url'))
            ->permittedFor(config('app.url'))
            ->issuedAt($now)
            ->expiresAt($now->modify('+5 hour'))
            ->withClaim('uuid', $user->uuid)
            ->getToken($config->signer(), $config->signingKey());

        return $token->toString();
    }
}
