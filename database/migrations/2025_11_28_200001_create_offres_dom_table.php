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
        Schema::create('offres_dom', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // e.g., "DOM 6 MOIS", "DOM 1 ans", etc.
            $table->integer('duree_mois'); // Duration in months
            $table->boolean('is_active')->default(true);
            $table->integer('ordre')->default(0); // For sorting
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offres_dom');
    }
};

