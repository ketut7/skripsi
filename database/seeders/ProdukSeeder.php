<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fakerID = \Faker\Factory::create('id_ID');

        for ($i=0; $i < 10; $i++) {
            $nama = $fakerID->sentence(3);
            \DB::table('produk')->insert([
                'nama' => $nama,
                'deskripsi' => $fakerID->paragraph(3),
                'berat' => rand(1, 10),
                'harga' => rand(10000, 100000),
                'gambar' => $fakerID->imageUrl(640, 480, 'animals', true),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
