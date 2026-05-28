import type { Metadata } from "next";
export const revalidate = 60;
import RevealOnScroll from "@/components/animation/reveal-on-scroll";
import { Button } from "@/components/ui/button";
import Link from "next/link";
import Image from "next/image";
import { blogApi } from "@/lib/api";

interface BlogPost {
  id: number;
  title: string;
  slug: string;
  excerpt: string;
  content: string;
  featured_image?: string;
  author?: string;
  category?: string;
  tags: string[];
  is_published: boolean;
  published_at: string;
  views: number;
}

interface PaginatedResponse {
  data: BlogPost[];
  current_page: number;
  last_page: number;
  per_page: number;
  total: number;
}

async function getBlogPosts(): Promise<PaginatedResponse> {
  try {
    const res = await blogApi.getAll();
    return res.data;
  } catch (error) {
    console.error("Error fetching blog posts:", error);
    return { data: [], current_page: 1, last_page: 1, per_page: 10, total: 0 };
  }
}

export const metadata: Metadata = {
  title: "Blog | NoFileExistsHere. (Nexteam)",
  description: "Kumpulan artikel dan catatan dari NoFileExistsHere (Nexteam) seputar teknologi, infrastruktur, dan pengalaman project yang pernah kami kerjakan.",
  openGraph: {
    title: "Blog | NoFileExistsHere. (Nexteam)",
    description: "Baca insight dan cerita di balik project, tips seputar website, aplikasi, dan infrastruktur dari tim NoFileExistsHere (Nexteam).",
    url: "/blog",
    type: "website",
    images: [
      {
        url: "/logo/logo.webp",
        width: 1200,
        height: 630,
        alt: "NoFileExistsHere (Nexteam) blog cover",
      },
    ],
  },
};

const BlogPage = async () => {
  const { data: posts } = await getBlogPosts();

  return (
    <main className="min-h-[calc(100vh-4rem)] w-full">
      <section className="max-w-(--breakpoint-xl) mx-auto w-full py-12 xs:py-20 px-6 space-y-10">
        <RevealOnScroll>
          <div className="space-y-3 text-center mb-6 md:mb-8">
            <h1 className="text-3xl xs:text-4xl md:text-5xl font-bold tracking-tight">Blog</h1>
            <p className="text-xs xs:text-sm text-muted-foreground">
              <br />
              <Link href="/" className="hover:text-foreground">
                Home
              </Link>{" "}
              / <span className="text-foreground font-medium">Blog</span>
            </p>
            <br />
            <p className="max-w-2xl mx-auto text-muted-foreground text-sm md:text-base">Di sini kami menulis insight singkat, studi kasus, dan catatan ringan seputar website, aplikasi, dan infrastruktur yang kami kerjakan.</p>
          </div>
        </RevealOnScroll>

        <RevealOnScroll delay={0.05}>
          {posts.length === 0 ? (
            <div className="text-center py-12 text-muted-foreground">
              <p>Belum ada artikel blog tersedia.</p>
            </div>
          ) : (
            <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
              {posts.map((post) => (
                <Link key={post.slug} href={`/blog/${post.slug}`} className="group flex h-full flex-col rounded-xl border-2 border-accent bg-background/60 overflow-hidden transition-transform duration-150 hover:-translate-y-0.5">
                  <div className="relative aspect-video w-full bg-muted">
                    <Image
                      src={post.featured_image ? `${process.env.NEXT_PUBLIC_API_URL}/storage/${post.featured_image}` : "/placeholder.svg"}
                      alt={post.title}
                      fill
                      sizes="(min-width: 1024px) 400px, (min-width: 768px) 350px, 100vw"
                      className="object-cover"
                    />
                  </div>
                  <div className="flex flex-col justify-between flex-1 p-6">
                    <div>
                      {post.category && <p className="text-xs font-medium uppercase tracking-wide text-muted-foreground">{post.category}</p>}
                      <h2 className="mt-2 text-lg font-semibold tracking-tight group-hover:underline">{post.title}</h2>
                      <p className="mt-3 text-sm text-muted-foreground line-clamp-3">{post.excerpt}</p>
                    </div>
                    <div className="mt-4 flex items-center justify-between">
                      <p className="text-xs font-medium text-primary group-hover:underline">Baca selengkapnya</p>
                      {post.author && <p className="text-xs text-muted-foreground">by {post.author}</p>}
                    </div>
                  </div>
                </Link>
              ))}
            </div>
          )}
        </RevealOnScroll>

        <div className="mt-8 flex justify-center">
          <Button variant="outline" asChild className="rounded-full px-6">
            <Link href="/contact">Discuss Your Blog Ideas or Projects</Link>
          </Button>
        </div>
      </section>
    </main>
  );
};

export default BlogPage;
