<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InsuranceRequest;
use App\Services\InsuranceService;
use Illuminate\Http\Request;


class InsuranceController extends Controller
{
    /**
     * @param InsuranceService $insuranceService
     */
    public function __construct(private InsuranceService $insuranceService)
    {

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInsurancePremium(InsuranceRequest $request)
    {
        $insurance = $this->insuranceService->calculatePremium($request->input('price'));

        return response()->json(['premium' => $insurance]);
    }
}
