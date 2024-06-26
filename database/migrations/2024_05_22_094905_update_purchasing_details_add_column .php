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
        Schema::table('purchasing_details', function (Blueprint $table) {
            $table->string('code_trans');
            $table->bigInteger('id_purchase')->unsigned()->nullable();
            $table->foreign('id_purchase')->references('id')->on('purchasings');

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchasing_details', function (Blueprint $table) {
            //
        });
    }
};
