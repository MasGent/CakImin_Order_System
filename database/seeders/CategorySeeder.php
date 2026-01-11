<?php

namespace Database\Seeders;

use App\Models\kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        kategori::insert([
            ['kategori' => 'Makanan'],
            ['kategori' => 'Minuman'],
            ['kategori' => 'Snack'],
        ]);
    }
}
