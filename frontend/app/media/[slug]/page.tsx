import type { Metadata } from "next";
import Image from "next/image";
import Link from "next/link";
import { notFound } from "next/navigation";
import { Calendar, Eye, Tag } from "lucide-react";
import { Button } from "@/components/ui/button";
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

async function getMediaItem(slug: string): Promise<MediaItem | null> {
  try {
    const res = await mediaApi.getBySlug(slug);
    return res.data;
  } catch (error) {
    console.error("Error fetching media item:", error);
    return null;
  }
}

export async function generateMetadata({ params }: { params: Promise<{ slug: string }> }): Promise<Metadata> {
  const { slug } = await params;
  const item = await getMediaItem(slug);

  if (!item) {
    return {
      title: "Media Not Found",
    };
  }

  return {
    title: `${item.title} | Media Gallery NoFileExistsHere. (Nexteam)`,
    description: item.description || item.title,
    openGraph: {
      title: item.title,
      description: item.description || item.title,
      url: `/media/${item.slug}`,
      type: "article",
      publishedTime: item.published_at,
      tags: item.tags,
      images: [
        {
          url: item.image ? `${process.env.NEXT_PUBLIC_API_URL}/storage/${item.image}` : "/placeholder.svg",
          width: 1200,
          height: 630,
          alt: item.title,
        },
      ],
    },
  };
}

const MediaDetailPage = async ({ params }: { params: Promise<{ slug: string }> }) => {
  const { slug } = await params;
  const item = await getMediaItem(slug);

  if (!item) {
    notFound();
  }

  const formattedDate = new Date(item.published_at).toLocaleDateString("id-ID", {
    year: "numeric",
    month: "long",
    day: "numeric",
  });

  return (
    <main className="min-h-[calc(100vh-4rem)] w-full">
      <article className="max-w-(--breakpoint-lg) mx-auto w-full py-12 xs:py-20 px-6">
        {/* Breadcrumb */}
        <p className="text-xs xs:text-sm text-muted-foreground mb-8">
          <Link href="/" className="hover:text-foreground">
            Home
          </Link>{" "}
          /{" "}
          <Link href="/media" className="hover:text-foreground">
            Media
          </Link>{" "}
          / <span className="text-foreground font-medium">{item.title}</span>
        </p>

        {/* Category */}
        {item.category && <p className="text-xs font-medium uppercase tracking-wide text-primary mb-4">{item.category}</p>}

        {/* Title */}
        <h1 className="text-3xl xs:text-4xl md:text-5xl font-bold tracking-tight mb-6">{item.title}</h1>

        {/* Meta Info */}
        <div className="flex flex-wrap gap-4 text-sm text-muted-foreground mb-8">
          <div className="flex items-center gap-2">
            <Calendar className="w-4 h-4" />
            <span>{formattedDate}</span>
          </div>
          <div className="flex items-center gap-2">
            <Eye className="w-4 h-4" />
            <span>{item.views} views</span>
          </div>
        </div>

        {/* Main Image */}
        <div className="relative aspect-video w-full mb-8 rounded-xl overflow-hidden border-2 border-accent">
          <Image src={item.image ? `${process.env.NEXT_PUBLIC_API_URL}/storage/${item.image}` : "/placeholder.svg"} alt={item.title} fill sizes="(min-width: 1024px) 900px, 100vw" className="object-cover" priority />
        </div>

        {/* Tags */}
        {item.tags.length > 0 && (
          <div className="flex flex-wrap gap-2 mb-8">
            <Tag className="w-4 h-4 text-muted-foreground mt-0.5" />
            {item.tags.map((tag) => (
              <span key={tag} className="text-xs px-3 py-1 bg-accent rounded-full text-foreground">
                {tag}
              </span>
            ))}
          </div>
        )}

        {/* Description */}
        {item.description && (
          <div className="prose prose-slate dark:prose-invert max-w-none mb-8">
            <p className="text-base md:text-lg text-muted-foreground leading-relaxed">{item.description}</p>
          </div>
        )}

        {/* CTA */}
        <div className="mt-12 pt-8 border-t-2 border-accent">
          <div className="flex flex-col sm:flex-row gap-4 justify-between items-center">
            <Button variant="outline" asChild className="rounded-full px-6">
              <Link href="/media">← Kembali ke Gallery</Link>
            </Button>
            <Button asChild className="rounded-full px-6">
              <Link href="/contact">Diskusikan Project Anda</Link>
            </Button>
          </div>
        </div>
      </article>
    </main>
  );
};

export default MediaDetailPage;
