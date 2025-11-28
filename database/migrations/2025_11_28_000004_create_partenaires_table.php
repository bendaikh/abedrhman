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
        Schema::create('partenaires', function (Blueprint $table) {
            $table->id();
            $table->string('raison_sociale')->nullable();
            $table->string('responsable')->nullable();
            $table->string('fonction')->nullable();
            $table->string('activite')->nullable();
            $table->string('tel')->nullable();
            $table->string('email')->nullable();
            $table->text('adresse')->nullable();
            $table->string('ice')->nullable();
            $table->string('rib')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partenaires');
    }
};



