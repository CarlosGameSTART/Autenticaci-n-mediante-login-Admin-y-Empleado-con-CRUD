<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Agrega la columna para eliminación lógica
            $table->softDeletes();

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Elimina la columna si se revierte la migración
            $table->dropSoftDeletes();

        });
    }
};
