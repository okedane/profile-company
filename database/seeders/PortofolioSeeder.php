<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortofolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('portofolios')->insert([
            [
                'title' => 'Project 1',
                'description' => 'Description for project 1',
                'image' => 'project1.jpg',
                'category_id' => 1, // Ganti dengan ID kategori yang sesuai
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Project 2',
                'description' => 'Description for project 2',
                'image' => 'project2.jpg',
                'category_id' => 2, // Ganti dengan ID kategori yang sesuai
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data portofolio lainnya sesuai kebutuhan
        ]);
    }
}
