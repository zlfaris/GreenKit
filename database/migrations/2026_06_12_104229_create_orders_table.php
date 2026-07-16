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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pesanan')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('nama_depan');
            $table->string('nama_belakang');
            $table->string('email_pembeli');
            $table->string('nomor_telepon');
            $table->text('alamat_jalan');
            $table->string('provinsi_id');
            $table->string('kota_id');
            $table->string('kota');
            $table->string('negara');
            $table->string('kodepos');
            $table->string('kurir')->nullable();
            $table->string('layanan')->nullable();
            $table->integer('subtotal');
            $table->integer('ongkir');
            $table->integer('total_harga');
            $table->integer('biaya_admin')->default(0);
            $table->string('bukti_pembayaran')->nullable();
            $table->string('resi_pengiriman')->nullable();
            $table->enum('status_pesanan', ['pending', 'proses', 'selesai'])->default('pending');
            $table->string('nomor_whatsapp');
            $table->enum('status_pembayaran', ['belum_bayar', 'diproses_bot', 'lunas'])->default('belum_bayar');
            $table->boolean('sinkron_n8n')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
