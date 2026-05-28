# Nexteam — Monorepo

Website resmi **Nexteam (NoFileExistsHere)**, penyedia layanan teknologi. Repo ini berisi backend CMS dan frontend landing page dalam satu monorepo.

## Struktur Repo

```
nexteam/
├── backend/    # Laravel 11 + Filament v3 (CMS & REST API)
└── frontend/   # Next.js 15 + Tailwind CSS + Shadcn UI
```

---

## Backend — Laravel + Filament

Admin panel CMS untuk mengelola seluruh konten website.

**Tech Stack:** Laravel 11, Filament v3, Laravel Sanctum, SQLite

### Setup

```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Admin panel tersedia di: `http://localhost:8000/nexteam`

### API Endpoints

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/api/blog-posts` | List blog posts |
| GET | `/api/blog-posts/{slug}` | Detail blog post |
| GET | `/api/projects` | List projects |
| GET | `/api/projects/featured` | Featured projects |
| GET | `/api/projects/{slug}` | Detail project |
| GET | `/api/services` | List services |
| GET | `/api/services/{slug}` | Detail service |
| GET | `/api/templates` | List templates |
| GET | `/api/templates/{slug}` | Detail template |
| GET | `/api/team` | Team members |
| GET | `/api/testimonials` | Testimonials |
| GET | `/api/clients` | Clients |
| GET | `/api/faqs` | FAQs |
| POST | `/api/contact` | Submit contact form |
| GET | `/api/settings` | Site settings |

Lihat [backend/README.md](backend/README.md) untuk dokumentasi lengkap.

---

## Frontend — Next.js

Landing page dan halaman layanan teknologi Nexteam.

**Tech Stack:** Next.js 15 (App Router), TypeScript, Tailwind CSS, Shadcn UI, Framer Motion

### Setup

```bash
cd frontend
npm install
cp .env.example .env.local   # isi environment variables
npm run dev
```

Website tersedia di: `http://localhost:3000`

### Environment Variables

Buat file `.env.local` di folder `frontend/`:

```env
NEXT_PUBLIC_SITE_URL=http://localhost:3000
SMTP_HOST=
SMTP_PORT=
SMTP_SECURE=false
SMTP_USER=
SMTP_PASS=
SMTP_FROM=
SMTP_TO=
```

Lihat [frontend/README.md](frontend/README.md) untuk dokumentasi lengkap.

---

## Layanan

- Web Development
- Desktop Application
- Mobile Application
- Graphic Design
- Internet & Infrastructure
- Operating System
- Troubleshooting Cases

---

## Deployment

- **Backend**: Server dengan PHP 8.2+, Composer, dan web server (Nginx/Apache)
- **Frontend**: Vercel, Netlify, atau platform yang mendukung Next.js

Pastikan CORS di `backend/config/cors.php` sudah dikonfigurasi untuk domain produksi frontend.
