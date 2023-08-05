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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('customer');
            $table->string('employee');
            $table->string('services');
            $table->string('products');
            $table->string('quantity');
            $table->integer('gcash');
            $table->integer('gift_certificate');
            $table->integer('gift_voucher');
            $table->integer('loyalty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
