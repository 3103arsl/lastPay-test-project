<?php

namespace App\Services;

class InsuranceService
{
    /**
     * @param float $carPrice
     * @return float
     */
    public function calculatePremium(float $carPrice): float
    {
        return round($carPrice * 0.05 + 200, 2);
    }
}
