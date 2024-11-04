<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpFoundation\Response;

use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // إضافة دالة render
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthorizationException) {
            // إرجاع صفحة مخصصة مع حالة 403
            return response()->view('cpanel.unauthorized', [], Response::HTTP_FORBIDDEN);
        }

        return parent::render($request, $exception);
    }
}
