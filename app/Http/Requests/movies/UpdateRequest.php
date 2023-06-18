<?php

namespace App\Http\Requests\movies;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        $movieId = $this->route('movie')->id;

        return [
            'title' => [
                'required',
                Rule::unique('movies', 'title')->ignore($movieId),
            ],
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

        throw new HttpResponseException(
            response()->json([
                'message' => 'This fields are invalid',
                'errors' => $validator->errors(),
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );

    }
}
