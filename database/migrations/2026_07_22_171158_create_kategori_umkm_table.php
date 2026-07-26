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
        Schema::create('kategori_umkm', function (Blueprint $table) {
            $table->foreignId('kategori_id')->constrained('kategori_produk')->onDelete('cascade');
            $table->foreignId('umkm_id')->constrained('umkm')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_umkm');
    }
};
