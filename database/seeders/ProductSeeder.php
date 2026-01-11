<?php

namespace Database\Seeders;

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

        DB::table('produk')->insert([

            // ================= MAKANAN (15) =================
            [
                'nama_produk' => 'Nasi Goreng Spesial',
                'kategori_id' => 1,
                'harga' => 18000,
                'deskripsi' => 'Nasi goreng dengan telur, ayam, dan bumbu khas spesial',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Nasi Goreng Ayam',
                'kategori_id' => 1,
                'harga' => 15000,
                'deskripsi' => 'Nasi goreng gurih dengan potongan ayam',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Nasi Goreng Seafood',
                'kategori_id' => 1,
                'harga' => 20000,
                'deskripsi' => 'Nasi goreng dengan campuran seafood segar',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Ayam Geprek Sambal Bawang',
                'kategori_id' => 1,
                'harga' => 16000,
                'deskripsi' => 'Ayam crispy digeprek dengan sambal bawang pedas',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Ayam Geprek Sambal Matah',
                'kategori_id' => 1,
                'harga' => 17000,
                'deskripsi' => 'Ayam crispy dengan sambal matah khas Bali',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Ayam Bakar Madu',
                'kategori_id' => 1,
                'harga' => 19000,
                'deskripsi' => 'Ayam bakar dengan balutan madu manis gurih',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Ayam Goreng Lengkuas',
                'kategori_id' => 1,
                'harga' => 16000,
                'deskripsi' => 'Ayam goreng renyah dengan taburan lengkuas',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Mie Goreng Jawa',
                'kategori_id' => 1,
                'harga' => 14000,
                'deskripsi' => 'Mie goreng khas Jawa dengan bumbu tradisional',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Mie Rebus Spesial',
                'kategori_id' => 1,
                'harga' => 15000,
                'deskripsi' => 'Mie rebus hangat dengan topping lengkap',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Bakso Urat',
                'kategori_id' => 1,
                'harga' => 17000,
                'deskripsi' => 'Bakso urat kenyal dengan kuah gurih',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Bakso Mercon',
                'kategori_id' => 1,
                'harga' => 18000,
                'deskripsi' => 'Bakso isi cabai super pedas',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Soto Ayam',
                'kategori_id' => 1,
                'harga' => 15000,
                'deskripsi' => 'Soto ayam kuah kuning dengan suwiran ayam',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Nasi Telur',
                'kategori_id' => 1,
                'harga' => 10000,
                'deskripsi' => 'Nasi putih dengan telur goreng sederhana',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Nasi Ayam Crispy',
                'kategori_id' => 1,
                'harga' => 17000,
                'deskripsi' => 'Nasi hangat dengan ayam crispy renyah',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Ayam Crispy Original',
                'kategori_id' => 1,
                'harga' => 16000,
                'deskripsi' => 'Ayam crispy original tanpa sambal',
                'created_at' => $now, 'updated_at' => $now
            ],

            // ================= MINUMAN (10) =================
            [
                'nama_produk' => 'Es Teh Manis',
                'kategori_id' => 2,
                'harga' => 5000,
                'deskripsi' => 'Teh manis dingin menyegarkan',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Teh Hangat',
                'kategori_id' => 2,
                'harga' => 4000,
                'deskripsi' => 'Teh hangat cocok untuk santai',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Es Jeruk',
                'kategori_id' => 2,
                'harga' => 6000,
                'deskripsi' => 'Jeruk peras segar dengan es',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Jeruk Hangat',
                'kategori_id' => 2,
                'harga' => 6000,
                'deskripsi' => 'Minuman jeruk hangat menyehatkan',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Es Lemon Tea',
                'kategori_id' => 2,
                'harga' => 7000,
                'deskripsi' => 'Perpaduan teh dan lemon segar',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Kopi Hitam',
                'kategori_id' => 2,
                'harga' => 6000,
                'deskripsi' => 'Kopi hitam pahit nikmat',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Kopi Susu',
                'kategori_id' => 2,
                'harga' => 8000,
                'deskripsi' => 'Kopi susu creamy favorit',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Cappuccino',
                'kategori_id' => 2,
                'harga' => 10000,
                'deskripsi' => 'Cappuccino lembut dengan foam susu',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Milo',
                'kategori_id' => 2,
                'harga' => 9000,
                'deskripsi' => 'Minuman coklat manis dan hangat',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Air Mineral',
                'kategori_id' => 2,
                'harga' => 4000,
                'deskripsi' => 'Air mineral segar',
                'created_at' => $now, 'updated_at' => $now
            ],

            // ================= SNACK (12) =================
            [
                'nama_produk' => 'Kentang Goreng',
                'kategori_id' => 3,
                'harga' => 10000,
                'deskripsi' => 'Kentang goreng renyah',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Sosis Goreng',
                'kategori_id' => 3,
                'harga' => 9000,
                'deskripsi' => 'Sosis goreng gurih',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Nugget Ayam',
                'kategori_id' => 3,
                'harga' => 10000,
                'deskripsi' => 'Nugget ayam crispy',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Tahu Crispy',
                'kategori_id' => 3,
                'harga' => 8000,
                'deskripsi' => 'Tahu goreng crispy',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Tempe Mendoan',
                'kategori_id' => 3,
                'harga' => 8000,
                'deskripsi' => 'Tempe mendoan hangat',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Cireng Bumbu Rujak',
                'kategori_id' => 3,
                'harga' => 9000,
                'deskripsi' => 'Cireng dengan saus rujak pedas manis',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Pisang Goreng',
                'kategori_id' => 3,
                'harga' => 7000,
                'deskripsi' => 'Pisang goreng manis',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Pisang Coklat Keju',
                'kategori_id' => 3,
                'harga' => 10000,
                'deskripsi' => 'Pisang goreng isi coklat keju',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Roti Bakar Coklat',
                'kategori_id' => 3,
                'harga' => 9000,
                'deskripsi' => 'Roti bakar isi coklat',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Roti Bakar Keju',
                'kategori_id' => 3,
                'harga' => 9000,
                'deskripsi' => 'Roti bakar isi keju',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Onion Ring',
                'kategori_id' => 3,
                'harga' => 10000,
                'deskripsi' => 'Onion ring renyah',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'nama_produk' => 'Bakso Goreng',
                'kategori_id' => 3,
                'harga' => 9000,
                'deskripsi' => 'Bakso goreng gurih',
                'created_at' => $now, 'updated_at' => $now
            ],
        ]);
    }
}
