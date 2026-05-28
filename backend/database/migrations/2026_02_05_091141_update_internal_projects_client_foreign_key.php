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
        // Set existing client_id to null to avoid constraint errors
        \DB::table('internal_projects')->update(['client_id' => null]);
        
        // Get the foreign key name
        $foreignKey = \DB::select("
            SELECT CONSTRAINT_NAME 
            FROM information_schema.KEY_COLUMN_USAGE 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = 'internal_projects' 
            AND COLUMN_NAME = 'client_id' 
            AND CONSTRAINT_NAME != 'PRIMARY'
        ");
        
        // Drop the foreign key if it exists
        if (!empty($foreignKey)) {
            $constraintName = $foreignKey[0]->CONSTRAINT_NAME;
            \DB::statement("ALTER TABLE internal_projects DROP FOREIGN KEY `{$constraintName}`");
        }
        
        Schema::table('internal_projects', function (Blueprint $table) {
            // Add new foreign key to invoice_clients
            $table->foreign('client_id')
                ->references('id')
                ->on('invoice_clients')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('internal_projects', function (Blueprint $table) {
            // Drop new foreign key
            $table->dropForeign(['client_id']);
            
            // Restore old foreign key to clients
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('set null');
        });
    }
};
