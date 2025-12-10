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
        Schema::create('offres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_service_id')->constrained('types_services')->onDelete('cascade');
            $table->string('nom');
            $table->string('description')->nullable();
            $table->integer('duree_mois')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('ordre')->default(0);
            $table->timestamps();
        });

        Schema::create('tarifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offre_id')->constrained('offres')->onDelete('cascade');
            $table->foreignId('type_tarification_id')->constrained('types_tarification')->onDelete('cascade');
            $table->decimal('prix', 10, 2)->default(0);
            $table->boolean('is_default')->default(false);
            $table->timestamps();
            
            $table->unique(['offre_id', 'type_tarification_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarifications');
        Schema::dropIfExists('offres');
    }
};

