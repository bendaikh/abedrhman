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
        Schema::table('dirigeants', function (Blueprint $table) {
            $table->string('type_piece_id')->nullable()->after('fonction');
            $table->string('n_piece_id')->nullable()->after('type_piece_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dirigeants', function (Blueprint $table) {
            $table->dropColumn(['type_piece_id', 'n_piece_id']);
        });
    }
};
