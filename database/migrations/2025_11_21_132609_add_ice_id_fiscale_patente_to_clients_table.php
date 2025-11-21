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
        Schema::table('clients', function (Blueprint $table) {
            $table->string('ice')->nullable()->after('numero_piece');
            $table->string('id_fiscale')->nullable()->after('ice');
            $table->string('patente')->nullable()->after('id_fiscale');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn(['ice', 'id_fiscale', 'patente']);
        });
    }
};
