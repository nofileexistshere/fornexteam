import type { Metadata } from "next";
import RevealOnScroll from "@/components/animation/reveal-on-scroll";
import { Button } from "@/components/ui/button";
import Link from "next/link";
import StorePageClient from "./store-page-client";

export const metadata: Metadata = {
  title: "Store | NoFileExistsHere. (Nexteam)",
  description: "Koleksi template website siap pakai dari NoFileExistsHere (Nexteam) untuk membantu Anda mulai lebih cepat.",
  openGraph: {
    title: "Store | NoFileExistsHere. (Nexteam)",
    description: "Pilih template website yang sesuai kebutuhan bisnis Anda, lalu diskusikan kustomisasinya bersama tim kami.",
    url: "/store",
    type: "website",
    images: [
      {
        url: "/logo/logo.webp",
        width: 1200,
        height: 630,
        alt: "NoFileExistsHere (Nexteam) store cover",
      },
    ],
  },
};

const StorePage = () => {
  return (
    <main className="min-h-[calc(100vh-4rem)] w-full">
      <section className="max-w-(--breakpoint-xl) mx-auto w-full py-12 xs:py-20 px-6 space-y-10">
        <RevealOnScroll>
          <div className="space-y-3 text-center mb-6 md:mb-8">
            <h1 className="text-3xl xs:text-4xl md:text-5xl font-bold tracking-tight">Store</h1>
            <p className="text-xs xs:text-sm text-muted-foreground">
              <br />
              <Link href="/" className="hover:text-foreground">
                Home
              </Link>{" "}
              / <span className="text-foreground font-medium">Store</span>
            </p>
            <br />
            <p className="max-w-2xl mx-auto text-muted-foreground text-sm md:text-base">
              Di sini Anda bisa melihat beberapa template website yang kami siapkan. Cocok jika Anda ingin mulai lebih cepat, lalu mengkustomisasi desain dan fiturnya sesuai kebutuhan bisnis.
            </p>
          </div>
        </RevealOnScroll>

        <RevealOnScroll delay={0.03}>
          <StorePageClient />
        </RevealOnScroll>

        <div className="mt-8 flex justify-center">
          <Button variant="outline" asChild className="rounded-full px-6">
            <Link href="/contact">Discuss Your Project</Link>
          </Button>
        </div>
      </section>
    </main>
  );
};

export default StorePage;
