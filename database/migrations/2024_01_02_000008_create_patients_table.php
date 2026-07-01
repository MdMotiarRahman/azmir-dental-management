<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id')->unique()->comment('Auto-generated unique patient identifier');
            $table->string('name');
            $table->string('phone', 20);
            $table->string('email')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('blood_group', 10)->nullable();
            $table->text('address')->nullable();
            $table->text('medical_notes')->nullable();
            $table->timestamps();

            $table->index('phone');
            $table->index('name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
