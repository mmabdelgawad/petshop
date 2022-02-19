<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function __construct(private User $userModel)
    {
    }

    public function findByEmailAndPassword(string $email, string $password)
    {
        $user = $this->userModel->where('email', $email)->first();

        if (!$user) {
            return null;
        }

        return Hash::check($password, $user->password) ? $user : null;
    }

    public function updateLastLoginAt(User $user)
    {
        $user->forceFill([
            'last_login_at' => now()
        ])->save();
    }

    public function getUserByUuid(string $uuid)
    {
        return $this->userModel->where('uuid', $uuid)->first();
    }
}
