<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Muhajir',
                'position' => 'Mahasiswa',
                'company' => null,
                'content' => 'Proses migrasi website tugas akhir saya berjalan sangat lancar. Semua langkah dijelaskan secara rinci, sehingga saya bisa memahami setiap tahapannya',
                'rating' => 5,
                'is_featured' => false,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Fitriah Ulfah',
                'position' => 'HRD',
                'company' => 'Forthen Indonesia',
                'content' => 'Instalasi jaringan dilakukan dengan cepat dan hasilnya sangat memuaskan. Koneksi stabil sepanjang waktu, dan tim selalu siap membantu ketika ada kendala.',
                'rating' => 5,
                'is_featured' => false,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Hanna Christina',
                'position' => 'Digital Ads',
                'company' => 'Megapenerjemah',
                'content' => 'Big thanks buat kakaknya! Benar-benar sabar dan sangat membantu. Prosesnya cepat, komunikasinya jelas, dan hasilnya memuaskan. Pokoknya bintang 5',
                'rating' => 5,
                'is_featured' => false,
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'Putri Azka',
                'position' => 'Event & Comunity',
                'company' => 'BLP Team',
                'content' => 'Semuanya cepet, gak ada masalah sih selama sebulan ini. Harga pemasangan juga bersahabat, dan dikasih saran sesuai budget jugaa. Thaankss semogaa bs langganan sampeee tua yah!.',
                'rating' => 5,
                'is_featured' => false,
                'is_active' => true,
                'order' => 4,
            ],
            [
                'name' => 'Aditiya Puspanegara',
                'position' => 'Journalist - Owner',
                'company' => 'Journal Pathway Care',
                'content' => 'Abang ini asik banget orangnya, sabar dan mau ngerti saya walaupun saya ngomongnya nggak pake bahasa IT. Jadi nggak bikin saya pusing sama istilah teknis, Pokoknya enak diajak ngobrol. Gaskeun',
                'rating' => 5,
                'is_featured' => false,
                'is_active' => true,
                'order' => 5,
            ],
            [
                'name' => 'Guntur Sahadi',
                'position' => 'Technician',
                'company' => 'Indihome',
                'content' => 'Sangat puas dengan hasil pekerjaan yang rapi dan layanan yang profesional. Jaringan stabil sepanjang hari membuat pekerjaan menjadi lebih efisien.',
                'rating' => 5,
                'is_featured' => false,
                'is_active' => true,
                'order' => 6,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
