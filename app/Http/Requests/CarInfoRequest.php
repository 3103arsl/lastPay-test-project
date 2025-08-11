<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CarInfoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'customer_name' => 'required|string|max:255',
            'car_model' => 'required|string|in:Tesla Model 3,Toyota Camry',
        ];
    }

    public function messages()
    {
        return [
            'customer_name.required' => 'Customer name is required.',
            'car_model.in' => 'Car model must be either Tesla Model 3 or Toyota Camry.',
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
