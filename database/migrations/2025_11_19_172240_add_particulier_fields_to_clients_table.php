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
            if (!Schema::hasColumn('clients', 'fonction')) {
                $table->string('fonction')->nullable()->after('type');
            }
            if (!Schema::hasColumn('clients', 'type_piece_id')) {
                $table->string('type_piece_id')->nullable()->after('fonction');
            }
            if (!Schema::hasColumn('clients', 'date_naissance')) {
                $table->date('date_naissance')->nullable()->after('type_piece_id');
            }
            if (!Schema::hasColumn('clients', 'lieu_naissance')) {
                $table->string('lieu_naissance')->nullable()->after('date_naissance');
            }
            if (!Schema::hasColumn('clients', 'nationalite')) {
                $table->string('nationalite')->nullable()->after('lieu_naissance');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $columns = ['fonction', 'type_piece_id', 'date_naissance', 'lieu_naissance', 'nationalite'];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('clients', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
