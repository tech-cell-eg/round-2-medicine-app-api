<?php

namespace App\Traits;

trait ApiResponseTrait
{
    /**
     * Success Response
     */
    protected function successResponse($data = [], $message = 'Success', $status = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * Error Response
     */
    protected function errorResponse($message = 'Error', $status = 400, $errors = [])
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }
}
