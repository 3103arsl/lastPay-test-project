<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarInfoRequest;
use App\Http\Resources\CarPurchaseResource;
use App\Services\CarPurchaseService;
use Illuminate\Http\JsonResponse;

class CarPurchaseController extends Controller
{
    /**
     * @param CarPurchaseService $carRequestService
     */
    public function __construct(protected CarPurchaseService $carRequestService)
    {
    }

    /**
     * @param CarInfoRequest $request
     * @return JsonResponse
     */
    public function handleRequest(CarInfoRequest $request): JsonResponse
    {
        try {
            $dto = $this->carRequestService->processCarRequest(
                $request->input('customer_name'),
                $request->input('car_model')
            );

            return (new CarPurchaseResource($dto))
                ->response()
                ->setStatusCode(201);

        } catch (\RuntimeException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unexpected error occurred',
            ], 500);
        }

    }
}
