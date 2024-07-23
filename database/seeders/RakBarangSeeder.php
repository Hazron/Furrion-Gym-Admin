<?php

namespace Database\Seeders;

use App\Models\RakBarang;
use Illuminate\Database\Seeder;

class RakBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RakBarang::insert([
            [
                'id_barang' => 'BRG1',
                'nama_barang' => 'Suplemen Gym',
                'qty' => 10,
                'harga' => 50000,
            ],
            [
                'id_barang' => 'BRG2',
                'nama_barang' => 'Suplemen Protein',
                'qty' => 15,
                'harga' => 100000,
            ],
            [
                'id_barang' => 'BRG3',
                'nama_barang' => 'Baju Gym',
                'qty' => 10,
                'harga' => 150000,
            ],
            [
                'id_barang' => 'BRG4',
                'nama_barang' => 'Handuk',
                'qty' => 20,
                'harga' => 20000,
            ],
            [
                'id_barang' => 'BRG5',
                'nama_barang' => 'Gainer',
                'qty' => 15,
                'harga' => 100000,
            ],
            [
                'id_barang' => 'BRG6',
                'nama_barang' => 'Whey',
                'qty' => 10,
                'harga' => 150000,
            ],
        ]);
    }
}
