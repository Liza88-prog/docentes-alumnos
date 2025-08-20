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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false);       // Para indicar si el usuario es admin
            $table->string('phone')->nullable();               // Teléfono del usuario
            $table->string('professional_url')->nullable();   // URL profesional o LinkedIn
            $table->string('photo_path')->nullable();         // Ruta de la foto de perfil//
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_admin', 'phone', 'professional_url', 'photo_path']);//
        });
    }
};
