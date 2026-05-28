import type { Metadata } from "next";
export const revalidate = 60;
import Link from "next/link";
import { notFound } from "next/navigation";
import Image from "next/image";

import RevealOnScroll from "@/components/animation/reveal-on-scroll";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardHeader } from "@/components/ui/card";
import { templatesApi } from "@/lib/api";

type TemplateData = {
  id: number;
  name: string;
  slug: string;
  description: string;
  content: string;
  category: string;
  tags: string[];
  preview_image: string | null;
  price: number;
  demo_url: string | null;
  download_url: string | null;
  version: string;
  features: string[];
  is_featured: boolean;
  is_published: boolean;
  downloads: number;
  updated_at: string;
};

async function getTemplate(slug: string): Promise<TemplateData | null> {
  try {
    const response = await templatesApi.getBySlug(slug);
    return response.data;
  } catch (error) {
    console.error("Error fetching template:", error);
    return null;
  }
}

export const generateMetadata = async ({ params }: { params: Promise<{ slug: string }> }): Promise<Metadata> => {
  const { slug } = await params;
  const template = await getTemplate(slug);

  if (!template) {
    return {
      title: "Store | NoFileExistsHere. (Nexteam)",
    };
  }

  return {
    title: `${template.name} | NoFileExistsHere. (Nexteam)`,
    description: template.description,
    openGraph: {
      title: `${template.name} | NoFileExistsHere. (Nexteam)`,
      description: template.description,
      url: `/store/${template.slug}`,
      type: "website",
      images: template.preview_image
        ? [
            {
              url: `${process.env.NEXT_PUBLIC_API_URL}/storage/${template.preview_image}`,
              width: 1200,
              height: 630,
              alt: template.name,
            },
          ]
        : [],
    },
  };
};

const StoreTemplateDetailPage = async ({ params }: { params: Promise<{ slug: string }> }) => {
  const { slug } = await params;
  const template = await getTemplate(slug);

  if (!template) {
    notFound();
  }

  return (
    <main className="min-h-[calc(100vh-4rem)] w-full">
      <section className="max-w-(--breakpoint-xl) mx-auto w-full py-10 xs:py-14 px-6 space-y-10">
        <RevealOnScroll>
          <div className="space-y-3 text-center mb-6 md:mb-8">
            <p className="text-xs font-medium uppercase tracking-wide text-muted-foreground">Website Template</p>
            <h1 className="text-3xl xs:text-4xl md:text-5xl font-bold tracking-tight">{template.name}</h1>
            <p className="text-xs xs:text-sm text-muted-foreground">
              <br />
              <Link href="/" className="hover:text-foreground">
                Home
              </Link>{" "}
              /{" "}
              <Link href="/store" className="hover:text-foreground">
                Store
              </Link>{" "}
              / <span className="text-foreground font-medium">{template.name}</span>
            </p>
          </div>
        </RevealOnScroll>

        <RevealOnScroll delay={0.03}>
          <div className="grid gap-8 lg:grid-cols-[minmax(0,2fr)_minmax(0,1fr)] items-start">
            <div className="space-y-8">
              <Card className="overflow-hidden border bg-card">
                <CardHeader className="border-b bg-background/60">
                  <p className="text-xs text-muted-foreground">Preview Image</p>
                </CardHeader>
                <CardContent className="relative h-64 sm:h-80 lg:h-96 bg-muted p-0">
                  {template.preview_image ? (
                    <>
                      <Image src={`${process.env.NEXT_PUBLIC_API_URL}/storage/${template.preview_image}`} alt={template.name} fill sizes="(min-width: 1024px) 640px, 100vw" className="object-cover" />
                      <div className="pointer-events-none absolute inset-x-4 top-4 flex items-center justify-between text-[11px]">
                        <span className="rounded-full bg-background/90 px-2 py-0.5 text-muted-foreground">Preview</span>
                        <span className="rounded-full bg-foreground px-2 py-0.5 text-background">{template.price === 0 ? "Free" : "Premium"}</span>
                      </div>
                    </>
                  ) : (
                    <div className="flex h-full w-full items-center justify-center text-sm text-muted-foreground">
                      <div className="text-center">
                        <div className="text-6xl mb-2">{template.name.charAt(0)}</div>
                        <div>Preview image</div>
                      </div>
                    </div>
                  )}
                </CardContent>
              </Card>

              <article className="space-y-6 text-sm md:text-base leading-relaxed text-muted-foreground">
                <p>{template.description}</p>

                {template.content && <div className="whitespace-pre-line">{template.content}</div>}

                {template.features && template.features.length > 0 && (
                  <section className="space-y-2">
                    <h2 className="text-base font-semibold text-foreground">Features</h2>
                    <ul className="list-disc pl-5 space-y-1">
                      {template.features.map((feature, index) => (
                        <li key={index}>{feature}</li>
                      ))}
                    </ul>
                  </section>
                )}
              </article>
            </div>

            <aside className="space-y-4 lg:sticky lg:top-6 lg:max-h-[calc(100vh-2rem)]">
              <Card className="border bg-card">
                <CardContent className="space-y-4 pt-6 text-sm">
                  <div className="flex items-center justify-between">
                    <span className="text-muted-foreground">Type</span>
                    <span className="font-medium">{template.category}</span>
                  </div>
                  <div className="flex items-center justify-between">
                    <span className="text-muted-foreground">License</span>
                    <span className="font-medium">{template.price === 0 ? "Free" : "Premium"}</span>
                  </div>
                  <div className="flex items-center justify-between">
                    <span className="text-muted-foreground">Price</span>
                    <span className="font-medium">{template.price === 0 ? "Free" : `Rp ${template.price.toLocaleString("id-ID")}`}</span>
                  </div>
                  <div className="flex items-center justify-between">
                    <span className="text-muted-foreground">Last Updated</span>
                    <span className="font-medium">{new Date(template.updated_at).toLocaleDateString("en-US", { year: "numeric", month: "2-digit", day: "2-digit" })}</span>
                  </div>
                  <div className="flex items-center justify-between">
                    <span className="text-muted-foreground">Version</span>
                    <span className="font-medium">{template.version}</span>
                  </div>

                  <div className="flex flex-wrap gap-2 pt-2">
                    {template.tags.map((tag) => (
                      <span key={tag} className="rounded-full bg-muted px-2 py-0.5 text-[11px] text-muted-foreground">
                        {tag}
                      </span>
                    ))}
                  </div>
                </CardContent>
              </Card>

              <div className="space-y-3">
                <Button asChild className="w-full rounded-full">
                  <Link href="/contact">Discuss This Template</Link>
                </Button>
                <Button asChild variant="outline" className="w-full rounded-full">
                  <Link href="/store">Back To Store</Link>
                </Button>
              </div>
            </aside>
          </div>
        </RevealOnScroll>
      </section>
    </main>
  );
};

export default StoreTemplateDetailPage;
