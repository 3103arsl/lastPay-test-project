<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BankRequest extends FormRequest
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
            'amount' => 'required|numeric',
            'insurancePremium' => 'required|numeric',
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'amount.required' => 'Price is required.',
            'amount.numeric' => 'Should Numeric value',
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
