<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, update any existing 'Entreprise' values to 'societe'
        DB::table('clients')
            ->where('type', 'Entreprise')
            ->update(['type' => 'societe']);
        
        // Then modify the enum to accept 'societe' instead of 'Entreprise'
        DB::statement("ALTER TABLE `clients` MODIFY `type` ENUM('particulier', 'societe') NOT NULL DEFAULT 'particulier'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to 'Entreprise'
        DB::table('clients')
            ->where('type', 'societe')
            ->update(['type' => 'Entreprise']);
            
        DB::statement("ALTER TABLE `clients` MODIFY `type` ENUM('particulier', 'Entreprise') NOT NULL DEFAULT 'particulier'");
    }
};
