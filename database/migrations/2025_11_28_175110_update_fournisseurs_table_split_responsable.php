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
        Schema::table('fournisseurs', function (Blueprint $table) {
            // Rename responsable to responsable_nom
            $table->renameColumn('responsable', 'responsable_nom');
            // Add responsable_prenom after responsable_nom
            $table->string('responsable_prenom')->nullable()->after('responsable_nom');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fournisseurs', function (Blueprint $table) {
            // Drop responsable_prenom
            $table->dropColumn('responsable_prenom');
            // Rename responsable_nom back to responsable
            $table->renameColumn('responsable_nom', 'responsable');
        });
    }
};
