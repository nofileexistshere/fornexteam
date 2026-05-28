"use client";

import RevealOnScroll from "./animation/reveal-on-scroll";
import { type CarouselApi, Carousel, CarouselContent, CarouselItem } from "@/components/ui/carousel";
import Image from "next/image";
import Link from "next/link";
import { useEffect, useState } from "react";

interface ClientData {
  id: number;
  name: string;
  website: string;
  logo: string | null;
  logo_url: string | null;
  description: string | null;
  order: number;
}

const OurClients = () => {
  const [api, setApi] = useState<CarouselApi>();
  const [clients, setClients] = useState<ClientData[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchClients = async () => {
      try {
        const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/api/clients`);
        const data = await response.json();
        setClients(data);
      } catch (error) {
        console.error("Error fetching clients:", error);
      } finally {
        setLoading(false);
      }
    };

    fetchClients();
  }, []);

  useEffect(() => {
    if (!api) return;

    const interval = setInterval(() => {
      api.scrollNext();
    }, 2500);

    return () => clearInterval(interval);
  }, [api]);

  if (loading) {
    return (
      <section id="clients" className="max-w-(--breakpoint-xl) mx-auto w-full py-12 xs:py-20 px-6">
        <div className="text-center text-muted-foreground">Loading clients...</div>
      </section>
    );
  }

  return (
    <section id="clients" className="max-w-(--breakpoint-xl) mx-auto w-full py-12 xs:py-20 px-6">
      <RevealOnScroll>
        <h2 className="text-3xl xs:text-4xl md:text-5xl font-bold tracking-tight text-center">Our Clients</h2>
        <p className="mt-2 text-center text-muted-foreground max-w-xl mx-auto">Brand dan tim yang mempercayakan kami untuk menghadirkan produk digital yang cepat dan andal.</p>
      </RevealOnScroll>

      <RevealOnScroll delay={0.05}>
        <div className="mt-8 xs:mt-12">
          <Carousel opts={{ loop: true }} setApi={setApi}>
            <CarouselContent className="-ml-4 items-center">
              {clients.map((client) => {
                const imageSrc = client.logo_url || "/placeholder.svg";
                const websiteUrl = client.website || "#";

                return (
                  <CarouselItem key={client.id} className="basis-1/3 sm:basis-1/4 md:basis-1/6 pl-4 flex items-center justify-center">
                    <Link href={websiteUrl} target="_blank" aria-label={client.name} className="block group">
                      <div className="relative w-24 h-8 sm:w-28 sm:h-10 md:w-32 md:h-12">
                        <Image src={imageSrc} alt={client.name} fill sizes="(min-width: 1024px) 8rem, (min-width: 640px) 7rem, 6rem" className="object-contain transition duration-200 grayscale group-hover:grayscale-0" />
                      </div>
                    </Link>
                  </CarouselItem>
                );
              })}
            </CarouselContent>
          </Carousel>
        </div>
      </RevealOnScroll>
    </section>
  );
};

export default OurClients;
