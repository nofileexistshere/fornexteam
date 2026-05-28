"use client";

import { useState, useEffect } from "react";
import Link from "next/link";
import RevealOnScroll from "@/components/animation/reveal-on-scroll";
import { Button } from "@/components/ui/button";

interface CtaData {
  title: string;
  description: string;
  button_text: string;
  button_link: string;
}

const CtaAfterTeam = () => {
  const [cta, setCta] = useState<CtaData | null>(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchCta = async () => {
      try {
        const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/api/cta`);
        const data = await response.json();
        setCta(data);
      } catch (error) {
        console.error("Failed to fetch CTA:", error);
      } finally {
        setLoading(false);
      }
    };

    fetchCta();
  }, []);

  if (loading || !cta) {
    return null;
  }

  return (
    <section className="max-w-(--breakpoint-xl) mx-auto w-full py-12 xs:py-20 px-6 border-t border-accent/60">
      <RevealOnScroll>
        <div className="text-center max-w-2xl mx-auto">
          <h2 className="text-2xl xs:text-3xl md:text-4xl font-bold tracking-tight">{cta.title}</h2>
          <p className="mt-3 text-sm xs:text-base text-muted-foreground">{cta.description}</p>
          <div className="mt-6 flex justify-center">
            <Button asChild size="lg" className="rounded-full px-8">
              <Link href={cta.button_link}>{cta.button_text}</Link>
            </Button>
          </div>
        </div>
      </RevealOnScroll>
    </section>
  );
};

export default CtaAfterTeam;
