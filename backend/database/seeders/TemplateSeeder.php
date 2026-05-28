<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            [
                'name' => 'Portfolio – Creative Personal Website Template',
                'slug' => 'portfolio-creative',
                'description' => 'Template portfolio pribadi untuk developer atau designer dengan layout bersih, section hero, about, skills, daftar project, dan CTA kontak yang diarahkan ke WhatsApp atau email.',
                'content' => 'Template ini dilengkapi dengan berbagai section yang dibutuhkan untuk showcase portfolio Anda secara profesional. Termasuk hero section yang menarik, about section, skills showcase, project gallery, dan contact form yang terintegrasi.',
                'category' => 'Portfolio',
                'tags' => ['Personal', 'Portfolio', 'Landingpage'],
                'preview_image' => null, // Upload manual di CMS
                'screenshots' => [],
                'price' => 0.00, // Free
                'demo_url' => 'https://demo.nexteam.com/portfolio-creative',
                'download_url' => 'https://github.com/nexteam/portfolio-template',
                'version' => '1.0.0',
                'features' => [
                    'Responsive Design',
                    'Dark Mode Support',
                    'Next.js & Tailwind CSS',
                    'SEO Optimized',
                    'Contact Form Integrated',
                    'Project Gallery',
                    'Skills Section',
                ],
                'is_featured' => true,
                'is_published' => true,
                'downloads' => 150,
                'order' => 1,
            ],
            [
                'name' => 'Business Landing Page Template',
                'slug' => 'business-landing',
                'description' => 'Template landing page bisnis modern dengan hero section, feature highlights, pricing table, testimonials, dan contact form. Cocok untuk startup atau UMKM.',
                'content' => 'Landing page yang dirancang untuk konversi maksimal dengan call-to-action yang jelas, social proof melalui testimonials, dan pricing yang transparan.',
                'category' => 'Business',
                'tags' => ['Business', 'Landing Page', 'Startup', 'UMKM'],
                'preview_image' => null,
                'screenshots' => [],
                'price' => 299000.00, // Premium
                'demo_url' => 'https://demo.nexteam.com/business-landing',
                'download_url' => null,
                'version' => '1.2.0',
                'features' => [
                    'Modern Design',
                    'Pricing Tables',
                    'Testimonials Section',
                    'Feature Highlights',
                    'Newsletter Integration',
                    'Mobile Optimized',
                ],
                'is_featured' => true,
                'is_published' => true,
                'downloads' => 89,
                'order' => 2,
            ],
            [
                'name' => 'E-Commerce Product Page',
                'slug' => 'ecommerce-product',
                'description' => 'Template halaman produk e-commerce dengan product gallery, variant selector, add to cart, product reviews, dan related products. Siap untuk toko online.',
                'content' => 'Halaman produk yang lengkap dengan semua fitur yang dibutuhkan untuk meningkatkan penjualan online Anda.',
                'category' => 'E-Commerce',
                'tags' => ['E-Commerce', 'Product Page', 'Shop'],
                'preview_image' => null,
                'screenshots' => [],
                'price' => 0.00, // Free
                'demo_url' => 'https://demo.nexteam.com/ecommerce-product',
                'download_url' => 'https://github.com/nexteam/ecommerce-template',
                'version' => '2.0.0',
                'features' => [
                    'Product Gallery',
                    'Variant Selector',
                    'Shopping Cart',
                    'Product Reviews',
                    'Related Products',
                    'Wishlist Feature',
                ],
                'is_featured' => false,
                'is_published' => true,
                'downloads' => 234,
                'order' => 3,
            ],
            [
                'name' => 'SaaS Dashboard Template',
                'slug' => 'saas-dashboard',
                'description' => 'Template dashboard admin untuk aplikasi SaaS dengan charts, tables, user management, dan notification system. Built with React & Tailwind.',
                'content' => 'Dashboard yang powerful dengan berbagai komponen siap pakai untuk membangun aplikasi SaaS Anda.',
                'category' => 'Dashboard',
                'tags' => ['SaaS', 'Dashboard', 'Admin Panel'],
                'preview_image' => null,
                'screenshots' => [],
                'price' => 499000.00, // Premium
                'demo_url' => 'https://demo.nexteam.com/saas-dashboard',
                'download_url' => null,
                'version' => '1.5.0',
                'features' => [
                    'Charts & Analytics',
                    'Data Tables',
                    'User Management',
                    'Notifications',
                    'Dark Mode',
                    'Responsive Layout',
                    'API Integration Ready',
                ],
                'is_featured' => true,
                'is_published' => true,
                'downloads' => 67,
                'order' => 4,
            ],
            [
                'name' => 'Blog Minimal Template',
                'slug' => 'blog-minimal',
                'description' => 'Template blog minimalis dengan fokus pada konten. Dilengkapi dengan article layout, category filter, search, dan dark mode.',
                'content' => 'Blog template yang clean dan mudah dibaca dengan fokus pada typography dan user experience.',
                'category' => 'Blog',
                'tags' => ['Blog', 'Minimal', 'Content'],
                'preview_image' => null,
                'screenshots' => [],
                'price' => 0.00, // Free
                'demo_url' => 'https://demo.nexteam.com/blog-minimal',
                'download_url' => 'https://github.com/nexteam/blog-template',
                'version' => '1.1.0',
                'features' => [
                    'Minimal Design',
                    'Article Layout',
                    'Category Filter',
                    'Search Functionality',
                    'Dark Mode',
                    'RSS Feed',
                ],
                'is_featured' => false,
                'is_published' => true,
                'downloads' => 312,
                'order' => 5,
            ],
        ];

        foreach ($templates as $template) {
            Template::create($template);
        }
    }
}
