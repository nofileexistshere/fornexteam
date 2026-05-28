<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogPost;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Mengapa Infrastruktur IT yang Solid adalah Fondasi Bisnis Digital Anda',
                'slug' => 'infrastruktur-it-fondasi-bisnis-digital',
                'author' => 'NoFileExistsHere Team',
                'category' => 'Infrastructure',
                'tags' => ['Infrastructure', 'IT', 'Business', 'Cloud'],
                'excerpt' => 'Di era digital ini, infrastruktur IT bukan lagi sekadar pendukung operasional—ia adalah tulang punggung yang menentukan kelancaran, keamanan, dan skalabilitas bisnis Anda.',
                'content' => '<p>Banyak bisnis yang baru menyadari pentingnya infrastruktur IT setelah mengalami downtime, serangan siber, atau ketidakmampuan untuk scale up saat demand meningkat.</p>

<h2>Apa Itu Infrastruktur IT?</h2>
<p>Infrastruktur IT mencakup semua komponen fisik dan virtual yang mendukung operasi teknologi bisnis Anda: server, jaringan, storage, virtualisasi, cloud computing, keamanan, dan disaster recovery.</p>

<h2>Mengapa Infrastruktur Penting?</h2>
<ul>
<li><strong>Keandalan:</strong> Downtime bisa merugikan bisnis jutaan rupiah per jam. Infrastruktur yang dirancang dengan baik memastikan high availability dan redundancy.</li>
<li><strong>Keamanan:</strong> Serangan siber makin canggih. Infrastruktur yang aman melindungi data sensitif pelanggan dan bisnis dari ancaman.</li>
<li><strong>Skalabilitas:</strong> Bisnis berkembang, kebutuhan teknologi pun meningkat. Infrastruktur yang fleksibel memudahkan scale up tanpa hambatan.</li>
<li><strong>Efisiensi Biaya:</strong> Investasi awal yang tepat menghemat biaya jangka panjang.</li>
</ul>

<h2>Tren Infrastruktur Modern</h2>
<p>Saat ini, bisnis bergerak ke arah <strong>hybrid cloud</strong>, kombinasi on-premise dan cloud untuk fleksibilitas maksimal. <strong>Containerization</strong> dengan Docker dan Kubernetes juga makin populer.</p>

<h2>Langkah Awal Membangun Infrastruktur</h2>
<ol>
<li><strong>Assessment:</strong> Pahami kebutuhan bisnis, compliance, dan growth projection.</li>
<li><strong>Design:</strong> Rancang arsitektur yang scalable, secure, dan cost-effective.</li>
<li><strong>Implementation:</strong> Deploy dengan best practices dan monitoring tools.</li>
<li><strong>Maintenance:</strong> Regular update, patch, dan optimization.</li>
</ol>

<p>Investasi di infrastruktur IT yang solid adalah investasi di masa depan bisnis Anda.</p>',
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'views' => 245,
            ],
            [
                'title' => 'Studi Kasus: Membangun Sistem Manajemen Inventory Real-Time untuk Retail',
                'slug' => 'studi-kasus-sistem-inventory-retail',
                'author' => 'NoFileExistsHere Team',
                'category' => 'Case Study',
                'tags' => ['Case Study', 'Web Development', 'Inventory', 'Retail'],
                'excerpt' => 'Bagaimana kami membantu sebuah bisnis retail mengelola ribuan SKU dengan sistem inventory real-time yang terintegrasi dari gudang hingga kasir.',
                'content' => '<h2>Background: Masalah yang Dihadapi</h2>
<p>Klien kami, sebuah retail store dengan 5 cabang, menghadapi kesulitan serius dalam mengelola inventory. Stock opname manual sering tidak akurat, restock terlambat, dan data sales tidak terintegrasi antar cabang.</p>

<h2>Solusi: Sistem Inventory Real-Time</h2>
<p>Kami merancang dan membangun <strong>web-based inventory management system</strong> dengan fitur:</p>
<ul>
<li><strong>Real-time stock tracking:</strong> Setiap transaksi langsung update stock di database.</li>
<li><strong>Multi-location support:</strong> Dashboard terpusat untuk monitoring stock di semua cabang.</li>
<li><strong>Automated reorder alerts:</strong> Sistem otomatis kirim notifikasi jika stock di bawah threshold.</li>
<li><strong>Barcode scanning:</strong> Integrasi barcode scanner untuk stock in/out yang cepat.</li>
<li><strong>Analytics dashboard:</strong> Insight tentang produk best seller, slow moving, dan forecast demand.</li>
</ul>

<h2>Tech Stack yang Digunakan</h2>
<p>Backend: <strong>Laravel 11</strong> untuk API yang robust dan scalable.<br>
Frontend: <strong>Next.js</strong> untuk dashboard yang responsive dan fast.<br>
Database: <strong>PostgreSQL</strong> untuk data integrity.<br>
Real-time: <strong>WebSocket</strong> untuk update stock real-time antar user.<br>
Deployment: <strong>AWS</strong> dengan auto-scaling.</p>

<h2>Hasil dan Impact</h2>
<blockquote>
<p>"Setelah 3 bulan menggunakan sistem ini, stockout kami berkurang 80%, dan kami hemat 15 jam kerja per minggu."<br>— Owner, Retail Store</p>
</blockquote>

<p>Stock accuracy meningkat dari 70% menjadi 98%. Customer satisfaction meningkat karena produk yang dicari selalu tersedia.</p>',
                'is_published' => true,
                'published_at' => now()->subDays(12),
                'views' => 398,
            ],
            [
                'title' => '7 Best Practices dalam Membangun Web App yang Scalable',
                'slug' => '7-best-practices-web-app-scalable',
                'author' => 'NoFileExistsHere Team',
                'category' => 'Development',
                'tags' => ['Web Development', 'Best Practices', 'Scalability', 'Architecture'],
                'excerpt' => 'Dari codebase yang maintainable hingga infrastruktur yang bisa handle traffic spike—ini adalah 7 best practices yang selalu kami terapkan dalam setiap project.',
                'content' => '<p>Banyak aplikasi yang awalnya berjalan lancar, tapi mulai bermasalah saat user base bertambah. Kenapa? Karena aplikasi tidak didesain untuk scale dari awal.</p>

<h2>1. Microservices Architecture</h2>
<p>Ketika aplikasi mulai kompleks, memecah monolith menjadi service-service kecil yang independent adalah langkah tepat. Ini memudahkan scaling, deployment, dan maintenance.</p>

<h2>2. Database Optimization</h2>
<p>Database bottleneck adalah masalah klasik. <strong>Indexing yang tepat, query optimization, dan caching layer</strong> seperti Redis bisa meningkatkan performa drastis.</p>

<h2>3. Load Balancing dan Auto-Scaling</h2>
<p>Gunakan <strong>load balancer</strong> untuk distribusi traffic, dan enable <strong>auto-scaling</strong> di cloud provider Anda untuk handle traffic spike secara otomatis.</p>

<h2>4. API Rate Limiting</h2>
<p>Lindungi API Anda dari abuse dan DDoS dengan <strong>rate limiting</strong>. Ini juga membantu manage resource usage.</p>

<h2>5. Monitoring dan Logging</h2>
<p>Implement monitoring tools seperti <strong>New Relic, Sentry, atau Datadog</strong>. Detect dan fix issue sebelum user sadar.</p>

<h2>6. CI/CD Pipeline</h2>
<p>Automated testing dan deployment dengan <strong>CI/CD pipeline</strong> memastikan setiap code change ter-test dengan baik sebelum production.</p>

<h2>7. Security First Mindset</h2>
<p>Implement <strong>authentication yang solid, input validation, HTTPS, dan regular security audit</strong>. Data breach bisa merusak reputasi bisnis dalam sekejap.</p>

<h2>Kesimpulan</h2>
<p>Scalability bukan cuma tentang infrastruktur—ini tentang <strong>architecture, code quality, dan culture</strong>. Mulai dari kecil, tapi design for scale.</p>',
                'is_published' => true,
                'published_at' => now()->subDays(20),
                'views' => 521,
            ],
            [
                'title' => 'Mobile App vs Web App vs Desktop App: Mana yang Tepat untuk Bisnis Anda?',
                'slug' => 'mobile-web-desktop-app-comparison',
                'author' => 'NoFileExistsHere Team',
                'category' => 'Guide',
                'tags' => ['Mobile App', 'Web App', 'Desktop App', 'Business Strategy'],
                'excerpt' => 'Bingung pilih platform untuk aplikasi bisnis Anda? Setiap platform punya kelebihan dan trade-off. Artikel ini akan membantu Anda memutuskan berdasarkan kebutuhan, budget, dan target audience.',
                'content' => '<p>Salah satu pertanyaan pertama yang muncul dalam setiap project adalah: <strong>"Platform mana yang harus kita pilih?"</strong> Jawabannya tergantung use case, target user, dan business goals.</p>

<h2>Web App: Flexibility dan Reach yang Luas</h2>
<p><strong>Kelebihan:</strong></p>
<ul>
<li>Cross-platform by default—bisa diakses dari browser mana pun.</li>
<li>No installation required—user langsung akses via URL.</li>
<li>Update instant—push update ke server, semua user langsung dapat versi terbaru.</li>
<li>Cost-effective—satu codebase untuk semua device.</li>
</ul>

<p><strong>Trade-off:</strong></p>
<ul>
<li>Terbatas akses ke hardware device.</li>
<li>Performa mungkin tidak sehalus native app untuk task yang heavy.</li>
</ul>

<p><strong>Kapan Pilih Web App?</strong><br>
Jika aplikasi Anda adalah SaaS, dashboard, e-commerce, atau content platform—web app adalah pilihan terbaik.</p>

<h2>Mobile App: User Experience yang Superior</h2>
<p><strong>Kelebihan:</strong></p>
<ul>
<li>Full access ke hardware device (camera, GPS, push notifications).</li>
<li>Performa lebih smooth untuk aplikasi yang heavy.</li>
<li>Bisa bekerja offline dengan proper architecture.</li>
<li>Branding lebih kuat—user install di home screen mereka.</li>
</ul>

<p><strong>Trade-off:</strong></p>
<ul>
<li>Development cost lebih tinggi—butuh separate codebase untuk iOS dan Android.</li>
<li>Update harus melalui app store approval.</li>
<li>User harus download dan install—friction lebih tinggi.</li>
</ul>

<p><strong>Kapan Pilih Mobile App?</strong><br>
Jika aplikasi Anda membutuhkan fitur device-specific atau jika user experience adalah prioritas tertinggi.</p>

<h2>Desktop App: Power dan Productivity</h2>
<p><strong>Kelebihan:</strong></p>
<ul>
<li>Performa maksimal untuk task yang complex dan resource-intensive.</li>
<li>Full access ke file system dan hardware.</li>
<li>Ideal untuk enterprise tools dan productivity apps.</li>
</ul>

<p><strong>Trade-off:</strong></p>
<ul>
<li>Limited reach—hanya user dengan desktop/laptop yang bisa akses.</li>
<li>Distribution lebih challenging.</li>
<li>Update process lebih rumit dibanding web app.</li>
</ul>

<p><strong>Kapan Pilih Desktop App?</strong><br>
Jika aplikasi Anda adalah professional tool atau membutuhkan computing power yang tinggi.</p>

<h2>Kesimpulan</h2>
<p>Tidak ada jawaban yang benar atau salah—hanya yang tepat atau tidak tepat untuk use case Anda. Understand your users, prioritas fitur, budget, dan timeline.</p>',
                'is_published' => true,
                'published_at' => now()->subDays(28),
                'views' => 612,
            ],
            [
                'title' => 'Kenapa UI/UX Design Bukan Cuma Soal "Cantik"—Tapi Soal ROI',
                'slug' => 'uiux-design-bukan-cuma-cantik',
                'author' => 'NoFileExistsHere Team',
                'category' => 'Design',
                'tags' => ['UI/UX', 'Design', 'User Experience', 'Business'],
                'excerpt' => 'Banyak bisnis yang masih menganggap UI/UX design sebagai "nice to have." Padahal, design yang baik bisa meningkatkan conversion rate hingga 200%.',
                'content' => '<p>Ada misconception bahwa UI/UX design cuma soal estetika. Padahal, design yang baik adalah design yang <strong>solving problem, reducing friction, dan driving business result.</strong></p>

<h2>Apa Itu UI dan UX?</h2>
<p><strong>UI (User Interface)</strong> adalah visual, layout, button, typography. <strong>UX (User Experience)</strong> adalah experience user saat menggunakan produk—flow, usability, accessibility.</p>

<h2>ROI dari Good Design</h2>
<ul>
<li><strong>Conversion Rate Meningkat:</strong> Design yang intuitif meningkatkan conversion rate 20-200%.</li>
<li><strong>Customer Retention:</strong> User yang puas dengan experience akan kembali lagi.</li>
<li><strong>Mengurangi Support Cost:</strong> Produk yang mudah digunakan mengurangi pertanyaan ke customer support.</li>
<li><strong>Brand Perception:</strong> Design yang professional meningkatkan trust.</li>
</ul>

<h2>Common UX Mistakes</h2>
<ol>
<li><strong>Complex Navigation:</strong> Jika user tidak bisa find apa yang mereka cari dalam 3 klik, mereka akan leave.</li>
<li><strong>Slow Loading:</strong> 53% user akan abandon website yang load lebih dari 3 detik.</li>
<li><strong>Not Mobile-Friendly:</strong> 60% traffic datang dari mobile.</li>
<li><strong>Poor Readability:</strong> Font kecil, contrast rendah, wall of text.</li>
<li><strong>No Clear CTA:</strong> Jika user tidak tahu next step, mereka tidak akan convert.</li>
</ol>

<h2>Design Process yang Efektif</h2>
<ul>
<li><strong>User Research:</strong> Understand siapa user Anda, apa pain points mereka.</li>
<li><strong>Wireframing & Prototyping:</strong> Test flow dan interaction dulu dengan prototype.</li>
<li><strong>Usability Testing:</strong> Observe real users menggunakan produk Anda.</li>
<li><strong>Iterate:</strong> Design is never done. Continuous improvement based on data.</li>
</ul>

<h2>Kesimpulan</h2>
<p>Design bukan expense—ini <strong>investment yang measurable.</strong> Setiap rupiah yang Anda invest di good design bisa return berkali-kali lipat.</p>',
                'is_published' => true,
                'published_at' => now()->subDays(35),
                'views' => 457,
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::updateOrCreate(
                ['slug' => $post['slug']],
                $post
            );
        }
    }
}
