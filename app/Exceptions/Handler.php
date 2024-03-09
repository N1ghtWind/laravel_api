<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];


    public function render($request, Throwable $exception)
    {
        // Customize the response for API exceptions
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Method Not Allowed'], 405);
        }

        return parent::render($request, $exception);
    }

    // protected function handleApiException($request, Throwable $exception)
    // {
    //     $statusCode = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;

    //     return response()->json([
    //         'error' => [
    //             'code' => $statusCode,
    //             'message' => $exception->getMessage(),
    //         ]
    //     ], $statusCode);
    // }
}
