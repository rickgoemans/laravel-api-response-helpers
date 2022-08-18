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

    public static function success(mixed $data, int $code = 200): JsonResponse
    {
        return static::default([
            'success' => true,
            'data' => $data,
            'code' => $code,
        ], $code);
    }

    public static function error(mixed $errors, ?string $message = null, int $code = 422): JsonResponse
    {
        return static::default([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
            'code' => $code,
        ], $code);
    }

    public static function unauthorized(int $code = 401): JsonResponse
    {
        return static::default([
            'success' => false,
            'code' => $code,
        ], $code);
    }

    public static function forbidden(int $code = 403): JsonResponse
    {
        return static::default([
            'success' => false,
            'code' => $code,
        ], $code);
    }
}