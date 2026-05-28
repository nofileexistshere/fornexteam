"use client";

import Link from "next/link";
import { usePathname } from "next/navigation";
import { useEffect, useState } from "react";
import { NavigationMenuProps } from "@radix-ui/react-navigation-menu";
import { cn } from "@/lib/utils";
import { motion } from "framer-motion";

const items = [
  { key: "home", label: "Home", href: "/" },
  { key: "services", label: "Services", href: "/#services", sectionId: "services" },
  { key: "faq", label: "FAQ", href: "/#faq", sectionId: "faq" },
  { key: "clients", label: "Clients", href: "/#clients", sectionId: "clients" },
  { key: "testimonials", label: "Testimonials", href: "/#testimonials", sectionId: "testimonials" },
  { key: "team", label: "Our Team", href: "/#team", sectionId: "team" },
] as const;

export const NavMenu = ({ className, orientation, ...rest }: NavigationMenuProps) => {
  const pathname = usePathname();
  const [activeKey, setActiveKey] = useState<string>(() => "home");
  const isVertical = orientation === "vertical";

  const handleClick = (event: React.MouseEvent<HTMLAnchorElement>, item: (typeof items)[number]) => {
    if (pathname === "/") {
      if (item.key === "home") {
        event.preventDefault();
        window.scrollTo({ top: 0, behavior: "instant" });
      } else if (item.sectionId) {
        event.preventDefault();
        document.getElementById(item.sectionId)?.scrollIntoView({ behavior: "instant", block: "start" });
      }
    }
  };

  // Scroll spy for home page
  useEffect(() => {
    if (pathname !== "/") return;

    const handleScroll = () => {
      const scrollY = window.scrollY;
      const offset = 160; // adjust so it switches a bit after section top

      const sectionOrder: { key: string; id?: string }[] = [
        { key: "home" },
        { key: "services", id: "services" },
        { key: "faq", id: "faq" },
        { key: "clients", id: "clients" },
        { key: "testimonials", id: "testimonials" },
        { key: "team", id: "team" },
      ];

      let currentKey = "home";

      for (const section of sectionOrder) {
        if (!section.id) continue;
        const el = document.getElementById(section.id);
        if (!el) continue;
        const top = el.getBoundingClientRect().top + window.scrollY;
        if (scrollY + offset >= top) {
          currentKey = section.key;
        }
      }

      setActiveKey(currentKey);
    };

    handleScroll();
    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, [pathname]);

  // Reset active tab when leaving home page
  useEffect(() => {
    if (pathname !== "/") {
      setActiveKey("home");
    }
  }, [pathname]);

  return (
    <nav {...rest} className={cn("flex items-center justify-center px-3 sm:px-0", isVertical && "justify-start px-0", className)}>
      <div className={cn("flex rounded-full bg-muted/80 px-1 py-1 backdrop-blur-sm border border-border/60 max-w-full sm:max-w-fit overflow-x-auto no-scrollbar", isVertical ? "flex-col gap-1.5" : "flex-row gap-1.5 sm:gap-2")}>
        {items.map((item) => {
          const isActive = item.key === activeKey;

          return (
            <div key={item.key} className="relative">
              {isActive && <motion.div layoutId="nav-pill" className="absolute inset-0 rounded-full bg-foreground shadow-sm" transition={{ type: "spring", stiffness: 380, damping: 30 }} />}
              <Link
                href={item.href}
                onClick={(event) => handleClick(event, item)}
                className={cn(
                  "relative px-3 sm:px-4 py-1.5 text-xs sm:text-sm font-medium rounded-full whitespace-nowrap transition-colors",
                  "transition-transform duration-150 hover:scale-[1.03]",
                  isActive ? "text-background" : "text-foreground/80 hover:text-foreground"
                )}
              >
                {item.label}
              </Link>
            </div>
          );
        })}
      </div>
    </nav>
  );
};
