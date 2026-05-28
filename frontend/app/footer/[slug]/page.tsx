import { notFound } from "next/navigation";
import Footer from "@/components/footer";
import { Navbar } from "@/components/navbar";
import type { Metadata } from "next";
import { footerPagesApi } from "@/lib/api";

interface FooterPage {
  id: number;
  title: string;
  slug: string;
  content: string;
  excerpt: string | null;
  meta_title: string | null;
  meta_description: string | null;
  is_published: boolean;
  created_at: string;
  updated_at: string;
}

async function getFooterPage(slug: string): Promise<FooterPage | null> {
  try {
    const res = await footerPagesApi.getBySlug(slug);
    return res.data.success ? res.data.data : null;
  } catch (error) {
    console.error("Error fetching footer page:", error);
    return null;
  }
}

export async function generateMetadata({ params }: { params: Promise<{ slug: string }> }): Promise<Metadata> {
  const { slug } = await params;
  const page = await getFooterPage(slug);

  if (!page) {
    return {
      title: "Page Not Found",
    };
  }

  return {
    title: page.meta_title || page.title,
    description: page.meta_description || page.excerpt || undefined,
  };
}

export default async function FooterPageDetail({ params }: { params: Promise<{ slug: string }> }) {
  const { slug } = await params;
  const page = await getFooterPage(slug);

  if (!page) {
    notFound();
  }

  return (
    <>
      <Navbar />
      <main className="min-h-screen">
        <div className="container mx-auto px-4 py-12 max-w-4xl">
          <article className="prose prose-lg dark:prose-invert max-w-none">
            <h1 className="text-4xl font-bold mb-4">{page.title}</h1>
            {page.excerpt && <p className="text-xl text-muted-foreground mb-8">{page.excerpt}</p>}
            <div className="mt-8" dangerouslySetInnerHTML={{ __html: page.content }} />
            <div className="mt-8 text-sm text-muted-foreground">Last updated: {new Date(page.updated_at).toLocaleDateString()}</div>
          </article>
        </div>
      </main>
      <Footer />
    </>
  );
}
