<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class teamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('teams')->insert([
            'name'  => 'dani',
            'role'  => 'programmer',
            'info'  => 'sugih',
            'ig'    => 'instagram.com',
            'fb'    => 'goggle.com',
            'tt'    => 'tiktok.com',
            'image' => 'test',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
