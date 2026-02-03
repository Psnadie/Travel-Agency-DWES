<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    function up(): void
    {
        Schema::create('comentario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('iduser');
            $table->foreignId('idvacacion');
            $table->text('texto');
            $table->timestamps();
            $table->foreign('iduser')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idvacacion')->references('id')->on('vacacion')->onDelete('cascade');
        });
    }

    function down(): void
    {
        Schema::dropIfExists('comentario');
    }
};