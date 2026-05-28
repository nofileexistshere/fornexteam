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
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->default('#nexteam');
            $table->string('heading');
            $table->text('description');
            $table->string('image_light')->nullable();
            $table->string('image_dark')->nullable();
            $table->string('primary_button_text')->default('View Projects');
            $table->string('primary_button_url')->default('/project');
            $table->string('secondary_button_text')->default('Watch Video');
            $table->string('secondary_button_url')->nullable();
            $table->boolean('show_secondary_button')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};
