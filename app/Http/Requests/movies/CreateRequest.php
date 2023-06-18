<?php

namespace App\Http\Requests\movies;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class CreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => "required",
            'banner' => 'required|image',
            'release_year' => "required",
            'genre' => "required",
            "description" => "required",
            'director' => "required",
            'budget' => "required"
        ];
    }


    protected function failedValidation(Validator $validator)
    {
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'This fields are invalid',
                'errors' => $validator->errors(),
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}   
}
