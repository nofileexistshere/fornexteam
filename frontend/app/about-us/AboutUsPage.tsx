"use client";

import RevealOnScroll from "@/components/animation/reveal-on-scroll";
import { Button } from "@/components/ui/button";
import Link from "next/link";
import Image from "next/image";

interface PageData {
  id: number;
  title: string;
  slug: string;
  content: string;
  meta_description: string;
  image?: string;
  is_published: boolean;
  order: number;
}

interface AboutUsPageProps {
  pageData: PageData | null;
}

const AboutUsPage = ({ pageData }: AboutUsPageProps) => {
  if (!pageData) {
    return (
      <main className="min-h-[calc(100vh-4rem)] w-full border-b border-accent">
        <section className="max-w-(--breakpoint-xl) mx-auto w-full py-12 xs:py-20 px-6">
          <div className="text-center text-muted-foreground">Page not found</div>
        </section>
      </main>
    );
  }

  const imageSrc = pageData.image ? `${process.env.NEXT_PUBLIC_API_URL}/storage/${pageData.image}` : "/placeholder.svg";

  return (
    <main className="min-h-[calc(100vh-4rem)] w-full border-b border-accent">
      <section className="max-w-(--breakpoint-xl) mx-auto w-full py-12 xs:py-20 px-6 space-y-10">
        <RevealOnScroll>
          <h1 className="text-3xl xs:text-4xl md:text-5xl font-bold tracking-tight">{pageData.title}</h1>
          {pageData.meta_description && <p className="mt-2 max-w-2xl text-muted-foreground">{pageData.meta_description}</p>}
        </RevealOnScroll>

        <RevealOnScroll delay={0.05}>
          <div className="grid grid-cols-1 md:grid-cols-[minmax(0,1.3fr)_minmax(0,1fr)] gap-10 items-start">
            <div className="prose max-w-none">
              <div dangerouslySetInnerHTML={{ __html: pageData.content }} />
            </div>

            <div className="relative w-full max-w-lg mx-auto md:max-w-xl md:w-full h-80 sm:h-96 md:h-112.5 sticky top-20">
              <Image src={imageSrc} alt={pageData.title} fill className="object-contain" priority />
            </div>
          </div>
        </RevealOnScroll>

        <div className="mt-8 flex justify-center">
          <Button variant="outline" asChild className="rounded-full px-6">
            <Link href="/">Back to Home</Link>
          </Button>
        </div>
      </section>
    </main>
  );
};

export default AboutUsPage;
