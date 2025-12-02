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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->decimal('montant_total', 10, 2);
            $table->decimal('montant_paye', 10, 2)->default(0);
            $table->date('date_facture');
            $table->date('date_echeance')->nullable();
            $table->enum('statut', ['brouillon', 'envoyee', 'payee', 'partielle', 'annulee'])->default('envoyee');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};

