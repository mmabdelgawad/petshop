<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;

class JwtService
{
    private mixed $config;

    public function __construct()
    {
        $this->config = Config::get('jwtConfig');
    }

    public function login($user)
    {
        $now = now()->toImmutable();
        $token = $this->config->builder()
            ->issuedBy(config('app.url'))
            ->permittedFor(config('app.url'))
            ->issuedAt($now)
            ->expiresAt($now->modify('+5 hour'))
            ->withClaim('uuid', $user->uuid)
            ->getToken($this->config->signer(), $this->config->signingKey());

        return $token->toString();
    }

    public function parseToken($token)
    {
        return $this->config->parser()->parse($token)->claims()->all();
    }
}
