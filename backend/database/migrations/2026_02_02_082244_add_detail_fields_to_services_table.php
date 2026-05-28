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
        Schema::table('services', function (Blueprint $table) {
            $table->text('why_need')->nullable()->after('description');
            $table->json('benefits')->nullable()->after('why_need');
            $table->json('workflow')->nullable()->after('benefits');
            $table->json('platforms')->nullable()->after('workflow');
            $table->text('contact_message')->nullable()->after('platforms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['why_need', 'benefits', 'workflow', 'platforms', 'contact_message']);
        });
    }
};
