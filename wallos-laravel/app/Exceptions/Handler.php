<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        // Handle database query exceptions
        $this->renderable(function (QueryException $e) {
            if (config('app.debug')) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'sql' => $e->getSql(),
                    'bindings' => $e->getBindings(),
                    'trace' => $e->getTrace(),
                ], 500);
            }

            return response()->json([
                'message' => 'Database query error occurred',
                'error' => $e->getMessage()
            ], 500);
        });

        // Handle unique constraint violations
        $this->renderable(function (UniqueConstraintViolationException $e) {
            return response()->json([
                'message' => 'Duplicate entry detected',
                'error' => $e->getMessage(),
                'resolution' => 'Please ensure all unique fields contain distinct values'
            ], 409);
        });
    }
}