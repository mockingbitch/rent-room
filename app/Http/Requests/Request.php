<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use App\Constants\Constant;

class Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @param Validator $validator
     *
     * @return JsonResponse
     */
    protected function failedValidation(Validator $validator) : JsonResponse
    {
        $errors = $validator->errors();

        $response = response()->json([
            'details' => $errors->messages(),
            'message' => Constant::MSG_INVALID_REQUEST,
            'error'   => Constant::ERR_CODE_EXCEPTION
        ], Response::HTTP_UNPROCESSABLE_ENTITY);

        throw new HttpResponseException($response);
    }
}
