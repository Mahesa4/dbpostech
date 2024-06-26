<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sellings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->bigInteger('cashier_id')->unsigned()->nullable();
            $table->date('date_sell');
            $table->enum('product_status', ['delivery','not_delivery'])->default('not_delivery');
            $table->Integer('grand_total');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('users');
            $table->foreign('cashier_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sellings');
    }
};
