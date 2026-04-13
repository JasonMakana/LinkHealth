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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nss')->unique();
            $table->string('name');
            $table->string('apellido_P');
            $table->string('apellido_M');
            $table->string('CURP');
            $table->string('fraccionamiento');
            $table->string('colonia');
            $table->string('no_Ext');
            $table->string('no_Int');
            $table->string('nfc_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
