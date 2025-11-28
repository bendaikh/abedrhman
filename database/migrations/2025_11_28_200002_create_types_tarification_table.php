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
        Schema::create('types_tarification', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // e.g., "Standard", "Promotionnelle", "Conventionnelle", "Préférentielle"
            $table->string('code')->unique(); // e.g., "standard", "promotionnelle", etc.
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
        Schema::dropIfExists('types_tarification');
    }
};

