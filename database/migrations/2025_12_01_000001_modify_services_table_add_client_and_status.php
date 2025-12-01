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
        Schema::table('services', function (Blueprint $table) {
            // Add client_id foreign key
            $table->foreignId('client_id')->nullable()->after('id')->constrained('clients')->onDelete('cascade');
            
            // Add status field
            $table->enum('status', ['initialiser', 'en_cours', 'termine', 'annule'])->default('initialiser')->after('is_active');
            
            // Make nom nullable (we'll keep it for backward compatibility but won't use it)
            $table->string('nom')->nullable()->change();
            
            // Make duree and unite_duree nullable
            $table->integer('duree')->nullable()->change();
            $table->enum('unite_duree', ['heure', 'jour', 'semaine', 'mois', 'annee'])->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropColumn(['client_id', 'status']);
            
            // Restore original columns
            $table->string('nom')->nullable(false)->change();
            $table->enum('unite_duree', ['heure', 'jour', 'semaine', 'mois', 'annee'])->default('mois')->change();
        });
    }
};

