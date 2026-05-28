"use client";

import { Card, CardContent, CardHeader } from "@/components/ui/card";
import RevealOnScroll from "./animation/reveal-on-scroll";
import { AppWindow, Code, Cpu, Globe2, LifeBuoy, Monitor, Palette, Smartphone, Search } from "lucide-react";
import Image from "next/image";
import Link from "next/link";
import { useParallax } from "@/lib/use-parallax";
import { useEffect, useState } from "react";

interface ServiceData {
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
}

const iconMap: Record<string, React.ComponentType<{ className?: string }>> = {
  monitor: Monitor,
  palette: Palette,
  globe: Globe2,
  smartphone: Smartphone,
  cpu: Cpu,
  "life-buoy": LifeBuoy,
  code: Code,
  "app-window": AppWindow,
};

const getIcon = (iconName: string) => {
  return iconMap[iconName] || Monitor;
};

const Service = () => {
  const [services, setServices] = useState<ServiceData[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchServices = async () => {
      try {
        const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/api/services`);
        const data = await response.json();
        setServices(data);
      } catch (error) {
        console.error("Error fetching services:", error);
      } finally {
        setLoading(false);
      }
    };

    fetchServices();
  }, []);

  if (loading) {
    return (
      <div id="services" className="max-w-(--breakpoint-xl) mx-auto w-full py-12 xs:py-20 px-6">
        <div className="text-center text-muted-foreground">Loading services...</div>
      </div>
    );
  }
  return (
    <div id="services" className="max-w-(--breakpoint-xl) mx-auto w-full py-12 xs:py-20 px-6">
      <RevealOnScroll>
        <h2 className="text-3xl xs:text-4xl md:text-5xl md:leading-14 font-bold tracking-tight sm:max-w-xl sm:text-center sm:mx-auto">Services We Provide to Grow Your Business</h2>
      </RevealOnScroll>
      <RevealOnScroll delay={0.05}>
        <div className="mt-8 xs:mt-14 w-full mx-auto grid md:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-12">
          {services.map((service, index) => (
            <ServiceCardWithParallax key={service.id} service={service} index={index} />
          ))}
        </div>
      </RevealOnScroll>
    </div>
  );
};

const ServiceCardWithParallax = ({ service, index }: { service: ServiceData; index: number }) => {
  const { ref } = useParallax(0.2 + (index % 2) * 0.1);
  const IconComponent = getIcon(service.icon);

  // Use placeholder.svg if no image is provided from CMS
  const imageSrc = service.image ? `${process.env.NEXT_PUBLIC_API_URL}/storage/${service.image}` : "/placeholder.svg";

  return (
    <div ref={ref}>
      <RevealOnScroll delay={0.05 * index}>
        <Link href={`/services/${service.slug}`} aria-label={service.name} className="block group h-full">
          <Card className="flex h-full flex-col overflow-hidden rounded-xl border bg-card shadow-sm transition-transform duration-150 group-hover:-translate-y-0.5">
            <CardContent className="px-0 pt-0 pb-0">
              <div className="relative w-full aspect-video bg-muted overflow-hidden">
                <Image src={imageSrc} alt={service.name} fill sizes="(max-width: 768px) 100vw, (max-width: 1024px) 50vw, 33vw" className="object-cover transition-transform duration-300 group-hover:scale-[1.05]" />
                <div className="pointer-events-none absolute inset-0 bg-linear-to-t from-black/70 via-black/40 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100" />
                <div className="pointer-events-none absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                  <div className="flex h-11 w-11 items-center justify-center rounded-full bg-background/90 shadow-md">
                    <Search className="h-5 w-5" />
                  </div>
                </div>
              </div>
            </CardContent>
            <CardHeader className="flex-1 px-6 pb-6 pt-5">
              <div className="inline-flex h-10 w-10 items-center justify-center rounded-full bg-muted mb-3">
                <IconComponent className="h-5 w-5" />
              </div>
              <h4 className="text-lg font-semibold tracking-tight">{service.name}</h4>
              <p className="mt-1.5 text-muted-foreground text-sm xs:text-[15px] leading-relaxed">{service.short_description}</p>
            </CardHeader>
          </Card>
        </Link>
      </RevealOnScroll>
    </div>
  );
};

export default Service;
