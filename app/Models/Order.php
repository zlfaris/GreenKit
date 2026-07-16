<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'nomor_pesanan',
        'user_id',
        'nama_depan',
        'nama_belakang',
        'email_pembeli',
        'nomor_telepon',
        'alamat_jalan',
        'kota',
        'negara',
        'kodepos',
        'subtotal',
        'ongkir',
        'total_harga',
        'biaya_admin',
        'provinsi_id',
        'kota_id',
        'kurir',
        'layanan',
        'resi_pengiriman',
        'bukti_pembayaran',
        'status_pesanan',
        'nomor_whatsapp',
        'status_pembayaran',
        'sinkron_n8n',
        'payment_proof',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
