<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Exceptions\ApiException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        //
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $exception)
    {
        // Handle your custom API exceptions and return JSON
        if ($exception instanceof ApiException) {
            return response()->json(
                $exception->toArray(),
                500
            );
        }

        // For AJAX or API requests, return JSON error response for other exceptions
        if ($request->expectsJson()) {
            return response()->json([
                'error' => true,
                'message' => $exception->getMessage() ?: 'Server Error',
            ], 500);
        }

        // For regular web requests, use the default error page
        return parent::render($request, $exception);
    }
}
