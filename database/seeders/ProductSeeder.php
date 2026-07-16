<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $products = [
            [
                'nama_produk' => 'GreenKit Starter Pack',
                'slug' => 'greenkit-starter-pack',
                'harga' => 50000,
                'berat' => 150,
                'deskripsi' => 'GreenKit Starter Pack hadir sebagai solusi sederhana untuk kebiasaan sehari-hari yang lebih ramah lingkungan. Dalam satu pouch kanvas putih praktis, tersedia sendok, garpu, dan sumpit kayu, dilengkapi sedotan stainless serta sikat pembersih. Ringkas, fungsional, dan mudah dibawa.',
                'foto_produk' => 'images/product-starter-pack.png',
                'stok' => 50,
                'rating' => 4.5,
                'jumlah_ulasan' => 288,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_produk' => 'GreenKit Timber Signature Edition',
                'slug' => 'greenkit-timber-signature-edition',
                'harga' => 60000,
                'berat' => 250,
                'deskripsi' => 'Tingkatkan gaya hidup berkelanjutan Anda dengan Timber Signature Edition. Set alat makan kayu dan sedotan stainless steel ini dikemas secara elegan dalam kotak bambu solid yang kokoh, memberikan perlindungan ekstra dan tampilan premium saat dibawa bepergian.',
                'foto_produk' => 'images/product-timber-edition.png',
                'stok' => 50,
                'rating' => 4.5,
                'jumlah_ulasan' => 288,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_produk' => 'GreenKit Complete Eco-Warrior',
                'slug' => 'greenkit-complete-eco-warrior',
                'harga' => 65000,
                'berat' => 300,
                'deskripsi' => 'Paket terlengkap untuk pahlawan bumi! Dapatkan tote bag kanvas putih multifungsi yang dirancang khusus dengan kantong depan terintegrasi. Kantong ini menyimpan set alat makan kayu lengkap (sendok, garpu, sumpit) dan sedotan stainless steel Anda dengan aman.',
                'foto_produk' => 'images/product-eco-warrior.png',
                'stok' => 50,
                'rating' => 4.5,
                'jumlah_ulasan' => 288,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_produk' => 'GreenKit Starter Pack: Forest Edition',
                'slug' => 'greenkit-starter-pack-forest-edition',
                'harga' => 50000,
                'berat' => 150,
                'deskripsi' => 'Bawa nuansa alam ke dalam keseharian Anda. Forest Edition menawarkan set alat makan kayu dan sedotan stainless yang sama lengkapnya, namun dikemas dalam pouch kanvas berwarna hijau hutan yang menenangkan dan elegan. Solusi praktis untuk mengurangi plastik sekali pakai.',
                'foto_produk' => 'images/product-forest-edition.png',
                'stok' => 50,
                'rating' => 4.5,
                'jumlah_ulasan' => 288,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_produk' => 'GreenKit Timber Signature: Espresso Wood Edition',
                'slug' => 'greenkit-timber-signature-espresso-wood-edition',
                'harga' => 60000,
                'berat' => 250,
                'deskripsi' => 'Bagi Anda yang menyukai estetika klasik dan mewah. Espresso Wood Edition menghadirkan kotak bambu dengan finishing warna kayu gelap yang menawan. Di dalamnya terdapat set alat makan kayu dan sedotan stainless untuk menemani waktu bersantap Anda di mana saja.',
                'foto_produk' => 'images/product-espresso-wood-edition.png',
                'stok' => 50,
                'rating' => 4.5,
                'jumlah_ulasan' => 288,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_produk' => 'GreenKit Eco-Warrior: Deep Ocean Edition',
                'slug' => 'greenkit-eco-warrior-deep-ocean-edition',
                'harga' => 65000,
                'berat' => 300,
                'deskripsi' => 'Tampil gaya sekaligus peduli lingkungan dengan Deep Ocean Edition. Tote bag kanvas berwarna biru laut dalam ini sangat ideal untuk belanja harian, dilengkapi kantong depan praktis yang menyimpan rapi set alat makan kayu lengkap dan sedotan stainless steel Anda.',
                'foto_produk' => 'images/product-deep-ocean-edition.png',
                'stok' => 50,
                'rating' => 4.5,
                'jumlah_ulasan' => 288,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];

        DB::table('products')->insert($products);
    }
}
