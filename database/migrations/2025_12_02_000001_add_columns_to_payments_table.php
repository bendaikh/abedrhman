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
        // First, modify the mode_paiement enum to add 'lcn'
        // For SQLite, we need to recreate the column
        if (DB::getDriverName() === 'sqlite') {
            // SQLite doesn't support modifying enums, so we'll use string instead
            Schema::table('payments', function (Blueprint $table) {
                $table->string('numero_transaction')->nullable()->after('reference');
                $table->date('date_emission')->nullable()->after('numero_transaction');
                $table->date('date_echeance')->nullable()->after('date_emission');
                $table->boolean('encaisse')->default(true)->after('date_echeance');
                $table->string('numero_recu')->nullable()->after('encaisse');
                $table->text('commentaire')->nullable()->after('numero_recu');
            });
        } else {
            // For MySQL/PostgreSQL
            Schema::table('payments', function (Blueprint $table) {
                $table->string('numero_transaction')->nullable()->after('reference');
                $table->date('date_emission')->nullable()->after('numero_transaction');
                $table->date('date_echeance')->nullable()->after('date_emission');
                $table->boolean('encaisse')->default(true)->after('date_echeance');
                $table->string('numero_recu')->nullable()->after('encaisse');
                $table->text('commentaire')->nullable()->after('numero_recu');
            });
            
            // Modify the enum to add 'lcn'
            DB::statement("ALTER TABLE payments MODIFY mode_paiement ENUM('especes', 'cheque', 'virement', 'carte', 'lcn') DEFAULT 'especes'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn([
                'numero_transaction',
                'date_emission',
                'date_echeance',
                'encaisse',
                'numero_recu',
                'commentaire',
            ]);
        });
        
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE payments MODIFY mode_paiement ENUM('especes', 'cheque', 'virement', 'carte') DEFAULT 'especes'");
        }
    }
};

