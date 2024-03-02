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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->mediumText('payment_id');
            $table->mediumText('product_name');
            $table->tinyInteger('quantity');
            $table->string('amount');
            $table->tinyText('currency');
            $table->mediumText('customer_name');
            $table->string('customer_email');
            $table->mediumText('payment_status');
            $table->mediumText('payment_method');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
