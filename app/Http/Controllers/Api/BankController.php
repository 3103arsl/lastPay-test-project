<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BankRequest;
use App\Services\BankService;

class BankController extends Controller
{
    /** @var BankService $bankService */
    protected BankService $bankService;

    public function __construct(BankService $bankService)
    {
        $this->bankService = $bankService;
    }

    /**
     * @param BankRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLoanApproval(BankRequest $request)
    {
        $isApproved = $this->bankService->checkLoanApproval($request->input('amount'), $request->input('insurancePremium'));

        return response()->json(['approved' => $isApproved]);
    }
}
