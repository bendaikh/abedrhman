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
        Schema::create('tarifications_dom', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offre_dom_id')->constrained('offres_dom')->onDelete('cascade');
            $table->foreignId('type_tarification_id')->constrained('types_tarification')->onDelete('cascade');
            $table->decimal('prix', 10, 2); // Price in DH
            $table->boolean('is_default')->default(false);
            $table->timestamps();
            
            // Unique constraint to prevent duplicate entries
            $table->unique(['offre_dom_id', 'type_tarification_id'], 'offre_type_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarifications_dom');
    }
};

