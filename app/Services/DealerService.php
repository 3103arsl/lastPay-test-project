<?php

namespace App\Services;

class DealerService
{
    /**
     * @param string $model
     * @return array
     */
    public function getCarDetails(string $model): array
    {
        $cars = [
            'Tesla Model 3' => [
                'model' => 'Tesla Model 3',
                'price' => 45000,
                'specs' => ['Electric', '0-60 mph in 3.1s', 'Range 358 miles'],
            ],
            'BMW X5' => [
                'model' => 'BMW X5',
                'price' => 60000,
                'specs' => ['Gasoline', '0-60 mph in 5.3s', 'AWD'],
            ],
            // Add more mock cars as needed
        ];

        return $cars[$model] ?? [
            'model' => $model,
            'price' => 30000,
            'specs' => ['Standard specs'],
        ];
    }
}
