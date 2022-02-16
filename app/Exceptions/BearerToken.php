<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

final class BearerToken extends Exception
{
    private function __construct(string $message, int $code)
    {
        parent::__construct($message, $code);
    }

    public static function missing(string $message, int $code)
    {
        return new self($message, $code);
    }

    public function render(): JsonResponse
    {
        return response()->json(['message' => $this->message], $this->code);
    }
}
