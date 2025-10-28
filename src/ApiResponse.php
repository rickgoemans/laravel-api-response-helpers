<?php

namespace Rickgoemans\LaravelApiResponseHelpers;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function error(?string $message = null, mixed $errors = null, int $code = 422): JsonResponse
    {
        return static::default([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }

    public static function deleted(?string $message = null): JsonResponse
    {
        return static::success($message ?? 'Deleted');
    }

    public static function forbidden(?string $message = null): JsonResponse
    {
        return static::default([
            'success' => false,
            'message' => $message ?? 'Forbidden',
        ], 403);
    }

    public static function success(string $message = 'success', mixed $data = null, int $code = 200): JsonResponse
    {
        return static::default([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public static function unauthorized(?string $message = null): JsonResponse
    {
        return static::default([
            'success' => false,
            'message' => $message ?? 'Unauthorized',
        ], 401);
    }

    public static function default(mixed $data, int $code = 200): JsonResponse
    {
        $data = match (true) {
            is_null($data) => '',
            is_array($data) => static::filterNullValuesFromArray($data),
            default => $data,
        };

        return response()
            ->json($data, $code);
    }

    protected static function filterNullValuesFromArray(array $data): array
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = static::filterNullValuesFromArray($value);
            }

            if (is_null($value)) {
                unset($data[$key]);
            }
        }

        return $data;
    }
}
