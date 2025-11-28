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
        Schema::table('comptes_associes', function (Blueprint $table) {
            $table->string('nom')->nullable()->after('id');
            $table->string('prenom')->nullable()->after('nom');
        });

        // Migrate existing data: split nom_prenom into nom and prenom
        $comptesAssocies = \DB::table('comptes_associes')->whereNotNull('nom_prenom')->get();
        foreach ($comptesAssocies as $compte) {
            $parts = explode(' ', $compte->nom_prenom, 2);
            $nom = $parts[0] ?? '';
            $prenom = $parts[1] ?? '';
            \DB::table('comptes_associes')
                ->where('id', $compte->id)
                ->update(['nom' => $nom, 'prenom' => $prenom]);
        }

        Schema::table('comptes_associes', function (Blueprint $table) {
            $table->dropColumn('nom_prenom');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comptes_associes', function (Blueprint $table) {
            $table->string('nom_prenom')->nullable()->after('id');
        });

        // Migrate data back
        $comptesAssocies = \DB::table('comptes_associes')->get();
        foreach ($comptesAssocies as $compte) {
            $nomPrenom = trim(($compte->nom ?? '') . ' ' . ($compte->prenom ?? ''));
            \DB::table('comptes_associes')
                ->where('id', $compte->id)
                ->update(['nom_prenom' => $nomPrenom ?: null]);
        }

        Schema::table('comptes_associes', function (Blueprint $table) {
            $table->dropColumn(['nom', 'prenom']);
        });
    }
};

