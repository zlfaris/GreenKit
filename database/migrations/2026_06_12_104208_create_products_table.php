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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('slug')->unique();
            $table->text('deskripsi');
            $table->integer('harga');
            $table->integer('berat')->default(1000);
            $table->integer('stok')->default(0);
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('jumlah_ulasan')->default(0);
            $table->string('foto_produk')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
