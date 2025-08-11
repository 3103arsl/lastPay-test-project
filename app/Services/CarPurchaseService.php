<?php

namespace App\Services;

use App\DTOs\CarRequestDTO;
use App\Exceptions\ApiException;
use App\Models\CarRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CarPurchaseService
{
    /** @var string */
    const BASE_URL = 'http://lastpayapp.test/api/';

    /**
     * @param string $customerName
     * @param string $carModel
     * @return CarRequestDTO
     */
    public function processCarRequest(string $customerName, string $carModel): CarRequestDTO
    {
        $dealerData = $this->getCarDetails(['model' => $carModel]);

        if (!$dealerData || !isset($dealerData['price'], $dealerData['specs'])) {
            throw new \RuntimeException('Unable to fetch dealer data for model: ' . $carModel);
        }

        $insurancePremium = $this->getInsurancePremium($dealerData);

        if (!$insurancePremium || !isset($insurancePremium['premium'])) {
            throw new \RuntimeException('Unable to fetch insurance premium.');
        }

        $loanApproved = $this->getBankApproval([
            'amount' => $dealerData['price'],
            'insurancePremium' => $insurancePremium['premium']
        ]);

        if (!$loanApproved || !isset($loanApproved['approved'])) {
            throw new \RuntimeException('Unable to get bank approval.');
        }

        $dto = new CarRequestDTO(
            $customerName,
            $carModel,
            (float)$dealerData['price'],
            (array)$dealerData['specs'],
            (float)$insurancePremium['premium'],
            (bool)$loanApproved['approved']
        );

        CarRequest::create($dto->toArray());

        return $dto;
    }

    /**
     * Get bank loan approval status from API.
     *
     * @param array $payload
     * @return array|null
     */
    private function getBankApproval(array $payload): ?array
    {
        try {
            $response = Http::asJson()->post(self::BASE_URL . 'bank/loan-approval', $payload);

            if ($response->successful()) {
                return $response->json();
            }

            Log::warning('Bank loan approval API returned error', [
                'status' => $response->status(),
                'payload' => $payload,
                'body' => $response->body(),
            ]);

            throw new ApiException('Bank loan approval API returned error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        } catch (\Throwable $e) {
            Log::critical('Error fetching bank loan approval', [
                'message' => $e->getMessage(),
                'payload' => $payload,
            ]);
            throw new ApiException('Exception occurred while fetching bank loan approval', [
                'exception_message' => $e->getMessage(),
            ], 0, $e);
        }
    }

    /**
     * Get car details from dealer API.
     *
     * @param array $payload
     * @return array|null
     */
    private function getCarDetails(array $payload): ?array
    {
        try {
            $response = Http::asJson()->post(self::BASE_URL . 'dealer/car/details', $payload);

            if ($response->successful()) {
                return $response->json();
            }

            Log::warning('Car details API returned error', [
                'status' => $response->status(),
                'payload' => $payload,
                'body' => $response->body(),
            ]);

            throw new ApiException('Car details API returned error ', [
                'status' => $response->status(),
                'body' => $response->body(),
                ''
            ]);

        } catch (\Throwable $e) {

            Log::critical('Error fetching car details', [
                'message' => $e->getMessage(),
                'payload' => $payload,
            ]);

            throw new ApiException('getCarDetails error: ' . $e->getMessage());
        }
    }

    /**
     * Get insurance premium from API.
     *
     * @param array $payload
     * @return array|null
     */
    private function getInsurancePremium(array $payload): ?array
    {
        try {
            $response = Http::asJson()->post(self::BASE_URL . 'insurance/premium', $payload);

            if ($response->successful()) {
                return $response->json();
            }

            Log::warning('Insurance premium API returned error', [
                'status' => $response->status(),
                'payload' => $payload,
                'body' => $response->body(),
            ]);

            throw new ApiException('Insurance premium API returned error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

        } catch (\Throwable $e) {
            Log::critical('Error fetching insurance premium', [
                'message' => $e->getMessage(),
                'payload' => $payload,
            ]);

            throw new ApiException('Error: ', [
                'exception_message' => $e->getMessage(),
            ], 0, $e);
        }
    }

}
