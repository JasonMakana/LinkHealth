<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Corre los cambios en la base de datos.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nfc_id')->nullable()->unique()->after('role');
        });
    }

   
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nfc_id');
        });
    }
};