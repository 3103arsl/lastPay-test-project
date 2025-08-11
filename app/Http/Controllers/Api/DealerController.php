<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DealerRequest;
use App\Services\DealerService;

class DealerController extends Controller
{
    /**
     * @param DealerService $dealerService
     */
    public function __construct(private DealerService $dealerService)
    {
    }

    /**
     * @param DealerRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCarDetails(DealerRequest $request)
    {
        $data = $this->dealerService->getCarDetails($request->input('model'));

        return response()->json($data);
    }
}
