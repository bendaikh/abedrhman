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
        Schema::create('activites', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->foreignId('type_activite_id')->constrained('types_activites')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->datetime('date_debut')->nullable();
            $table->datetime('date_fin')->nullable();
            $table->string('lieu')->nullable();
            $table->integer('capacite')->nullable();
            $table->decimal('prix', 10, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activites');
    }
};











