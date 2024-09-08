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
        Schema::create('perbandingan_kriteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kriteria_id1')->references('id')->on('kriteria')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('kriteria_id2')->references('id')->on('kriteria')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('nilai', 4, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbandingan_kriteria');
    }
};
