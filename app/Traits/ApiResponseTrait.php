<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponseTrait
{
    /**
     * @param  string  $message
     * @param  int  $code
     * @param  array  $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success(string $message, int $code = 200, array $data = []): Response
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * @param  string  $message
     * @param  int  $code
     * @param  array  $errors
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error(string $message, int $code = 400, array $errors = []): Response
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }

    /**
     * @param  string  $message
     * @param  int  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function created(string $message = 'Created successfully', int $code = 201): Response
    {
        return $this->success($message, $code);
    }

    /**
     * @param  string  $message
     * @param  int  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function updated(string $message = 'Updated successfully', int $code = 200): Response
    {
        return $this->success($message, $code);
    }

    /**
     * @param  string  $message
     * @param  int  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function deleted(string $message = 'Deleted successfully', int $code = 200): Response
    {
        return $this->success($message, $code);
    }

    /**
     * @param  string  $message
     * @param  int  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function noContent(string $message = 'No content found', int $code = 204): Response
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $code);
    }

    /**
     * @param  string  $message
     * @param  int  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function unauthorized(string $message = 'Unauthorized', int $code = 401): Response
    {
        return $this->error($message, $code);
    }

    /**
     * @param  string  $message
     * @param  int  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function forbidden(string $message = 'Forbidden', int $code = 403): Response
    {
        return $this->error($message, $code);
    }

    /**
     * @param  string  $message
     * @param  int  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function notFound(string $message = 'Not found', int $code = 404): Response
    {
        return $this->error($message, $code);
    }

    /**
     * @param  string  $message
     * @param  int  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function internalServerError(string $message = 'Internal server error', int $code = 500): Response
    {
        return $this->error($message, $code);
    }
}
