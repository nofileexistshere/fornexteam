import type { Metadata } from "next";
import { Geist } from "next/font/google";
import "./globals.css";
import { ThemeProvider } from "next-themes";
import CookieConsent from "@/components/cookie-consent";

const geistSans = Geist({
  variable: "--font-geist-sans",
  subsets: ["latin"],
});

const siteUrl = process.env.NEXT_PUBLIC_SITE_URL ?? "http://localhost:3000";

export const metadata: Metadata = {
  title: "NoFileExistsHere.",
  description: "NoFileExistsHere (Nexteam) adalah penyedia layanan teknologi untuk website, aplikasi desktop, aplikasi mobile, desain grafis, jaringan internet, dan troubleshooting yang fokus pada solusi simpel, rapi, dan mudah digunakan.",
  keywords: [
    "NoFileExistsHere",
    "Nexteam",
    "jasa pembuatan website",
    "jasa pembuatan aplikasi",
    "jasa pembuatan aplikasi desktop",
    "jasa pembuatan aplikasi mobile",
    "jasa desain grafis",
    "jasa instalasi jaringan",
    "jasa troubleshooting komputer",
    "layanan IT",
    "IT support",
  ],
  metadataBase: new URL(siteUrl),
  openGraph: {
    type: "website",
    siteName: "NoFileExistsHere.",
    locale: "id_ID",
    url: siteUrl,
    title: "NoFileExistsHere.",
    description: "Website resmi NoFileExistsHere (Nexteam) yang menyediakan layanan teknologi: website, aplikasi, jaringan internet, dan dukungan teknis untuk kebutuhan personal maupun bisnis.",
    images: [
      {
        url: "/logo/logo.webp",
        width: 1200,
        height: 630,
        alt: "NoFileExistsHere (Nexteam) logo",
      },
    ],
  },
  twitter: {
    card: "summary_large_image",
    title: "NoFileExistsHere.",
    description: "Website resmi NoFileExistsHere (Nexteam) yang menyediakan layanan teknologi: website, aplikasi, jaringan internet, dan dukungan teknis untuk kebutuhan personal maupun bisnis.",
    images: [
      {
        url: "/logo/logo.webp",
        alt: "NoFileExistsHere (Nexteam) logo",
      },
    ],
  },
  authors: [
    {
      name: "NoFileExistsHere",
      url: siteUrl,
    },
  ],
  creator: "NoFileExistsHere / Nexteam",
  icons: [
    {
      rel: "icon",
      type: "image/webp",
      url: "/logo/logo.webp",
    },
    {
      rel: "apple-touch-icon",
      url: "/logo/logo.webp",
    },
  ],
  robots: {
    index: true,
    follow: true,
  },
  manifest: "/site.webmanifest",
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en" suppressHydrationWarning data-scroll-behavior="smooth">
      <body className={`${geistSans.className} antialiased`}>
        <ThemeProvider attribute="class" defaultTheme="light" enableSystem={false}>
          {children}
          <CookieConsent />
        </ThemeProvider>
      </body>
    </html>
  );
}
