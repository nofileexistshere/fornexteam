"use client";

import Link from "next/link";
import { usePathname } from "next/navigation";

export const Logo = () => {
  const pathname = usePathname();

  const handleClick = (event: React.MouseEvent<HTMLAnchorElement>) => {
    if (pathname === "/") {
      event.preventDefault();
      window.scrollTo({ top: 0, behavior: "smooth" });
    }
  };

  return (
    <Link href="/" onClick={handleClick} className="text-lg font-semibold tracking-tight text-foreground">
      NoFileExistsHere.
    </Link>
  );
};
