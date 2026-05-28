"use client";

import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import RevealOnScroll from "./animation/reveal-on-scroll";
import { ArrowUpRight, CirclePlay } from "lucide-react";
import Image from "next/image";
import Link from "next/link";
import { motion } from "framer-motion";
import { useEffect, useState } from "react";

interface HeroData {
  id: number;
  badge_text: string;
  heading: string;
  description: string;
  image_light: string | null;
  image_light_url: string | null;
  primary_button_text: string;
  primary_button_url: string;
  secondary_button_text: string;
  secondary_button_url: string | null;
  show_secondary_button: boolean;
  is_active: boolean;
}

const Hero = () => {
  const [heroData, setHeroData] = useState<HeroData | null>(null);

  useEffect(() => {
    const fetchHeroData = async () => {
      try {
        const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/api/hero`);
        const data = await response.json();

        if (data.success) {
          setHeroData(data.data);
        }
      } catch (error) {
        console.error("Error fetching hero data:", error);
      }
    };

    fetchHeroData();
  }, []);

  // Default values while loading
  const badge = heroData?.badge_text || "#nexteam";
  const heading = heroData?.heading || "Innovate. Excellent!. Succeed!.";
  const description = heroData?.description || "Penyedia layanan teknologi di bidang Computers, Internet, dan Website yang mudah diakses.";

  // Use placeholder.svg if no image is provided
  const imageSrc = heroData?.image_light && heroData.image_light_url ? heroData.image_light_url : "/placeholder.svg";

  const primaryButtonText = heroData?.primary_button_text || "View Projects";
  const primaryButtonUrl = heroData?.primary_button_url || "/project";
  const secondaryButtonText = heroData?.secondary_button_text || "Watch Video";
  const secondaryButtonUrl = heroData?.secondary_button_url;
  const showSecondaryButton = heroData?.show_secondary_button !== false;

  return (
    <div className="min-h-[calc(100vh-4rem)] w-full flex items-center justify-center overflow-hidden border-b border-accent">
      <div className="max-w-(--breakpoint-xl) w-full flex flex-col lg:flex-row mx-auto items-center justify-between gap-y-14 gap-x-10 px-6 py-12 lg:py-0 -mt-6 md:-mt-30">
        <RevealOnScroll>
          <div className="max-w-xl">
            <Badge className="rounded-full py-1 border-none">{badge}</Badge>
            <h1 className="mt-6 max-w-[20ch] text-3xl xs:text-4xl sm:text-5xl lg:text-[2.75rem] xl:text-5xl font-bold leading-[1.2]! tracking-tight">{heading}</h1>
            <p className="mt-6 max-w-[60ch] xs:text-lg">{description}</p>
            <div className="mt-12 flex flex-col sm:flex-row items-center gap-4">
              <Button asChild size="lg" className="w-full sm:w-auto rounded-full text-base">
                <Link href={primaryButtonUrl} className="flex items-center gap-2">
                  {primaryButtonText} <ArrowUpRight className="h-5! w-5!" />
                </Link>
              </Button>
              {showSecondaryButton && (
                <Button variant="outline" size="lg" className="w-full sm:w-auto rounded-full text-base shadow-none" asChild={!!secondaryButtonUrl}>
                  {secondaryButtonUrl ? (
                    <Link href={secondaryButtonUrl} target="_blank" rel="noopener noreferrer">
                      <CirclePlay className="h-5! w-5!" /> {secondaryButtonText}
                    </Link>
                  ) : (
                    <>
                      <CirclePlay className="h-5! w-5!" /> {secondaryButtonText}
                    </>
                  )}
                </Button>
              )}
            </div>
          </div>
        </RevealOnScroll>
        <RevealOnScroll delay={0.1}>
          <motion.div className="relative lg:max-w-lg xl:max-w-xl w-full rounded-xl aspect-square h-72 md:h-150" animate={{ y: [0, -14, 0] }} transition={{ duration: 4.5, repeat: Infinity, ease: "easeInOut" }}>
            <Image src={imageSrc} fill alt={heading} sizes="(min-width: 1024px) 32rem, (min-width: 768px) 28rem, 20rem" priority className="object-cover rounded-xl" />
          </motion.div>
        </RevealOnScroll>
      </div>
    </div>
  );
};

export default Hero;
