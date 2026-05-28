# Backend Laravel + Filament - Nexteam CMS

Backend CMS menggunakan Laravel 11 dan Filament v3 untuk mengelola konten website Nexteam.

## Fitur

### Content Management (CRUD Lengkap via Filament)

- **Blog Posts** - Artikel blog dengan rich text editor, tags, categories
- **Projects** - Portfolio projects dengan gallery images
- **Services** - Layanan yang ditawarkan
- **Templates** - Template/produk digital untuk dijual
- **Team Members** - Tim members dengan foto dan social media
- **Testimonials** - Testimonial dari klien
- **Clients** - Daftar klien/partner
- **FAQs** - Frequently Asked Questions
- **Contact Messages** - Pesan kontak dari pengunjung
- **Settings** - Pengaturan website global

### API Endpoints

Semua API endpoint tersedia di `/api/` dengan format JSON response:

#### Blog

- `GET /api/blog-posts` - List semua blog posts (published only, paginated)
- `GET /api/blog-posts/{slug}` - Detail blog post by slug

#### Projects

- `GET /api/projects` - List semua projects (published only)
- `GET /api/projects/featured` - List featured projects only
- `GET /api/projects/{slug}` - Detail project by slug

#### Services

- `GET /api/services` - List semua services (active only)
- `GET /api/services/{slug}` - Detail service by slug

#### Templates

- `GET /api/templates` - List semua templates (published only)
- `GET /api/templates/{slug}` - Detail template by slug

#### Others

- `GET /api/team` - List team members
- `GET /api/testimonials` - List testimonials
- `GET /api/clients` - List clients
- `GET /api/faqs` - List FAQs
- `POST /api/contact` - Submit contact form
- `GET /api/settings` - Get all settings
- `GET /api/settings/{key}` - Get specific setting

## Instalasi

### Requirements

- PHP >= 8.2
- Composer
- SQLite/MySQL/PostgreSQL

### Setup

1. Install dependencies (sudah dilakukan):

```bash
composer install
```

2. Environment sudah dikonfigurasi dengan SQLite

3. Database migrations sudah dijalankan

4. Admin user sudah dibuat:
    - Email: nofileexistshere@gmail.com
    - Password: (yang Anda set saat instalasi)

5. Start development server:

```bash
php artisan serve
```

## Akses Filament Admin Panel

Setelah server berjalan, akses admin panel di:

```
http://localhost:8000/nexteam
```

Login menggunakan credentials yang telah dibuat.

## File Storage

File uploads disimpan di `storage/app/public/`. Untuk membuat symbolic link:

```bash
php artisan storage:link
```

Folder upload:

- `blog-images/` - Featured images untuk blog posts
- `blog-attachments/` - File attachments di blog content
- `projects/` - Project images
- `projects/gallery/` - Project gallery images
- `project-attachments/` - File attachments di project content

## CORS Configuration

CORS sudah dikonfigurasi untuk frontend Next.js di `localhost:3000` dan `localhost:3001`.

Untuk production, update `config/cors.php`:

```php
'allowed_origins' => [
    'https://yourdomain.com',
],
```

## Struktur Database

### Tables

- `users` - Admin users (Filament)
- `blog_posts` - Blog articles
- `projects` - Portfolio projects
- `services` - Services offered
- `templates` - Digital products/templates
- `team_members` - Team information
- `testimonials` - Client testimonials
- `clients` - Client logos
- `faqs` - FAQ items
- `contact_messages` - Contact form submissions
- `settings` - Site settings key-value pairs

## Tech Stack

- **Laravel 11** - PHP Framework
- **Filament v3** - Admin Panel
- **Laravel Sanctum** - API Authentication
- **SQLite** - Database (default)

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
