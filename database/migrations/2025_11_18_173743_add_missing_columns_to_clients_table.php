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
            // Check if columns don't exist before adding them
            if (!Schema::hasColumn('clients', 'type')) {
                $table->enum('type', ['particulier', 'Entreprise'])->default('particulier')->after('num_client');
            }
            if (!Schema::hasColumn('clients', 'nom_raison_sociale')) {
                $table->string('nom_raison_sociale')->nullable()->after('type');
            }
            if (!Schema::hasColumn('clients', 'sigle')) {
                $table->string('sigle')->nullable()->after('nom_raison_sociale');
            }
            if (!Schema::hasColumn('clients', 'intitule')) {
                $table->string('intitule')->nullable()->after('sigle');
            }
            if (!Schema::hasColumn('clients', 'forme_juridique')) {
                $table->string('forme_juridique')->nullable()->after('intitule');
            }
            if (!Schema::hasColumn('clients', 'piece_justificative')) {
                $table->string('piece_justificative')->nullable()->after('forme_juridique');
            }
            if (!Schema::hasColumn('clients', 'numero_piece')) {
                $table->string('numero_piece')->nullable()->after('piece_justificative');
            }
            if (!Schema::hasColumn('clients', 'date_creation')) {
                $table->date('date_creation')->nullable()->after('numero_piece');
            }
            if (!Schema::hasColumn('clients', 'forme_juridique_creee')) {
                $table->string('forme_juridique_creee')->nullable()->after('date_creation');
            }
            if (!Schema::hasColumn('clients', 'siege_social')) {
                $table->text('siege_social')->nullable()->after('forme_juridique_creee');
            }
            if (!Schema::hasColumn('clients', 'ville')) {
                $table->string('ville')->nullable()->after('siege_social');
            }
            if (!Schema::hasColumn('clients', 'pays')) {
                $table->string('pays')->nullable()->after('ville');
            }
            if (!Schema::hasColumn('clients', 'secteur_activite')) {
                $table->string('secteur_activite')->nullable()->after('pays');
            }
            if (!Schema::hasColumn('clients', 'activite')) {
                $table->string('activite')->nullable()->after('secteur_activite');
            }
            if (!Schema::hasColumn('clients', 'autre_adresse_activite')) {
                $table->text('autre_adresse_activite')->nullable()->after('activite');
            }
            if (!Schema::hasColumn('clients', 'adresse_depot_magasin')) {
                $table->text('adresse_depot_magasin')->nullable()->after('autre_adresse_activite');
            }
            if (!Schema::hasColumn('clients', 'tel_1')) {
                $table->string('tel_1')->nullable()->after('adresse_depot_magasin');
            }
            if (!Schema::hasColumn('clients', 'tel_2')) {
                $table->string('tel_2')->nullable()->after('tel_1');
            }
            if (!Schema::hasColumn('clients', 'fixe')) {
                $table->string('fixe')->nullable()->after('tel_2');
            }
            if (!Schema::hasColumn('clients', 'email')) {
                $table->string('email')->nullable()->after('fixe');
            }
            if (!Schema::hasColumn('clients', 'observations')) {
                $table->text('observations')->nullable()->after('email');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $columns = [
                'type', 'nom_raison_sociale', 'sigle', 'intitule', 'forme_juridique',
                'piece_justificative', 'numero_piece', 'date_creation', 'forme_juridique_creee',
                'siege_social', 'ville', 'pays', 'secteur_activite', 'activite',
                'autre_adresse_activite', 'adresse_depot_magasin', 'tel_1', 'tel_2',
                'fixe', 'email', 'observations'
            ];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('clients', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
