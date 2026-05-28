<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\License;

class LicenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        License::create([
            'title' => 'License',
            'description' => 'Halaman ini menampilkan ringkasan dokumen legal dan perizinan usaha yang berkaitan dengan NoFileExistsHere (Nexteam) dalam format kartu dokumen, sehingga mudah dibaca seperti melihat foto dokumen fisik.',
            'nib' => '2207250105833',
            'npwp' => '-',
            'company_name' => 'TEKNOLOGI KREASI DIGITAL',
            'category' => 'REC CEISA',
            'process_history' => [
                [
                    'title' => 'REC OSS',
                    'description' => 'NIB dikirimkan ke LNSW',
                    'date' => '22 Juli 2025 16:08',
                ],
                [
                    'title' => 'REC INSW',
                    'description' => 'NIB diterima oleh INSW dan sudah diterima',
                    'date' => '22 Juli 2025 16:08',
                ],
                [
                    'title' => 'REC CEISA',
                    'description' => 'NIB dikirimkan oleh INSW ke CEISA dan sudah diterima',
                    'date' => '22 Juli 2025 16:09',
                ],
            ],
            'terms_summary' => [
                ['item' => 'Layanan yang diberikan fokus pada pembuatan dan pemeliharaan solusi digital sederhana untuk usaha mikro dan kecil.'],
                ['item' => 'Biaya dan ruang lingkup kerja selalu disepakati terlebih dahulu melalui chat / dokumen sebelum pekerjaan dimulai.'],
                ['item' => 'Perubahan besar di luar kesepakatan awal dapat dikenakan penyesuaian biaya berdasarkan kesepakatan baru.'],
                ['item' => 'Hak penggunaan hasil kerja (website, desain, konfigurasi sistem) diberikan kepada klien setelah pembayaran lunas.'],
            ],
            'privacy_summary' => [
                ['item' => 'Data yang dibagikan (akses hosting, akun sosial media, atau data usaha) hanya digunakan untuk keperluan pengerjaan project.'],
                ['item' => 'Kredensial penting yang diberikan klien dianjurkan untuk diganti setelah project selesai dan diterima.'],
                ['item' => 'Kami tidak menjual atau membagikan data klien ke pihak lain, kecuali jika diwajibkan oleh regulasi yang berlaku.'],
            ],
            'is_active' => true,
        ]);
    }
}
