<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CarRequest extends Model
{
    protected $fillable = [
        'customer_name',
        'car_model',
        'car_price',
        'car_specs',
        'insurance_premium',
        'loan_approved',
    ];

    protected $casts = [
        'car_specs' => 'array',
        'loan_approved' => 'boolean',
        'car_price' => 'float',
        'insurance_premium' => 'float',
    ];
}