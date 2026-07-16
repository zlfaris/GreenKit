<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nama_produk',
        'slug',
        'deskripsi',
        'harga',
        'berat',
        'stok',
        'rating',
        'jumlah_ulasan',
        'foto_produk',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
