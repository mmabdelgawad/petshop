<?php

namespace App\Repositories;

use App\Models\JwtToken;
use App\Models\User;
use App\Utils\JwtUtil;

class JwtTokenRepository
{
    public function __construct(private JwtToken $jwtTokenModel)
    {
    }

    public function create(User $user)
    {
        $this->jwtTokenModel->forceCreate([
            'user_id' => $user->id,
            'unique_id' => md5(uniqid($user->uuid, true)),
            'token_title' => JwtUtil::LOGIN_TOKEN,
        ]);
    }
}
