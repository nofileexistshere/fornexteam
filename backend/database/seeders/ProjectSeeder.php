<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'name' => 'Dinasti Sushi - Authentic Japanese Restaurant',
                'slug' => 'dinasti-sushi',
                'description' => 'Pembangunan website landing page dan platform dashboard untuk Dinasti Sushi, mencakup sistem pemesanan customer dan manajemen kitchen admin.',
                'content' => "Kami telah menyelesaikan pembangunan website landing page dan platform dashboard untuk Dinasti Sushi, sebuah restoran Jepang yang menghadirkan pengalaman kuliner autentik dengan kemudahan akses digital.\n\nProject ini bertujuan untuk membangun sebuah ekosistem digital yang menghubungkan antara customer, koki dapur, hingga kasir melalui platform landing page dan dashboard manajemen yang terintegrasi secara real-time.",
                'client_name' => 'Dinasti Sushi',
                'category' => 'WEB DEVELOPMENT',
                'technologies' => ['Laravel', 'MySQL', 'Tailwind CSS', 'Real-time System', 'Multi-Dashboard'],
                'featured_image' => null,
                'gallery_images' => [],
                'project_url' => null,
                'start_date' => '2025-06-01',
                'end_date' => '2025-08-15',
                'is_featured' => true,
                'is_published' => true,
                'order' => 1,
            ],
            [
                'name' => 'Website Pesantren Pondok Bambu',
                'slug' => 'pesantren',
                'description' => 'Website profil untuk Pesantren Pondok Bambu, menampilkan informasi kegiatan, program pendidikan, dan kontak bagi orang tua atau calon santri.',
                'content' => "Pesantren membutuhkan media online yang rapi dan mudah diakses untuk menyampaikan informasi kegiatan, program pendidikan, serta memudahkan orang tua atau calon santri menemukan kontak resmi pesantren.\n\nWebsite ini menyediakan profil resmi pesantren yang mudah ditemukan secara online dan menampilkan informasi program, jadwal, dan kegiatan dalam format yang terstruktur.",
                'client_name' => 'Pesantren Pondok Bambu',
                'category' => 'WEB DEVELOPMENT',
                'technologies' => ['Laravel', 'Filament', 'MySQL', 'Tailwind CSS'],
                'featured_image' => null,
                'gallery_images' => [],
                'project_url' => 'https://pesantrenpondokbambu.ct.ws/',
                'start_date' => '2025-04-10',
                'end_date' => '2025-05-20',
                'is_featured' => true,
                'is_published' => true,
                'order' => 2,
            ],
            [
                'name' => 'Optimasi Jaringan PT BON CAFE INDONESIA',
                'slug' => 'boncafe',
                'description' => 'Project optimasi jaringan dan infrastruktur IT untuk cabang-cabang PT BON CAFE INDONESIA agar koneksi lebih stabil dan terukur.',
                'content' => "Studi kasus optimasi jaringan di salah satu cabang PT BON CAFE INDONESIA untuk meningkatkan stabilitas koneksi, mengurangi downtime, dan memudahkan monitoring infrastruktur.\n\nProject ini mencakup pemetaan kondisi jaringan existing, rekomendasi topologi yang lebih ideal, dan implementasi konfigurasi untuk meningkatkan performa jaringan.",
                'client_name' => 'PT BON CAFE INDONESIA',
                'category' => 'INTERNET & INFRASTRUCTURE',
                'technologies' => ['Mikrotik', 'Network Topology', 'VLAN', 'Network Monitoring', 'Firewall'],
                'featured_image' => null,
                'gallery_images' => [],
                'project_url' => null,
                'start_date' => '2025-09-01',
                'end_date' => '2025-10-15',
                'is_featured' => true,
                'is_published' => true,
                'order' => 3,
            ],
            [
                'name' => 'Setup Synology Server & Konfigurasi Mikrotik PT Tombrok Jaya Permai',
                'slug' => 'tombrok',
                'description' => 'Project setup Synology server dengan RAID configuration dan optimasi jaringan menggunakan Mikrotik di kantor pusat PT Tombrok Jaya Permai secara on-site.',
                'content' => "Project on-site setup Synology server dengan RAID configuration dan konfigurasi ulang infrastruktur Mikrotik untuk meningkatkan reliabilitas, keamanan, dan aksesibilitas data di kantor pusat PT Tombrok Jaya Permai.\n\nImplementasi mencakup setup RAID untuk data protection, konfigurasi file sharing dan remote access, serta optimasi jaringan untuk performa maksimal.",
                'client_name' => 'PT Tombrok Jaya Permai',
                'category' => 'INTERNET & INFRASTRUCTURE',
                'technologies' => ['Synology NAS', 'Synology DSM', 'RAID', 'Mikrotik', 'Cloudflare', 'DDNS', 'SSL/TLS'],
                'featured_image' => null,
                'gallery_images' => [],
                'project_url' => null,
                'start_date' => '2025-11-05',
                'end_date' => '2025-11-20',
                'is_featured' => true,
                'is_published' => true,
                'order' => 4,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
