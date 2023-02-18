<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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

    public function render($request, Throwable $e): Response
    {
        $code = 500;
        $data = [
            'message' => $e->getMessage(),
            'errors' => []
        ];

        if ($e instanceof ModelNotFoundException) {
            $code = 404;
            $data['message'] = 'Not Found!';
        }

        if ($e instanceof ValidationException) {
            $code = 400;
            $errors = [];
            foreach ($e->validator->getMessageBag()->all() as $message) {
                $errors[] = $message;
            }
            $data['message'] = 'Validation error';
            $data['errors'] = $errors;
        }

        return response()->json($data, $code);

//        return parent::render($request, $e);
    }
}
