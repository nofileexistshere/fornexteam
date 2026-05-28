"use client";

import RevealOnScroll from "./animation/reveal-on-scroll";
import { Instagram, Linkedin, Music2, Facebook, Twitter, Youtube, Github } from "lucide-react";
import Link from "next/link";
import Image from "next/image";
import { Logo } from "./navbar/logo";
import { useEffect, useState } from "react";

interface FooterLink {
  id: number;
  title: string;
  url: string;
  is_external: boolean;
  open_new_tab: boolean;
  order: number;
  is_active: boolean;
}

interface FooterSection {
  id: number;
  title: string;
  order: number;
  is_active: boolean;
  links: FooterLink[];
}

interface SocialLink {
  id: number;
  name: string;
  url: string;
  icon: string;
  order: number;
  is_active: boolean;
}

interface FooterData {
  sections: FooterSection[];
  social_links: SocialLink[];
}

const getSocialIcon = (iconName: string) => {
  const icons: Record<string, React.ComponentType<{ className?: string }>> = {
    instagram: Instagram,
    linkedin: Linkedin,
    tiktok: Music2,
    facebook: Facebook,
    twitter: Twitter,
    youtube: Youtube,
    github: Github,
  };

  return icons[iconName.toLowerCase()] || Instagram;
};

const Footer = () => {
  const [footerData, setFooterData] = useState<FooterData | null>(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchFooterData = async () => {
      try {
        const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/api/footer`, {
          cache: "no-store",
          headers: {
            "Cache-Control": "no-cache",
          },
        });
        const data = await response.json();

        console.log("Footer API Response:", data);

        if (data.success) {
          setFooterData(data.data);
          console.log("Footer sections:", data.data.sections);
          console.log("First link title:", data.data.sections[0]?.links[0]?.title);
        }
      } catch (error) {
        console.error("Error fetching footer data:", error);
      } finally {
        setLoading(false);
      }
    };

    fetchFooterData();
  }, []);

  if (loading) {
    return (
      <footer className="mt-12 xs:mt-20 relative border-t bg-linear-to-b from-background to-background/80">
        <div className="relative max-w-(--breakpoint-xl) mx-auto py-12 px-6">
          <div className="text-center text-muted-foreground">Loading...</div>
        </div>
      </footer>
    );
  }

  return (
    <footer className="mt-12 xs:mt-20 relative border-t bg-linear-to-b from-background to-background/80">
      <div className="relative max-w-(--breakpoint-xl) mx-auto py-12 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-7 gap-x-8 gap-y-10 px-6">
        <RevealOnScroll>
          <div className="col-span-full xl:col-span-2">
            {/* Logo */}
            <div className="flex flex-col items-start gap-3">
              <div className="relative h-25 w-25">
                <Image src="/logo/logo.webp" alt="NoFileExistsHere logo" fill sizes="(min-width: 1024px) 13rem, (min-width: 640px) 11rem, 10rem" className="object-contain object-left" />
              </div>
              <Logo />
            </div>

            <p className="mt-4 text-muted-foreground">Membantu bisnis menghadirkan pengalaman digital yang simpel, cepat, dan bermakna.</p>
          </div>
        </RevealOnScroll>

        {footerData?.sections.map((section, index) => {
          console.log(`Section ${section.title}:`, section.links?.length || 0, "links");
          return (
            <RevealOnScroll key={section.id} delay={0.04 * index}>
              <div className="xl:justify-self-end pl-4 sm:pl-8 md:pl-12">
                <h6 className="font-semibold text-foreground">{section.title}</h6>
                <ul className="mt-6 space-y-4">
                  {section.links?.map((link) => (
                    <li key={link.id}>
                      <Link href={link.url} className="text-muted-foreground hover:text-foreground transition-colors" target={link.open_new_tab ? "_blank" : undefined} rel={link.is_external ? "noopener noreferrer" : undefined}>
                        {link.title}
                      </Link>
                    </li>
                  ))}
                </ul>
              </div>
            </RevealOnScroll>
          );
        })}
      </div>

      <div className="relative max-w-(--breakpoint-xl) mx-auto py-8 flex flex-col-reverse sm:flex-row items-center justify-between gap-x-2 gap-y-5 px-6">
        {/* Copyright */}
        <span className="text-muted-foreground text-center xs:text-start">
          &copy; {new Date().getFullYear()}{" "}
          <Link href="/" className="hover:text-foreground transition-colors">
            NoFileExistsHere
          </Link>
          . All rights reserved.
        </span>

        <div className="flex items-center gap-5 text-muted-foreground">
          {footerData?.social_links.map((social) => {
            const IconComponent = getSocialIcon(social.icon);
            return (
              <Link key={social.id} href={social.url} target="_blank" rel="noopener noreferrer" aria-label={social.name} className="hover:text-foreground transition-colors">
                <IconComponent className="h-5 w-5" />
              </Link>
            );
          })}
        </div>
      </div>

      {/* Huge decorative text at the very bottom */}
      <div className="pointer-events-none select-none absolute inset-x-0 -bottom-10 sm:-bottom-44 md:-bottom-80 flex justify-center">
        <span className="font-mono font-bold tracking-[0.001em] text-[16vw] sm:text-[12vw] md:text-[10vw] leading-none text-foreground/5">Nexteam</span>
      </div>
    </footer>
  );
};

export default Footer;
