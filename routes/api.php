<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\DealerController;
use App\Http\Controllers\Api\InsuranceController;
use App\Http\Controllers\Api\BankController;
use App\Http\Controllers\Api\CarPurchaseController;

Route::post('/dealer/car/details', [DealerController::class, 'getCarDetails']);
Route::post('/insurance/premium', [InsuranceController::class, 'getInsurancePremium']);
Route::post('/bank/loan-approval', [BankController::class, 'getLoanApproval']);
Route::post('/car-request', [CarPurchaseController::class, 'handleRequest']);
