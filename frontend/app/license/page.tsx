import type { Metadata } from "next";
import RevealOnScroll from "@/components/animation/reveal-on-scroll";
import { Button } from "@/components/ui/button";
import Link from "next/link";
import { licenseApi } from "@/lib/api";

interface LicenseData {
  id: number;
  title: string;
  description: string;
  nib: string;
  npwp: string;
  company_name: string;
  category: string;
  process_history: Array<{
    title: string;
    description: string;
    date: string;
  }>;
  terms_summary: Array<{
    item: string;
  }>;
  privacy_summary: Array<{
    item: string;
  }>;
  is_active: boolean;
}

async function getLicense(): Promise<LicenseData | null> {
  try {
    const res = await licenseApi.get();
    return res.data;
  } catch (error) {
    console.error("Error fetching license:", error);
    return null;
  }
}

export async function generateMetadata(): Promise<Metadata> {
  const license = await getLicense();

  return {
    title: `${license?.title || "License"} | NoFileExistsHere. (Nexteam)`,
    description: license?.description || "Informasi legal dan perizinan usaha yang terkait dengan NoFileExistsHere (Nexteam).",
    openGraph: {
      title: `${license?.title || "License"} | NoFileExistsHere. (Nexteam)`,
      description: license?.description || "Lihat ringkasan dokumen legal dan perizinan usaha NoFileExistsHere (Nexteam).",
      url: "/license",
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
}

const LicensePage = async () => {
  const license = await getLicense();

  if (!license) {
    return (
      <main className="min-h-[calc(100vh-4rem)] w-full border-b border-accent flex items-center justify-center">
        <div className="text-center">
          <h1 className="text-2xl font-bold">License data not found</h1>
          <p className="text-muted-foreground mt-2">Please contact administrator</p>
        </div>
      </main>
    );
  }
  return (
    <main className="min-h-[calc(100vh-4rem)] w-full border-b border-accent">
      <section className="max-w-(--breakpoint-xl) mx-auto w-full py-12 xs:py-20 px-6 space-y-10">
        <RevealOnScroll>
          <div className="text-center space-y-3">
            <h1 className="text-3xl xs:text-4xl md:text-5xl font-bold tracking-tight">{license.title}</h1>
            <p className="max-w-2xl mx-auto text-sm md:text-base text-muted-foreground">{license.description}</p>
          </div>
        </RevealOnScroll>

        {/* Kartu utama - detail NIB / legal entity */}
        <RevealOnScroll delay={0.05}>
          <div className="rounded-2xl border bg-background/80 shadow-sm overflow-hidden">
            <div className="border-b bg-muted/50 px-4 py-3 flex items-center justify-between">
              <div>
                <p className="text-xs uppercase tracking-[0.2em] text-muted-foreground">DETAIL LEGAL</p>
                <p className="text-sm font-semibold">Nomor Induk Berusaha (NIB)</p>
              </div>
              <span className="inline-flex items-center rounded-full border px-3 py-1 text-xs font-medium text-muted-foreground">View Card</span>
            </div>

            <div className="px-4 sm:px-6 py-4 sm:py-5 bg-card/50">
              <div className="overflow-hidden rounded-xl border bg-background/80">
                <div className="grid grid-cols-1 sm:grid-cols-2 border-b divide-y sm:divide-y-0 sm:divide-x divide-border">
                  <div className="px-4 py-3 text-sm">
                    <p className="text-[11px] uppercase tracking-[0.18em] text-muted-foreground">NIB</p>
                    <p className="mt-1 font-medium text-foreground/90">{license.nib}</p>
                  </div>
                  <div className="px-4 py-3 text-sm">
                    <p className="text-[11px] uppercase tracking-[0.18em] text-muted-foreground">NPWP</p>
                    <p className="mt-1 text-foreground/80">{license.npwp}</p>
                  </div>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-2 divide-y sm:divide-y-0 sm:divide-x divide-border">
                  <div className="px-4 py-3 text-sm">
                    <p className="text-[11px] uppercase tracking-[0.18em] text-muted-foreground">Nama Perusahaan</p>
                    <p className="mt-1 font-medium text-foreground/90">{license.company_name}</p>
                  </div>
                  <div className="px-4 py-3 text-sm">
                    <p className="text-[11px] uppercase tracking-[0.18em] text-muted-foreground">Kategori</p>
                    <p className="mt-1 text-foreground/80">{license.category}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </RevealOnScroll>

        {/* Kartu riwayat proses / timeline singkat */}
        <RevealOnScroll delay={0.08}>
          <div className="rounded-2xl border bg-background/80 shadow-sm overflow-hidden">
            <div className="border-b bg-muted/50 px-4 py-3">
              <p className="text-xs uppercase tracking-[0.2em] text-muted-foreground">RIWAYAT PROSES</p>
              <p className="text-sm font-semibold">Ringkasan Tahapan Penerbitan</p>
            </div>

            <div className="px-4 sm:px-6 py-5">
              <div className="grid gap-4 md:grid-cols-3">
                {license.process_history.map((process, index) => (
                  <div key={index} className="rounded-xl border bg-background/80 px-4 py-4 flex flex-col gap-2">
                    <p className="text-xs font-semibold text-foreground">{process.title}</p>
                    <p className="text-xs text-muted-foreground">{process.description}</p>
                    <p className="text-[11px] text-muted-foreground">{process.date}</p>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </RevealOnScroll>

        {/* Ringkasan Terms & Privacy untuk usaha mikro */}
        <RevealOnScroll delay={0.065}>
          <div className="rounded-2xl border bg-background/80 shadow-sm overflow-hidden">
            <div className="border-b bg-muted/50 px-4 py-3">
              <p className="text-xs uppercase tracking-[0.2em] text-muted-foreground">RINGKASAN TERMS & PRIVACY</p>
              <p className="text-sm font-semibold">Penggunaan Layanan untuk Usaha Mikro</p>
            </div>

            <div className="px-4 sm:px-6 py-5 space-y-4 text-sm md:text-base text-muted-foreground">
              <div>
                <p className="text-xs font-semibold uppercase tracking-[0.18em] text-foreground/70">TERMS (SINGKAT)</p>
                <ul className="mt-2 list-disc pl-5 space-y-1 text-sm">
                  {license.terms_summary.map((term, index) => (
                    <li key={index}>{term.item}</li>
                  ))}
                </ul>
              </div>

              <div>
                <p className="text-xs font-semibold uppercase tracking-[0.18em] text-foreground/70">PRIVACY (SINGKAT)</p>
                <ul className="mt-2 list-disc pl-5 space-y-1 text-sm">
                  {license.privacy_summary.map((privacy, index) => (
                    <li key={index}>{privacy.item}</li>
                  ))}
                  <li>
                    Untuk penjelasan lebih lengkap, silakan lihat halaman{" "}
                    <Link href="/terms" className="underline underline-offset-4">
                      Terms
                    </Link>{" "}
                    dan{" "}
                    <Link href="/privacy" className="underline underline-offset-4">
                      Privacy
                    </Link>
                    .
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </RevealOnScroll>

        {/* CTA */}
        <div className="flex justify-center">
          <Button variant="outline" asChild className="rounded-full px-6">
            <Link href="/">Back to Home</Link>
          </Button>
        </div>
      </section>
    </main>
  );
};

export default LicensePage;
