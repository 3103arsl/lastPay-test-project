<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarPurchaseResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'customer_name' => $this->customerName,
            'car_model' => $this->carModel,
            'car_price' => $this->carPrice,
            'car_specs' => $this->carSpecs,
            'insurance_premium' => $this->insurancePremium,
            'loan_approved' => $this->loanApproved,
        ];
    }

}
