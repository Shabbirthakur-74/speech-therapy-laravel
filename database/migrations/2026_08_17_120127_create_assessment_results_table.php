<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessment_results', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_id')
                ->constrained('patients')
                ->cascadeOnDelete();

            $table->uuid('session_id');

            $table->string('assessment_type');

            $table->json('result_data');

            $table->timestamps();

            $table->index('session_id');
            $table->index(['patient_id', 'session_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_results');
    }
};