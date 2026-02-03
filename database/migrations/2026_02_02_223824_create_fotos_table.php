<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    function up(): void
    {
        Schema::create('foto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idvacacion');
            $table->string('ruta', 100);
            $table->timestamps();
            $table->foreign('idvacacion')->references('id')->on('vacacion');
        });
    }

    function down(): void
    {
        Schema::dropIfExists('foto');
    }
};