<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class serviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            'title' => 'Layanan Cetak Digital',
            'deskripsi_singkat' => 'Layanan cetak digital kami memungkinkan pencetakan berkualitas tinggi dengan hasil yang cepat dan akurat, ideal untuk kebutuhan cetak dalam jumlah kecil hingga menengah.',
            'deskripsi_panjang' => 'aaa',
            'image' => 'hll.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
