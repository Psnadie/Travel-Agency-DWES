<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    function up(): void
    {
        Schema::create('vacacion', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 100);
            $table->text('descripcion');
            $table->decimal('precio', 8, 2);
            $table->string('pais', 100);
            $table->foreignId('idtipo');
            $table->timestamps();
            $table->foreign('idtipo')->references('id')->on('tipo');
        });
    }

    function down(): void
    {
        Schema::dropIfExists('vacacion');
    }
};