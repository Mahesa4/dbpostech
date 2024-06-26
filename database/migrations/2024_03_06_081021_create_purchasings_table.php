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
        Schema::create('purchasings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vendor_id')->unsigned()->nullable();
            $table->bigInteger('admin_id')->unsigned()->nullable();
            $table->date('date_purchase');
            $table->enum('purchase_status', ['delivery','not_delivery'])->default('not_delivery');
            $table->integer('grand_total');
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('users');
            $table->foreign('admin_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchasings');
    }
};
