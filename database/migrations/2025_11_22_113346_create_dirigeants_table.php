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
        Schema::create('dirigeants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('intitule')->nullable(); // Mr, Mme, etc.
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('fonction')->nullable(); // Gérant, etc.
            $table->string('piece_id')->nullable(); // CIN, PASSPORT, etc.
            $table->date('date_naissance')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('nationalite')->nullable();
            $table->text('adresse')->nullable();
            $table->string('ville')->nullable();
            $table->string('pays')->nullable();
            $table->string('tel1_resp')->nullable();
            $table->string('tel2_resp')->nullable();
            $table->string('email_resp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dirigeants');
    }
};
