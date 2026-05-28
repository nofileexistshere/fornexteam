<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'meta_description' => 'NoFileExistsHere (Nexteam) adalah partner teknologi untuk UMKM dan bisnis di Indonesia. Kami membantu mewujudkan transformasi digital dengan solusi yang praktis, terjangkau, dan hasil yang nyata.',
                'content' => '<h2>Tentang NoFileExistsHere (Nexteam)</h2>
<p>Kami adalah tim teknologi yang fokus membantu usaha mikro, kecil, dan menengah (UMKM) serta bisnis lokal di Indonesia untuk bertransformasi digital. Kami percaya bahwa teknologi bukan hanya untuk perusahaan besar—setiap bisnis berhak punya website profesional, aplikasi yang efisien, dan infrastruktur IT yang stabil.</p>

<h2>Kenapa Memilih Kami?</h2>

<h3>💡 Practical & Results-Oriented</h3>
<p>Kami tidak hanya bikin yang "keren", tapi yang <strong>bekerja</strong>. Setiap solusi yang kami bangun dirancang untuk memberikan hasil nyata: lebih banyak customer, operasional lebih efisien, atau tim yang lebih produktif.</p>

<h3>🚀 Fast & Reliable</h3>
<p>Waktu adalah uang, terutama untuk bisnis. Kami bekerja dengan timeline yang jelas, komunikasi transparan, dan deliver tepat waktu tanpa mengorbankan kualitas.</p>

<h3>💰 Affordable for Small Business</h3>
<p>Budget terbatas bukan berarti harus kompromi dengan kualitas. Kami tawarkan solusi yang terjangkau untuk UMKM dengan value yang maksimal.</p>

<h3>🤝 Long-term Partnership</h3>
<p>Kami bukan cuma vendor yang selesai project langsung hilang. Kami jadi partner jangka panjang yang siap bantu troubleshoot, update, dan scale up seiring bisnis Anda berkembang.</p>

<h3>📚 Knowledge Transfer</h3>
<p>Kami tidak cuma kasih solusi jadi, tapi juga edukasi tim internal Anda supaya bisa maintain dan maximize value dari teknologi yang kami bangun.</p>

<h2>Apa yang Kami Kerjakan?</h2>
<ul>
<li><strong>Web Development</strong> - Website company profile, e-commerce, web app custom</li>
<li><strong>Mobile Apps</strong> - Aplikasi iOS & Android untuk business growth</li>
<li><strong>Desktop Apps</strong> - Automasi workflow internal perusahaan</li>
<li><strong>IT Infrastructure</strong> - Setup server, jaringan, cloud, dan maintenance</li>
<li><strong>Graphic Design</strong> - Branding, logo, marketing materials</li>
<li><strong>IT Support</strong> - Troubleshooting dan technical support on-demand</li>
</ul>

<h2>Klien Kami</h2>
<p>Kami bangga telah bekerja sama dengan berbagai bisnis dari industri F&B, retail, manufaktur, pendidikan, hingga startup teknologi. Dari kedai kopi lokal yang butuh website pertama kali, hingga perusahaan menengah yang perlu optimize infrastruktur IT—kami siap bantu.</p>

<h2>Mari Bertumbuh Bersama</h2>
<p>Teknologi adalah enabler untuk bisnis yang lebih besar. Kalau Anda punya ide, challenge, atau mimpi untuk scale up bisnis—mari ngobrol. Kami siap jadi partner teknologi yang bisa diandalkan untuk mewujudkannya.</p>

<p><strong>Contact us today</strong> dan mari diskusi bagaimana kami bisa bantu bisnis Anda tumbuh dengan teknologi.</p>',
                'is_published' => true,
                'order' => 0,
            ],
            [
                'title' => 'Terms & Conditions',
                'slug' => 'terms',
                'meta_description' => 'Syarat dan ketentuan ini berlaku untuk penggunaan website dan layanan Nexteam sebagai penyedia jasa untuk usaha mikro dan kecil di Indonesia.',
                'content' => '<p>Syarat dan ketentuan ini berlaku untuk penggunaan website dan layanan Nexteam sebagai penyedia jasa untuk usaha mikro dan kecil di Indonesia. Dengan menghubungi kami atau menggunakan layanan kami, Anda dianggap telah membaca dan menyetujui ketentuan ini.</p>

<h2>1. Ruang Lingkup Layanan</h2>
<p>Nexteam menyediakan layanan pengembangan website, aplikasi, desain, infrastruktur, dan dukungan teknis untuk usaha mikro dan kecil. Detail pekerjaan (fitur, jumlah halaman, revisi, dan batasan layanan) akan dijelaskan secara tertulis di chat, dokumen penawaran, atau invoice sebelum project dimulai.</p>

<h2>2. Pemesanan, Pembayaran, dan Revisi</h2>
<p>Untuk menjaga agar kerja yang jelas, kami dapat meminta uang muka (DP) sebelum pengerjaan dimulai. Sisa pembayaran dilakukan setelah hasil kerja disetujui sesuai kesepakatan. Permintaan revisi masih dapat dilakukan selama berada dalam batas revisi yang disepakati di awal; perubahan besar di luar kesepakatan awal dapat dikenakan biaya tambahan.</p>

<h2>3. Konten dan Tanggung Jawab Klien</h2>
<p>Konten seperti teks, gambar, logo, dan data usaha yang digunakan di dalam project diserahkan oleh klien dan menjadi tanggung jawab klien sepenuhnya. Klien menyatakan bahwa konten tersebut tidak melanggar hukum atau hak pihak ketiga mana pun.</p>

<h2>4. Hak Kekayaan Intelektual</h2>
<p>Setelah pembayaran lunas, hak pakai atas hasil kerja (misalnya file desain final, source code yang diserahkan, konfigurasi yang telah terpasang) diberikan kepada klien untuk keperluan usaha sendiri. Hak cipta atas metode kerja, framework, komponen generik, atau library yang kami gunakan tetap dimiliki oleh Nexteam atau pemilik lisensi masing-masing.</p>

<h2>5. Batas Tanggung Jawab</h2>
<p>Kami berupaya memberikan layanan yang stabil dan dapat digunakan dengan baik. Namun, kami tidak bertanggung jawab atas kerugian tidak langsung seperti kehilangan pendapatan, kehilangan data, atau gangguan operasional yang timbul dari penggunaan hasil kerja, selama kami telah memberikan layanan sesuai kesepakatan dan praktik yang wajar.</p>

<h2>6. Perubahan Ketentuan</h2>
<p>Kami dapat sewaktu-waktu memperbarui syarat dan ketentuan ini agar selalu dengan regulasi yang berlaku dan praktik terbaik untuk usaha mikro di Indonesia. Tanggal pembaruan akan dicantumkan di halaman ini dan versi terbaru akan langsung berlaku untuk permintaan layanan berikutnya.</p>',
                'is_published' => true,
                'order' => 1,
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy',
                'meta_description' => 'Kebijakan privasi ini menjelaskan bagaimana Nexteam sebagai penyedia jasa untuk usaha mikro dan kecil di Indonesia mengumpulkan, menggunakan, dan melindungi data pribadi.',
                'content' => '<p>Kebijakan privasi ini menjelaskan bagaimana Nexteam sebagai penyedia jasa untuk usaha mikro dan kecil di Indonesia mengumpulkan, menggunakan, dan melindungi data pribadi Anda saat menggunakan website dan layanan kami.</p>

<h2>1. Data yang Kami Kumpulkan</h2>
<p>Kami dapat mengumpulkan data seperti nama, alamat email, nomor telepon, nama usaha, dan ringkasan kebutuhan project yang Anda kirimkan melalui form kontak, WhatsApp, atau kanal komunikasi lainnya. Untuk keperluan teknis, kami juga dapat meminta akses sementara ke akun hosting, domain, atau layanan pihak ketiga yang Anda gunakan.</p>

<h2>2. Cara Kami Menggunakan Data</h2>
<p>Data digunakan untuk menjawab pertanyaan Anda, menyiapkan penawaran, menjalankan project yang sudah disetujui, mengirimkan pemberitahuan terkait progress, serta melakukan perbaikan kualitas layanan. Kami tidak menggunakan data ini untuk iklan massal atau menjualnya ke pihak lain.</p>

<h2>3. Penyimpanan dan Keamanan</h2>
<p>Kami menyimpan data yang diperlukan seperlunya saja selama hubungan kerja masih berjalan dan untuk kepentingan pencatatan dasar. Akses ke data tersebut dibatasi hanya untuk tim yang memang perlu mengerjakan project Anda, dan kami berupaya menggunakan praktik yang wajar untuk menjaga kerahasiaan data.</p>

<h2>4. Berbagi Data dengan Pihak Ketiga</h2>
<p>Kami tidak menjual data pribadi Anda. Dalam beberapa kasus, data teknis dapat dibagikan secara terbatas kepada penyedia layanan terkait (misalnya penyedia hosting atau registrar domain) hanya jika diperlukan untuk menyelesaikan pekerjaan dan dengan tetap mengikuti ketentuan layanan pihak tersebut.</p>

<h2>5. Hak Anda atas Data</h2>
<p>Anda dapat meminta kami memperbarui atau menghapus data kontak yang kami simpan, sejak tidak bertentangan dengan kewajiban pencatatan yang diwajibkan oleh regulasi. Anda juga dapat meminta kami melupakan kredensial sementara (misalnya password sementara) setelah project selesai.</p>',
                'is_published' => true,
                'order' => 2,
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }
}
