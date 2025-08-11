<?php

namespace App\DTOs;

class CarRequestDTO
{
    /**
     * @var string
     */
    public string $customerName;

    /**
     * @var string
     */
    public string $carModel;

    /**
     * @var float
     */
    public float $carPrice;

    /**
     * @var array
     */
    public array $carSpecs;

    /**
     * @var float|null
     */
    public ?float $insurancePremium = null;

    /**
     * @var bool|null
     */
    public ?bool $loanApproved = null;

    /**
     * @param string $customerName
     * @param string $carModel
     * @param float $carPrice
     * @param array $carSpecs
     * @param float|null $insurancePremium
     * @param bool|null $loanApproved
     */
    public function __construct(
        string $customerName,
        string $carModel,
        float  $carPrice,
        array  $carSpecs,
        ?float $insurancePremium = null,
        ?bool  $loanApproved = null,
    )
    {
        $this->customerName = $customerName;
        $this->carModel = $carModel;
        $this->carPrice = $carPrice;
        $this->carSpecs = $carSpecs;
        $this->insurancePremium = $insurancePremium;
        $this->loanApproved = $loanApproved;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'customer_name'     => $this->customerName,
            'car_model'         => $this->carModel,
            'car_price'         => $this->carPrice,
            'car_specs'         => json_encode($this->carSpecs), // store as JSON in DB
            'insurance_premium' => $this->insurancePremium,
            'loan_approved'     => $this->loanApproved,
        ];
    }
}
