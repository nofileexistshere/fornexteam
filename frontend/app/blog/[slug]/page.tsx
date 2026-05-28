import type { Metadata } from "next";
export const revalidate = 60;
import Image from "next/image";
import Link from "next/link";
import { notFound } from "next/navigation";
import { Calendar, Eye, User, Tag } from "lucide-react";
import { Button } from "@/components/ui/button";
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

async function getBlogPost(slug: string): Promise<BlogPost | null> {
  try {
    const res = await blogApi.getBySlug(slug);
    return res.data;
  } catch (error) {
    console.error("Error fetching blog post:", error);
    return null;
  }
}

export async function generateMetadata({ params }: { params: Promise<{ slug: string }> }): Promise<Metadata> {
  const { slug } = await params;
  const post = await getBlogPost(slug);

  if (!post) {
    return {
      title: "Blog Post Not Found",
    };
  }

  return {
    title: `${post.title} | Blog NoFileExistsHere. (Nexteam)`,
    description: post.excerpt,
    openGraph: {
      title: post.title,
      description: post.excerpt,
      url: `/blog/${post.slug}`,
      type: "article",
      publishedTime: post.published_at,
      authors: post.author ? [post.author] : undefined,
      tags: post.tags,
      images: post.featured_image
        ? [
            {
              url: `${process.env.NEXT_PUBLIC_API_URL}/storage/${post.featured_image}`,
              width: 1200,
              height: 630,
              alt: post.title,
            },
          ]
        : [
            {
              url: "/placeholder.svg",
              width: 1200,
              height: 630,
              alt: post.title,
            },
          ],
    },
  };
}

const BlogDetailPage = async ({ params }: { params: Promise<{ slug: string }> }) => {
  const { slug } = await params;
  const post = await getBlogPost(slug);

  if (!post) {
    notFound();
  }

  const formattedDate = new Date(post.published_at).toLocaleDateString("id-ID", {
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
          <Link href="/blog" className="hover:text-foreground">
            Blog
          </Link>{" "}
          / <span className="text-foreground font-medium">{post.title}</span>
        </p>

        {/* Category */}
        {post.category && <p className="text-xs font-medium uppercase tracking-wide text-primary mb-4">{post.category}</p>}

        {/* Title */}
        <h1 className="text-3xl xs:text-4xl md:text-5xl font-bold tracking-tight mb-6">{post.title}</h1>

        {/* Meta Info */}
        <div className="flex flex-wrap gap-4 text-sm text-muted-foreground mb-8">
          {post.author && (
            <div className="flex items-center gap-2">
              <User className="w-4 h-4" />
              <span>{post.author}</span>
            </div>
          )}
          <div className="flex items-center gap-2">
            <Calendar className="w-4 h-4" />
            <span>{formattedDate}</span>
          </div>
          <div className="flex items-center gap-2">
            <Eye className="w-4 h-4" />
            <span>{post.views} views</span>
          </div>
        </div>

        {/* Featured Image */}
        <div className="relative aspect-video w-full mb-8 rounded-xl overflow-hidden border-2 border-accent">
          <Image src={post.featured_image ? `${process.env.NEXT_PUBLIC_API_URL}/storage/${post.featured_image}` : "/placeholder.svg"} alt={post.title} fill sizes="(min-width: 1024px) 900px, 100vw" className="object-cover" priority />
        </div>

        {/* Tags */}
        {post.tags.length > 0 && (
          <div className="flex flex-wrap gap-2 mb-8">
            <Tag className="w-4 h-4 text-muted-foreground mt-0.5" />
            {post.tags.map((tag) => (
              <span key={tag} className="text-xs px-3 py-1 bg-accent rounded-full text-foreground">
                {tag}
              </span>
            ))}
          </div>
        )}

        {/* Content */}
        <div
          className="prose prose-slate dark:prose-invert max-w-none
            prose-headings:font-bold prose-headings:tracking-tight
            prose-h1:text-3xl prose-h2:text-2xl prose-h3:text-xl
            prose-p:text-muted-foreground prose-p:leading-7
            prose-a:text-primary prose-a:no-underline hover:prose-a:underline
            prose-strong:text-foreground prose-strong:font-semibold
            prose-ul:text-muted-foreground prose-ol:text-muted-foreground
            prose-li:marker:text-primary
            prose-blockquote:border-l-primary prose-blockquote:text-muted-foreground
            prose-code:text-primary prose-code:bg-accent prose-code:px-1.5 prose-code:py-0.5 prose-code:rounded
            prose-pre:bg-accent prose-pre:border-2 prose-pre:border-border
            prose-img:rounded-lg prose-img:border-2 prose-img:border-accent"
          dangerouslySetInnerHTML={{ __html: post.content }}
        />

        {/* CTA */}
        <div className="mt-12 pt-8 border-t-2 border-accent">
          <div className="flex flex-col sm:flex-row gap-4 justify-between items-center">
            <Button variant="outline" asChild className="rounded-full px-6">
              <Link href="/blog">← Back to Blog</Link>
            </Button>
            <Button asChild className="rounded-full px-6">
              <Link href="/contact">Discuss Your Blog</Link>
            </Button>
          </div>
        </div>
      </article>
    </main>
  );
};

export default BlogDetailPage;
