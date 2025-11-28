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
        // Update administrations table
        Schema::table('administrations', function (Blueprint $table) {
            $table->renameColumn('responsable', 'responsable_nom');
            $table->string('responsable_prenom')->nullable()->after('responsable_nom');
            $table->string('fonction')->nullable()->after('responsable_prenom');
        });

        // Update partenaires table
        Schema::table('partenaires', function (Blueprint $table) {
            $table->renameColumn('responsable', 'responsable_nom');
            $table->string('responsable_prenom')->nullable()->after('responsable_nom');
        });

        // Update comptables table
        Schema::table('comptables', function (Blueprint $table) {
            $table->renameColumn('responsable', 'responsable_nom');
            $table->string('responsable_prenom')->nullable()->after('responsable_nom');
            $table->string('fonction')->nullable()->after('responsable_prenom');
        });

        // Update bailleurs table
        Schema::table('bailleurs', function (Blueprint $table) {
            $table->renameColumn('responsable', 'responsable_nom');
            $table->string('responsable_prenom')->nullable()->after('responsable_nom');
            $table->string('fonction')->nullable()->after('responsable_prenom');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse administrations table
        Schema::table('administrations', function (Blueprint $table) {
            $table->dropColumn(['responsable_prenom', 'fonction']);
            $table->renameColumn('responsable_nom', 'responsable');
        });

        // Reverse partenaires table
        Schema::table('partenaires', function (Blueprint $table) {
            $table->dropColumn('responsable_prenom');
            $table->renameColumn('responsable_nom', 'responsable');
        });

        // Reverse comptables table
        Schema::table('comptables', function (Blueprint $table) {
            $table->dropColumn(['responsable_prenom', 'fonction']);
            $table->renameColumn('responsable_nom', 'responsable');
        });

        // Reverse bailleurs table
        Schema::table('bailleurs', function (Blueprint $table) {
            $table->dropColumn(['responsable_prenom', 'fonction']);
            $table->renameColumn('responsable_nom', 'responsable');
        });
    }
};
