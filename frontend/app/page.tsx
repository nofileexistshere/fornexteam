import type { Metadata } from "next";
export const revalidate = 60;
import FAQ from "@/components/faq";
import Service from "@/components/service";
import Footer from "@/components/footer";
import Hero from "@/components/hero";
import { Navbar } from "@/components/navbar";
import OurClients from "@/components/our-clients";
import OurTeam from "@/components/ourteam";
import Testimonial from "@/components/testimonial";
import WhatsAppBubble from "@/components/whatsapp-bubble";
import CtaAfterTeam from "@/components/cta-after-team";
import AiChatBubble from "@/components/ai-chat-bubble";

export const metadata: Metadata = {
  title: "NoFileExistsHere. (Nexteam) - Jasa Pembuatan Website & Aplikasi",
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
  openGraph: {
    title: "NoFileExistsHere. (Nexteam) - Jasa Pembuatan Website & Aplikasi",
    description:
      "NoFileExistsHere (Nexteam) adalah penyedia layanan teknologi untuk website, aplikasi desktop, aplikasi mobile, desain grafis, jaringan internet, dan troubleshooting yang fokus pada solusi simpel, rapi, dan mudah digunakan.",
    url: "/",
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

export default function Home() {
  return (
    <>
      <Navbar />
      <Hero />
      <Service />
      <FAQ />
      <OurClients />
      <Testimonial />
      <OurTeam />
      <CtaAfterTeam />
      <Footer />
      <WhatsAppBubble />
      <AiChatBubble />
    </>
  );
}
