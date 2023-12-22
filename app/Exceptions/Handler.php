<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
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

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
{
    // Check if the exception is an instance of MethodNotAllowedHttpException
    if ($exception instanceof MethodNotAllowedHttpException) {
        // Redirect to the dashboard with a flash message
        return redirect('/dashboard')->with('error', 'The action you tried to perform is not allowed.');
    }

    // Handle other exceptions as normal
    return parent::render($request, $exception);
}
}
