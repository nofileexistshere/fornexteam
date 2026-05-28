import type { Metadata } from "next";
import ContactPage from "./ContactPage";

export const metadata: Metadata = {
  title: "Hubungi Kami | NoFileExistsHere. (Nexteam)",
  description: "Hubungi NoFileExistsHere (Nexteam) untuk konsultasi layanan teknologi. Kami siap membantu kebutuhan website, aplikasi, jaringan, dan troubleshooting untuk bisnis Anda.",
  keywords: ["hubungi kami", "kontak", "konsultasi IT", "konsultasi website", "konsultasi aplikasi", "NoFileExistsHere kontak", "Nexteam contact"],
  openGraph: {
    title: "Hubungi Kami | NoFileExistsHere. (Nexteam)",
    description: "Hubungi NoFileExistsHere (Nexteam) untuk konsultasi layanan teknologi. Kami siap membantu kebutuhan website, aplikasi, jaringan, dan troubleshooting untuk bisnis Anda.",
    url: "/contact",
    type: "website",
    images: [
      {
        url: "/logo/logo.webp",
        width: 1200,
        height: 630,
        alt: "NoFileExistsHere (Nexteam) logo",
      },
    ],
  },
};

export default function Page() {
  return <ContactPage />;
}
