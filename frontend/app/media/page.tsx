import type { Metadata } from "next";
import RevealOnScroll from "@/components/animation/reveal-on-scroll";
import { Button } from "@/components/ui/button";
import Link from "next/link";
import Image from "next/image";
import { mediaApi } from "@/lib/api";

interface MediaItem {
  id: number;
  title: string;
  slug: string;
  description?: string;
  image: string;
  category?: string;
  tags: string[];
  is_published: boolean;
  published_at: string;
  views: number;
}

interface PaginatedResponse {
  data: MediaItem[];
  current_page: number;
  last_page: number;
  per_page: number;
  total: number;
}

async function getMedia(): Promise<PaginatedResponse> {
  try {
    const res = await mediaApi.getAll();
    return res.data;
  } catch (error) {
    console.error("Error fetching media:", error);
    return { data: [], current_page: 1, last_page: 1, per_page: 12, total: 0 };
  }
}

export const metadata: Metadata = {
  title: "Media Gallery | NoFileExistsHere. (Nexteam)",
  description: "Galeri foto dan dokumentasi dari NoFileExistsHere (Nexteam) - project, event, dan momen-momen berharga tim kami.",
  openGraph: {
    title: "Media Gallery | NoFileExistsHere. (Nexteam)",
    description: "Lihat dokumentasi visual dari project, event, dan aktivitas tim NoFileExistsHere (Nexteam).",
    url: "/media",
    type: "website",
    images: [
      {
        url: "/logo/logo.webp",
        width: 1200,
        height: 630,
        alt: "NoFileExistsHere (Nexteam) media gallery",
      },
    ],
  },
};

const MediaPage = async () => {
  const { data: media } = await getMedia();

  return (
    <main className="min-h-[calc(100vh-4rem)] w-full">
      <section className="max-w-(--breakpoint-xl) mx-auto w-full py-12 xs:py-20 px-6 space-y-10">
        <RevealOnScroll>
          <div className="space-y-3 text-center mb-6 md:mb-8">
            <h1 className="text-3xl xs:text-4xl md:text-5xl font-bold tracking-tight">Media Gallery</h1>
            <p className="text-xs xs:text-sm text-muted-foreground">
              <br />
              <Link href="/" className="hover:text-foreground">
                Home
              </Link>{" "}
              / <span className="text-foreground font-medium">Media</span>
            </p>
            <br />
            <p className="max-w-2xl mx-auto text-muted-foreground text-sm md:text-base">Dokumentasi visual dari berbagai project, event, dan momen berharga yang telah kami lalui bersama.</p>
          </div>
        </RevealOnScroll>

        <RevealOnScroll delay={0.05}>
          {media.length === 0 ? (
            <div className="text-center py-12 text-muted-foreground">
              <p>Belum ada media tersedia.</p>
            </div>
          ) : (
            <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
              {media.map((item) => (
                <Link key={item.slug} href={`/media/${item.slug}`} className="group flex flex-col rounded-xl border-2 border-accent bg-background/60 overflow-hidden transition-transform duration-150 hover:-translate-y-0.5">
                  <div className="relative aspect-video w-full bg-muted">
                    <Image
                      src={item.image ? `${process.env.NEXT_PUBLIC_API_URL}/storage/${item.image}` : "/placeholder.svg"}
                      alt={item.title}
                      fill
                      sizes="(min-width: 1024px) 400px, (min-width: 768px) 350px, 100vw"
                      className="object-cover transition-transform duration-300 group-hover:scale-105"
                    />
                  </div>
                  <div className="flex flex-col flex-1 p-6">
                    <div className="flex-1">
                      {item.category && <p className="text-xs font-medium uppercase tracking-wide text-muted-foreground mb-2">{item.category}</p>}
                      <h2 className="text-lg font-semibold tracking-tight group-hover:underline">{item.title}</h2>
                      {item.description && <p className="mt-2 text-sm text-muted-foreground line-clamp-2">{item.description}</p>}
                    </div>
                    <div className="mt-4 flex items-center justify-between text-xs text-muted-foreground">
                      <span>
                        {new Date(item.published_at).toLocaleDateString("id-ID", {
                          year: "numeric",
                          month: "short",
                          day: "numeric",
                        })}
                      </span>
                      <span>{item.views} views</span>
                    </div>
                  </div>
                </Link>
              ))}
            </div>
          )}
        </RevealOnScroll>

        <div className="mt-8 flex justify-center">
          <Button variant="outline" asChild className="rounded-full px-6">
            <Link href="/contact">Have a project you want documented?</Link>
          </Button>
        </div>
      </section>
    </main>
  );
};

export default MediaPage;
