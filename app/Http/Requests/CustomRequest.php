<?php

namespace App\Http\Requests;

use App\Actions\Handlers\HandlerResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use stdClass;

class CustomRequest extends FormRequest
{
    /**
     * Custom Message Failed Authorization
     *
     */
    protected function failedAuthorization()
    {
        throw new HttpResponseException(
            HandlerResponse::responseJSON([
                'message' => 'This action is unauthorized.'
            ], 403)
        );
    }

    /**
     * Custom Message Failed Validation
     * 
     * @param \Illuminate\Contracts\Validation\Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = new stdClass;
        foreach ($this->validator->errors()->messages() as $key => $value) {
            $errors->$key = $value[0];
        }

        throw new HttpResponseException(
            HandlerResponse::responseJSON([
                'errors' => $errors
            ], 422)
        );
    }

    /**
     * Custom Message Failed Validation
     */
    public function messages()
    {
        return [
            'required'  => ':Attribute is required.',
            'unique'    => ':Attribute is already exists.',
            'email'     => ':Attribute must be a valid email address.',
            'numeric'   => ':Attribute must be numeric.',
            'min'       => ':Attribute must contain at least :min characters or more.',
            'max'       => ':Attribute must not be greater than :max characters.',
            'array'     => ':Attribute must be an array.',
        ];
    }
}
