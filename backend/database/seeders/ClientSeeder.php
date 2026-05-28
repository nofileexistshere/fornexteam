<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            [
                'name' => 'PT Maju Jaya Abadi',
                'logo' => null,
                'website' => 'https://majujaya.com',
                'description' => 'Perusahaan manufaktur komponen elektronik terkemuka di Indonesia',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'CV Digital Kreatif',
                'logo' => null,
                'website' => 'https://digitalkreatif.id',
                'description' => 'Agensi digital marketing dan creative design',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Toko Boncafe',
                'logo' => null,
                'website' => 'https://boncafe.com',
                'description' => 'Coffee shop dan roastery premium di Yogyakarta',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'Dinasti Sushi Restaurant',
                'logo' => null,
                'website' => 'https://dinastisushi.co.id',
                'description' => 'Japanese restaurant chain dengan menu authentic sushi',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'name' => 'Yayasan Pendidikan Pesantren Modern',
                'logo' => null,
                'website' => 'https://pesantrenmodern.sch.id',
                'description' => 'Lembaga pendidikan Islam modern dengan sistem boarding school',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'name' => 'PT Teknologi Nusantara',
                'logo' => null,
                'website' => 'https://teknologi-nusantara.com',
                'description' => 'Perusahaan IT solution dan system integrator',
                'is_active' => true,
                'order' => 6,
            ],
            [
                'name' => 'Toko Online Tombrok',
                'logo' => null,
                'website' => 'https://tombrok.store',
                'description' => 'E-commerce platform untuk produk fashion lokal',
                'is_active' => true,
                'order' => 7,
            ],
            [
                'name' => 'Klinik Sehat Sentosa',
                'logo' => null,
                'website' => null,
                'description' => 'Klinik kesehatan umum dengan layanan 24 jam',
                'is_active' => true,
                'order' => 8,
            ],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}
