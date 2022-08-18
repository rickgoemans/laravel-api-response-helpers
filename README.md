
[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/support-ukraine.svg?t=1" />](https://supportukrainenow.org)

# A Laravel helper to create uniform API responses

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rickgoemans/laravel-api-response-helpers.svg?style=flat-square)](https://packagist.org/packages/rickgoemans/laravel-api-response-helpers)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/rickgoemans/laravel-api-response-helpers/run-tests?label=tests)](https://github.com/rickgoemans/laravel-api-response-helpers/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/rickgoemans/laravel-api-response-helpers/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/rickgoemans/laravel-api-response-helpers/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/rickgoemans/laravel-api-response-helpers.svg?style=flat-square)](https://packagist.org/packages/rickgoemans/laravel-api-response-helpers)

This package contains some useful helpers to return API responses in a uniform format.

## Installation

You can install the package via composer:

```bash
composer require rickgoemans/laravel-api-response-helpers
```
## Usage

```php
use Rickgoemans\LaravelApiResponseHelpers\ApiResponse;

class ExampleController extends Controller {
    public function default(): JsonResponse {
        return ApiResponse::default([
            'message' => 'This is an example',
        ], 200);
    }
    
    public function success(): JsonResponse {
        return ApiResponse::success([
            'user_id' => 1,
            'name' => 'Rick Goemans',
        ], 200);
    }
    
    public function error(): JsonResponse {
        return ApiResponse::error([
            'name' => [
                'required',
            ],
        ], 'Invalid data', 422);
    }
    
    public function unauthorized(): JsonResponse {
        return ApiResponse::unauthorized(401);
    }
    
    public function forbidden(): JsonResponse {
        return ApiResponse::forbidden(403);
    }
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/rickgoemans/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Rick Goemans](https://github.com/rickgoemans)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
