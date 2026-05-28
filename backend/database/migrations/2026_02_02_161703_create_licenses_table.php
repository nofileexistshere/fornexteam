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
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('License');
            $table->text('description');
            
            // Detail Legal Section
            $table->string('nib');
            $table->string('npwp')->nullable();
            $table->string('company_name');
            $table->string('category');
            
            // Riwayat Proses (stored as JSON array)
            $table->json('process_history');
            
            // Terms & Privacy Summary
            $table->json('terms_summary');
            $table->json('privacy_summary');
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};
