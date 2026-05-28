# NoFileExistsHere / Nexteam Website

Landing page dan website layanan teknologi **NoFileExistsHere (Nexteam)** yang dibangun dengan Next.js 15, Tailwind CSS, dan Shadcn UI.

Website ini berfokus pada penyediaan informasi layanan:

- **Web Development**
- **Desktop Application**
- **Mobile Application**
- **Graphic Design**
- **Internet & Infrastructure**
- **Operating System**
- **Troubleshooting Cases**

Konten utama menggunakan bahasa Indonesia, sementara judul, navbar, dan teks tombol tetap menggunakan bahasa Inggris sesuai kebutuhan brand.

## Fitur Utama

- **Landing page modern** dengan hero, services, testimonials, FAQ, Our Team, dan Our Clients.
- **Halaman detail service** untuk setiap layanan dengan hero image 16:9, breadcrumb, dan CTA.
- **Halaman statis tambahan**: About Us, Terms & Conditions, Privacy Policy, Contact.
- **Form kontak** yang terhubung ke API route dengan pengiriman email via SMTP (Nodemailer).
- **Dekorasi visual**: background garis bergelombang, ilustrasi hero, dan elemen tambahan di contact.
- **SEO ready**:
  - Global metadata di `app/layout.tsx`.
  - Metadata/Open Graph per halaman service di `app/services/*/page.tsx`.

## Tech Stack

- **Framework**: Next.js 15 (App Router)
- **Bahasa**: TypeScript, React
- **UI**: Tailwind CSS, [Shadcn UI](https://ui.shadcn.com)
- **Animasi**: Framer Motion (RevealOnScroll)
- **Ikon**: Lucide React
- **Email**: Nodemailer via API route `/api/contact`

## Menjalankan Secara Lokal

1. Install dependencies:

```bash
npm install
```

2. Jalankan development server:

```bash
npm run dev
```

3. Buka `http://localhost:3000` di browser.

## Environment Variables

Beberapa environment variable yang digunakan (lihat juga `app/api/contact/route.ts`):

- `NEXT_PUBLIC_SITE_URL` – URL publik website (contoh: `https://nofileexistshere.com`).
- `SMTP_HOST` – host SMTP.
- `SMTP_PORT` – port SMTP.
- `SMTP_SECURE` – `true`/`false` sesuai kebutuhan.
- `SMTP_USER` – username akun SMTP.
- `SMTP_PASS` – password akun SMTP.
- `SMTP_FROM` – alamat email pengirim default.
- `SMTP_TO` – alamat email penerima pesan dari form kontak.

Semua variable ini sebaiknya didefinisikan di file `.env.local` (tidak di-commit).

## Struktur Penting

- `app/layout.tsx` – konfigurasi layout global, SEO utama, dan ThemeProvider.
- `app/page.tsx` – landing page utama.
- `app/services/*/page.tsx` – halaman detail tiap service.
- `app/contact/page.tsx` – halaman kontak + form.
- `app/about-us/page.tsx` – halaman About Us.
- `components/` – komponen UI seperti `hero`, `service`, `testimonial`, `ourteam`, `our-clients`, `footer`, dan navbar.

## Deployment

Project ini dapat dideploy ke platform yang mendukung Next.js (misalnya Vercel atau Netlify). Pastikan:

- Environment variables sudah diatur di dashboard platform.
- `NEXT_PUBLIC_SITE_URL` mengarah ke domain produksi.

---

Project ini berasal dari template Shadcn UI Landing Page dan telah dimodifikasi agar sesuai dengan kebutuhan brand **NoFileExistsHere / Nexteam**.
