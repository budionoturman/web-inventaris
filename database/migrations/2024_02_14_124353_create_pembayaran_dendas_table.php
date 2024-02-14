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
        Schema::create('pembayaran_dendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id');
            $table->string('tgl_bayar');
            $table->string('file_name');
            $table->string('path');
            $table->string('file_type');
            $table->string('size');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_dendas');
    }
};
