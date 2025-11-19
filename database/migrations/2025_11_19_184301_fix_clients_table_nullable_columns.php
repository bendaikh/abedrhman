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
        Schema::table('clients', function (Blueprint $table) {
            // Make all société-specific fields nullable
            $table->string('nom_raison_sociale')->nullable()->change();
            $table->string('sigle')->nullable()->change();
            $table->string('intitule')->nullable()->change();
            $table->string('forme_juridique')->nullable()->change();
            $table->string('piece_justificative')->nullable()->change();
            $table->string('numero_piece')->nullable()->change();
            $table->date('date_creation')->nullable()->change();
            $table->string('forme_juridique_creee')->nullable()->change();
            $table->text('siege_social')->nullable()->change();
            $table->string('ville')->nullable()->change();
            $table->string('pays')->nullable()->change();
            $table->string('secteur_activite')->nullable()->change();
            $table->string('activite')->nullable()->change();
            $table->text('autre_adresse_activite')->nullable()->change();
            $table->text('adresse_depot_magasin')->nullable()->change();
            $table->string('tel_1')->nullable()->change();
            $table->string('tel_2')->nullable()->change();
            $table->string('fixe')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->text('observations')->nullable()->change();
            
            // Make particulier-specific fields nullable
            $table->string('fonction')->nullable()->change();
            $table->string('type_piece_id')->nullable()->change();
            $table->date('date_naissance')->nullable()->change();
            $table->string('lieu_naissance')->nullable()->change();
            $table->string('nationalite')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse - making columns nullable is a safe operation
    }
};
