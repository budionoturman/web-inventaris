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
        Schema::create('pengadaan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengadaan_id');
            $table->foreignId('barang_id')->nullable();
            $table->string('barang_name')->nullable();
            $table->string('kategori_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengadaan_details');
    }
};
