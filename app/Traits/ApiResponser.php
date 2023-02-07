<?php

namespace App\Traits;

use Illuminate\Http\Response;
use App\Constants\Constant;
use Illuminate\Http\JsonResponse;

trait ApiResponser
{
	/**
	 * @param array $items
	 * @param string $message
	 * @param int $code
	 *
	 * @return JsonResponse
	 */
    protected function successResponse(string $message = Constant::MSG_OK, int $error = Constant::ERR_CODE_OK, int $code = Response::HTTP_OK) : JsonResponse
	{
		return response()->json([
			'message' 	=> $message,
			'error' 	=> $error
		], $code);
	}

	/**
	 * @param string|null $message
	 * @param int $code
	 *
	 * @return JsonResponse
	 */
	protected function errorResponse(string $message = Constant::MSG_ERROR, int $error = Constant::ERR_CODE_ERROR, int $code = Response::HTTP_GATEWAY_TIMEOUT) : JsonResponse
	{
		return response()->json([
			'error'		=> $error,
			'message' 	=> $message
		], $code);
	}

	/**
	 * @param string $message
	 * @param int $code
	 *
	 * @return JsonResponse
	 */
	protected function exceptionResponse(string $message = Constant::MSG_EXCEPTION, int $error = Constant::ERR_CODE_EXCEPTION, int $code = Response::HTTP_GATEWAY_TIMEOUT) : JsonResponse
	{
		return response()->json([
			'error'		=> $error,
			'message' 	=> $message
		], $code);
	}

	/**
	 * @return JsonResponse
	 */
    protected function catchErrorResponse() : JsonResponse
    {
        return response()->json([
			'error'		=> Constant::ERR_CAUGHT_ERROR,
			'message' 	=> Constant::MSG_CAUGHT_ERROR,
		], Response::HTTP_GATEWAY_TIMEOUT);
    }
}