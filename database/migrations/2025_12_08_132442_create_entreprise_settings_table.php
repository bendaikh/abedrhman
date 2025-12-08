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
        Schema::create('entreprise_settings', function (Blueprint $table) {
            $table->id();
            
            // Informations générales
            $table->string('raison_sociale')->nullable();
            $table->string('sigle')->nullable();
            $table->string('forme_juridique')->nullable();
            $table->string('capital_social')->nullable();
            $table->string('ice')->nullable();
            $table->string('id_fiscale')->nullable();
            $table->string('patente')->nullable();
            $table->string('rc')->nullable();
            $table->string('cnss')->nullable();
            $table->date('date_creation')->nullable();
            
            // Adresse
            $table->text('siege_social')->nullable();
            $table->string('ville')->nullable();
            $table->string('pays')->nullable()->default('Maroc');
            
            // Contact
            $table->string('tel_1')->nullable();
            $table->string('tel_2')->nullable();
            $table->string('fixe')->nullable();
            $table->string('email')->nullable();
            $table->string('site_web')->nullable();
            
            // Secteur
            $table->string('secteur_activite')->nullable();
            $table->text('activite_principale')->nullable();
            
            // Logo
            $table->string('logo_path')->nullable();
            
            $table->timestamps();
        });

        // Table for dirigeants
        Schema::create('entreprise_dirigeants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entreprise_setting_id')->constrained()->onDelete('cascade');
            $table->string('nom');
            $table->string('prenom')->nullable();
            $table->string('fonction')->nullable();
            $table->string('cin')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_representant_legal')->default(false);
            $table->timestamps();
        });

        // Table for associés
        Schema::create('entreprise_associes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entreprise_setting_id')->constrained()->onDelete('cascade');
            $table->string('nom');
            $table->string('prenom')->nullable();
            $table->string('cin')->nullable();
            $table->decimal('parts_sociales', 10, 2)->nullable();
            $table->decimal('pourcentage', 5, 2)->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entreprise_associes');
        Schema::dropIfExists('entreprise_dirigeants');
        Schema::dropIfExists('entreprise_settings');
    }
};
