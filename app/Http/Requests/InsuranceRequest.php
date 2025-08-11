<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class InsuranceRequest extends FormRequest
{
    /**
     * @return true
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules()
    {
        return [
            'price' => 'required|numeric'
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'price.required' => 'Price is required.',
            'price.numeric' => 'Should Numeric value',
        ];
    }

    /**
     * Override failedValidation to return custom JSON response
     */
    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
