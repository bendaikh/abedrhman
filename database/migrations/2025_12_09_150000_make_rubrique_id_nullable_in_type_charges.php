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
        Schema::table('type_charges', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['rubrique_id']);
            
            // Make rubrique_id nullable
            $table->foreignId('rubrique_id')->nullable()->change();
            
            // Re-add the foreign key with SET NULL on delete
            $table->foreign('rubrique_id')
                ->references('id')
                ->on('rubriques')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('type_charges', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['rubrique_id']);
            
            // Make rubrique_id required again
            $table->foreignId('rubrique_id')->nullable(false)->change();
            
            // Re-add the foreign key with CASCADE on delete
            $table->foreign('rubrique_id')
                ->references('id')
                ->on('rubriques')
                ->onDelete('cascade');
        });
    }
};

