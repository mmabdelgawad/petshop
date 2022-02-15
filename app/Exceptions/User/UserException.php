<?php

namespace App\Exceptions\User;

use Exception;
use Illuminate\Http\JsonResponse;

final class UserException extends Exception
{
    private function __construct(string $message, int $code)
    {
        parent::__construct($message, $code);
    }

    public static function notFound(string $message, int $code)
    {
        return new self($message, $code);
    }

    public function render(): JsonResponse
    {
        return response()->json(['message' => $this->message], $this->code);
    }
}
