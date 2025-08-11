<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('car_requests', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('car_model');
            $table->decimal('car_price', 10, 2);
            $table->json('car_specs');
            $table->decimal('insurance_premium', 10, 2)->nullable();
            $table->boolean('loan_approved')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('car_requests');
    }
}
