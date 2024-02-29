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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->tinyText('first_name')->nullable();
            $table->mediumText('last_name')->nullable();
            $table->string('email',50)->nullable();
            $table->string('phone',10)->nullable();
            $table->string('password')->nullable();
            $table->string('gender',6)->nullable();
            $table->timestamps(); 
            $table->string('google_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
