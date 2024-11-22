<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class About extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('abouts')->insert([
            'deskripsi_singkat' => '2N Print adalah perusahaan percetakan yang berdedikasi untuk menyediakan solusi cetak berkualitas tinggi dengan pelayanan yang handal dan efisien. Berdiri sejak tahun 2019, kami bangga menjadi mitra percetakan pilihan bagi berbagai bisnis dan individu. Dengan pengalaman bertahun-tahun dalam industri ini, kami terus berkomitmen untuk memberikan hasil cetak terbaik dan memenuhi kebutuhan pelanggan kami dengan sepenuh hati.',
            'deskripsi_panjang' => '2N Print adalah nama terpercaya dalam industri percetakan yang berdiri sejak tahun 2019. Kami mengkhususkan diri dalam memberikan solusi cetak berkualitas tinggi yang didukung oleh pelayanan yang handal dan efisien. Dengan pengalaman bertahun-tahun dalam bidang percetakan, kami telah membangun reputasi sebagai mitra percetakan pilihan bagi berbagai bisnis dan individu yang menginginkan hasil cetak terbaik. Di 2N Print, kami percaya bahwa setiap proyek cetak adalah kesempatan untuk menunjukkan komitmen kami terhadap kualitas dan detail. Tim kami yang terampil dan berpengalaman bekerja dengan teknologi cetak terbaru untuk memastikan bahwa setiap produk yang kami hasilkan memenuhi standar tinggi kami dan harapan pelanggan. Kami berkomitmen untuk memberikan pelayanan yang cepat, tepat, dan memuaskan, serta menjalin hubungan jangka panjang dengan pelanggan kami.
            Kami mengerti bahwa setiap klien memiliki kebutuhan unik, dan kami berusaha untuk menyesuaikan solusi kami agar sesuai dengan spesifikasi dan anggaran mereka. Apakah Anda membutuhkan bahan promosi, materi pemasaran, atau cetakan khusus, 2N Print siap membantu Anda mewujudkan visi Anda dengan hasil cetak yang luar biasa.
            Terima kasih telah memilih 2N Print sebagai mitra percetakan Anda. Kami menantikan kesempatan untuk bekerja sama dengan Anda dan membantu Anda mencapai tujuan cetak Anda.',
            'image' => 'ini.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
