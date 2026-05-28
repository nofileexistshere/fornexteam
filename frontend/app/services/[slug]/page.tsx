import type { Metadata } from "next";
export const revalidate = 60;
import RevealOnScroll from "@/components/animation/reveal-on-scroll";
import { Button } from "@/components/ui/button";
import Link from "next/link";
import Image from "next/image";
import { notFound } from "next/navigation";
import { servicesApi } from "@/lib/api";

interface Service {
  id: number;
  name: string;
  slug: string;
  short_description: string;
  description: string;
  icon: string;
  image: string | null;
  is_featured: boolean;
  is_active: boolean;
  order: number;
  why_need?: string | null;
  benefits?: Array<{ text: string }> | null;
  workflow?: Array<{ step: string }> | null;
  platforms?: Array<{ name: string }> | null;
  contact_message?: string | null;
}

async function getService(slug: string): Promise<Service | null> {
  try {
    const response = await servicesApi.getAll();
    const services: Service[] = response.data;
    return services.find((s) => s.slug === slug) || null;
  } catch (error) {
    console.error("Error fetching service:", error);
    return null;
  }
}

export async function generateMetadata({ params }: { params: Promise<{ slug: string }> }): Promise<Metadata> {
  const { slug } = await params;
  const service = await getService(slug);

  if (!service) {
    return {
      title: "Service Not Found | NoFileExistsHere. (Nexteam)",
    };
  }

  const imageSrc = service.image ? `${process.env.NEXT_PUBLIC_API_URL}/storage/${service.image}` : "/placeholder.svg";

  return {
    title: `${service.name} | NoFileExistsHere. (Nexteam)`,
    description: service.description,
    openGraph: {
      title: `${service.name} | NoFileExistsHere. (Nexteam)`,
      description: service.description,
      url: `/services/${service.slug}`,
      type: "website",
      images: [
        {
          url: imageSrc,
          width: 1200,
          height: 630,
          alt: `${service.name} service preview by NoFileExistsHere (Nexteam)`,
        },
      ],
    },
  };
}

const ServiceDetailPage = async ({ params }: { params: Promise<{ slug: string }> }) => {
  const { slug } = await params;
  const service = await getService(slug);

  if (!service) {
    notFound();
  }

  const imageSrc = service.image ? `${process.env.NEXT_PUBLIC_API_URL}/storage/${service.image}` : "/placeholder.svg";

  return (
    <main className="min-h-[calc(100vh-4rem)] w-full border-b border-accent">
      <section className="max-w-(--breakpoint-xl) mx-auto w-full py-10 xs:py-14 px-6 space-y-10">
        <RevealOnScroll>
          <div className="space-y-3 text-center mb-6 md:mb-8">
            <h1 className="text-3xl xs:text-4xl md:text-5xl font-bold tracking-tight">{service.name}</h1>
            <p className="text-xs xs:text-sm text-muted-foreground">
              <br></br>
              <Link href="/" className="hover:text-foreground">
                Home
              </Link>{" "}
              /{" "}
              <Link href="/#services" className="hover:text-foreground">
                Services
              </Link>{" "}
              / <span className="text-foreground font-medium">{service.name}</span>
            </p>
            <br></br>
            {service.short_description && <p className="max-w-2xl mx-auto text-muted-foreground text-sm md:text-base">{service.short_description}</p>}
          </div>
        </RevealOnScroll>

        <RevealOnScroll delay={0.05}>
          <div className="rounded-xl overflow-hidden shadow-sm border bg-background">
            <div className="relative aspect-video">
              <Image src={imageSrc} alt={service.name} fill priority sizes="(min-width: 1024px) 1000px, (min-width: 768px) 800px, 100vw" className="object-contain object-center bg-muted" />
            </div>
          </div>
        </RevealOnScroll>

        <RevealOnScroll delay={0.08}>
          <div className="grid grid-cols-1 lg:grid-cols-[minmax(0,1.6fr)_minmax(0,1fr)] gap-10 items-start">
            <div className="space-y-6 text-sm md:text-base leading-relaxed text-muted-foreground">
              <section className="space-y-2">
                <h2 className="text-lg md:text-xl font-semibold text-foreground">Deskripsi</h2>
                <p>{service.description}</p>
              </section>

              {service.why_need && (
                <section className="space-y-2">
                  <h2 className="text-lg md:text-xl font-semibold text-foreground">Kenapa Perlu Layanan Ini?</h2>
                  <p>{service.why_need}</p>
                </section>
              )}

              {service.benefits && service.benefits.length > 0 && (
                <section className="space-y-2">
                  <h2 className="text-lg md:text-xl font-semibold text-foreground">Keuntungan / Contoh Kebutuhan:</h2>
                  <ul className="mt-2 list-disc pl-5 space-y-1">
                    {service.benefits.map((benefit, index) => (
                      <li key={index}>{benefit.text}</li>
                    ))}
                  </ul>
                </section>
              )}

              {service.workflow && service.workflow.length > 0 && (
                <section className="space-y-2">
                  <h2 className="text-lg md:text-xl font-semibold text-foreground">Alur Pengerjaan</h2>
                  <ol className="mt-2 list-decimal pl-5 space-y-1">
                    {service.workflow.map((step, index) => (
                      <li key={index}>{step.step}</li>
                    ))}
                  </ol>
                </section>
              )}

              {service.contact_message && (
                <section className="space-y-2">
                  <h2 className="text-lg md:text-xl font-semibold text-foreground">Hubungi Kami</h2>
                  <p>{service.contact_message}</p>
                </section>
              )}

              <div className="hidden md:flex flex-wrap gap-3 pt-2">
                <Button asChild size="sm" className="rounded-full">
                  <Link href="/">Back To Home</Link>
                </Button>
                <Button asChild size="sm" variant="outline" className="rounded-full">
                  <Link href="/#services">Back To Services</Link>
                </Button>
              </div>
            </div>

            <aside className="lg:sticky lg:top-24 space-y-4">
              {service.platforms && service.platforms.length > 0 && (
                <div className="rounded-lg border bg-card p-5 space-y-3">
                  <h3 className="font-semibold text-base md:text-lg">Platform</h3>
                  <ul className="space-y-2 text-sm text-muted-foreground">
                    {service.platforms.map((platform, index) => (
                      <li key={index}>• {platform.name}</li>
                    ))}
                  </ul>
                </div>
              )}

              <div className="rounded-lg border bg-card p-5 space-y-3">
                <h3 className="font-semibold text-base md:text-lg">Hubungi Kami</h3>
                <p className="text-sm text-muted-foreground">{service.contact_message || "Tertarik atau ingin diskusi lebih lanjut? Kami bantu kebutuhan teknologi yang sesuai dengan bisnis Anda."}</p>
                <Button asChild className="w-full rounded-full">
                  <Link href="/contact">Open To Services</Link>
                </Button>
              </div>
            </aside>
          </div>
        </RevealOnScroll>

        {/* Mobile-only CTA buttons */}
        <div className="mt-8 md:hidden flex flex-wrap gap-3">
          <Button asChild size="sm" className="flex-1 rounded-full justify-center">
            <Link href="/">Back To Home</Link>
          </Button>
          <Button asChild size="sm" variant="outline" className="flex-1 rounded-full justify-center">
            <Link href="/#services">Back To Services</Link>
          </Button>
        </div>
      </section>
    </main>
  );
};

export default ServiceDetailPage;
