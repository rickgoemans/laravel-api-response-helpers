<?php

namespace Rickgoemans\LaravelApiResponseHelpers;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function default(mixed $data, int $code = 200): JsonResponse
    {
        return response()
            ->json($data, $code);
    }

    public static function success(string $message = 'success', mixed $data = null, int $code = 200): JsonResponse
    {
        return static::default([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public static function error(?string $message = null, mixed $errors = null, int $code = 422): JsonResponse
    {
        return static::default([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }

    public static function unauthorized(int $code = 401): JsonResponse
    {
        return static::default([
            'success' => false,
            'message' => 'Unauthorized',
        ], $code);
    }

    public static function forbidden(int $code = 403): JsonResponse
    {
        return static::default([
            'success' => false,
            'message' => 'Forbidden',
        ], $code);
    }
}
