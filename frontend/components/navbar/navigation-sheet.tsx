"use client";

import { Button } from "@/components/ui/button";
import { Sheet, SheetClose, SheetContent, SheetDescription, SheetTitle, SheetTrigger } from "@/components/ui/sheet";
import { VisuallyHidden as VisuallyHiddenPrimitive } from "radix-ui";
import { Menu } from "lucide-react";
import Link from "next/link";
import { usePathname } from "next/navigation";
import { Logo } from "./logo";

const sectionLinks = [
  { href: "/#services", label: "Services", sectionId: "services" },
  { href: "/#faq", label: "FAQ", sectionId: "faq" },
  { href: "/#clients", label: "Clients", sectionId: "clients" },
  { href: "/#testimonials", label: "Testimonials", sectionId: "testimonials" },
  { href: "/#team", label: "Our Team", sectionId: "team" },
];

export const NavigationSheet = () => {
  const pathname = usePathname();

  const handleSectionClick = (event: React.MouseEvent<HTMLAnchorElement>, sectionId: string) => {
    if (pathname === "/") {
      event.preventDefault();
      document.getElementById(sectionId)?.scrollIntoView({ behavior: "instant", block: "start" });
    }
  };

  return (
    <Sheet>
      <VisuallyHiddenPrimitive.Root>
        <SheetTitle>Navigation Drawer</SheetTitle>
        <SheetDescription>Daftar tautan navigasi utama Nexteam.</SheetDescription>
      </VisuallyHiddenPrimitive.Root>
      <SheetTrigger asChild>
        <Button variant="outline" size="icon">
          <Menu />
        </Button>
      </SheetTrigger>
      <SheetContent
        // Prevent auto-focus from scrolling back to the burger button when closing
        onCloseAutoFocus={(event) => {
          event.preventDefault();
        }}
      >
        <Logo />

        {/* Simple vertical list navigation for mobile */}
        <nav className="mt-10 space-y-3 text-sm">
          <SheetClose asChild>
            <Link href="/" className="block rounded-lg px-3 py-2 hover:bg-muted">
              Home
            </Link>
          </SheetClose>
          {sectionLinks.map((item) => (
            <SheetClose asChild key={item.sectionId}>
              <Link
                href={item.href}
                onClick={(e) => handleSectionClick(e, item.sectionId)}
                className="block rounded-lg px-3 py-2 hover:bg-muted"
              >
                {item.label}
              </Link>
            </SheetClose>
          ))}
        </nav>

        <div className="mt-8 space-y-4">
          <Button asChild className="w-full md:hidden rounded-full">
            <Link href="/contact">Contact</Link>
          </Button>
        </div>
      </SheetContent>
    </Sheet>
  );
};
