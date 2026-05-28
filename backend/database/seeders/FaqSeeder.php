<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Apa saja layanan yang kami tawarkan?',
                'answer' => 'Kami menawarkan berbagai layanan teknologi, termasuk pembuatan website, aplikasi desktop (Windows), aplikasi mobile (Android), desain grafis, desain jaringan internet, dan troubleshooting teknis. Semua layanan kami dirancang untuk memberikan solusi praktis dan efisien sesuai kebutuhan Anda.',
                'category' => 'Layanan',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Bagaimana cara memulai menggunakan layanan kami?',
                'answer' => 'Untuk memulai, cukup hubungi kami melalui halaman kontak atau chat, beri tahu kami tentang kebutuhan atau ide Anda, dan tim kami akan membantu merencanakan solusi terbaik untuk Anda. Kami akan menjelaskan setiap langkah dan memastikan semuanya berjalan sesuai keinginan Anda.',
                'category' => 'Umum',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah saya perlu memiliki pengetahuan teknis untuk bekerja dengan kami?',
                'answer' => 'Tidak perlu! Kami akan memandu Anda di setiap langkah. Kami berkomunikasi dengan cara yang mudah dipahami, sehingga Anda bisa ikut serta dalam proses tanpa merasa bingung atau terintimidasi oleh istilah teknis.',
                'category' => 'Umum',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'question' => 'Berapa lama waktu yang dibutuhkan untuk menyelesaikan proyek?',
                'answer' => 'Waktu pengerjaan proyek bergantung pada jenis layanan yang Anda pilih dan kompleksitasnya. Kami akan memberikan estimasi waktu yang jelas setelah mendiskusikan detail proyek bersama Anda. Kami berusaha untuk menyelesaikan setiap proyek dengan cepat dan tepat waktu.',
                'category' => 'Proyek',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah Anda menawarkan dukungan setelah proyek selesai?',
                'answer' => 'Tentu! Setelah proyek selesai, kami tetap memberikan dukungan dan pemeliharaan. Apakah itu untuk perbaikan bug kecil, pembaruan, atau pertanyaan lainnya, kami siap membantu kapan saja.',
                'category' => 'Dukungan',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'question' => 'Bagaimana jika saya tidak puas dengan hasil akhir?',
                'answer' => 'Kami mengutamakan kepuasan pelanggan. Jika Anda tidak puas dengan hasilnya, beri tahu kami! Kami akan melakukan revisi sesuai permintaan Anda untuk memastikan hasil akhir sesuai dengan harapan Anda.',
                'category' => 'Dukungan',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah saya bisa mendapatkan harga yang lebih terjangkau jika saya hanya membutuhkan layanan tertentu?',
                'answer' => 'Kami menawarkan solusi yang fleksibel dan dapat disesuaikan dengan anggaran Anda. Jangan ragu untuk berdiskusi dengan kami tentang kebutuhan Anda, dan kami akan mencari cara untuk memberikan harga yang sesuai.',
                'category' => 'Harga',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah layanan Anda tersedia untuk semua jenis bisnis?',
                'answer' => 'Ya, layanan kami dapat disesuaikan untuk berbagai jenis bisnis, baik kecil maupun besar, serta individu. Apakah Anda seorang pengusaha, profesional, atau organisasi, kami siap membantu.',
                'category' => 'Layanan',
                'order' => 8,
                'is_active' => true,
            ],
            [
                'question' => 'Apa yang membedakan \'Nexteam\' dari penyedia layanan lainnya?',
                'answer' => 'Kami percaya bahwa teknologi seharusnya mempermudah hidup Anda, bukan menambah masalah. \'Nexteam\' mencerminkan komitmen kami untuk memberikan solusi yang bersih, bebas hambatan, dan efisien. Kami berfokus pada hasil yang nyata, dan memastikan Anda mendapatkan layanan yang memenuhi harapan tanpa ada file masalah yang mengganggu.',
                'category' => 'Tentang Kami',
                'order' => 9,
                'is_active' => true,
            ],
            [
                'question' => 'Bagaimana cara saya menghubungi tim kami?',
                'answer' => 'Anda bisa menghubungi kami melalui formulir kontak di website kami, email, atau chat langsung. Tim kami siap merespon dan membantu Anda kapan saja.',
                'category' => 'Kontak',
                'order' => 10,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
