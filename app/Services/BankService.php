<?php

namespace App\Services;

class BankService
{
    /**
     * @param float $carPrice
     * @param float $insurancePremium
     * @return bool
     */
    public function checkLoanApproval(float $carPrice, float $insurancePremium): bool
    {
        return ($carPrice + $insurancePremium) <= 70000;
    }
}
