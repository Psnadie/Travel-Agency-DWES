<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    function up(): void
    {
        Schema::table('foto', function (Blueprint $table) {
            $table->dropForeign(['idvacacion']);
            $table->foreign('idvacacion')->references('id')->on('vacacion')->onDelete('cascade');
        });
    }

    function down(): void
    {
        Schema::table('foto', function (Blueprint $table) {
            $table->dropForeign(['idvacacion']);
            $table->foreign('idvacacion')->references('id')->on('vacacion');
        });
    }
};
