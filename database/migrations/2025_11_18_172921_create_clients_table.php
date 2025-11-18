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
        if (Schema::hasTable('clients')) {
            return; // Table already exists, skip creation
        }
        
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('num_client')->unique()->nullable(); // Num client
            $table->enum('type', ['particulier', 'Entreprise'])->default('particulier'); // Type: particulier or Entreprise
            $table->string('nom_raison_sociale')->nullable(); // Nom / raison sociale
            $table->string('sigle')->nullable(); // Sigle
            $table->string('intitule')->nullable(); // Intitulé
            $table->string('forme_juridique')->nullable(); // Forme juridique
            $table->string('piece_justificative')->nullable(); // Pièce justificative
            $table->string('numero_piece')->nullable(); // N° pièce
            $table->date('date_creation')->nullable(); // Date création
            $table->string('forme_juridique_creee')->nullable(); // Forme juridique créée
            $table->text('siege_social')->nullable(); // Siège social
            $table->string('ville')->nullable(); // Ville
            $table->string('pays')->nullable(); // Pays
            $table->string('secteur_activite')->nullable(); // Secteur d'activité
            $table->string('activite')->nullable(); // Activité
            $table->text('autre_adresse_activite')->nullable(); // Autre adresse d'activité
            $table->text('adresse_depot_magasin')->nullable(); // Adresse (dépôt ou magasin)
            $table->string('tel_1')->nullable(); // Tél 1
            $table->string('tel_2')->nullable(); // Tél 2
            $table->string('fixe')->nullable(); // fixe
            $table->string('email')->nullable(); // Email
            $table->text('observations')->nullable(); // Observations
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
