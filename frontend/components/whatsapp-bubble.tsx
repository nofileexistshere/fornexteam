"use client";

import { MessageCircle, X } from "lucide-react";
import Link from "next/link";
import { useState } from "react";

const WhatsAppBubble = () => {
  const [open, setOpen] = useState(false);

  const marketingPhone = "628889177045";
  const supportPhone = "62895330931423";

  const marketingText = encodeURIComponent("Halo, saya tertarik dengan layanan Nexteam (Marketing).");
  const supportText = encodeURIComponent("Halo, saya butuh bantuan teknis (Support) dari Nexteam.");

  return (
    <div className="fixed bottom-5 right-5 z-50 flex flex-col items-end gap-3">
      {open && (
        <div className="w-64 rounded-2xl border border-border bg-background/95 shadow-xl backdrop-blur-md px-4 py-3 text-sm">
          <div className="flex items-center justify-between gap-2 mb-2">
            <p className="font-semibold text-foreground text-xs xs:text-sm">Chat via WhatsApp</p>
            <button type="button" onClick={() => setOpen(false)} className="inline-flex h-6 w-6 items-center justify-center rounded-full border border-border/70 text-muted-foreground hover:bg-muted" aria-label="Close WhatsApp options">
              <X className="h-3 w-3" />
            </button>
          </div>

          <div className="space-y-2">
            <Link
              href={`https://wa.me/${marketingPhone}?text=${marketingText}`}
              target="_blank"
              className="relative flex items-center justify-between overflow-hidden rounded-lg border border-muted-foreground/40 bg-muted px-3 py-2 text-xs xs:text-sm text-foreground transition-colors before:pointer-events-none before:absolute before:inset-0 before:-z-10 before:origin-left before:scale-x-0 before:bg-foreground/10 before:content-[''] before:transition-transform before:duration-300 hover:before:scale-x-100"
            >
              <span>Marketing</span>
              <MessageCircle className="h-4 w-4" />
            </Link>

            <Link
              href={`https://wa.me/${supportPhone}?text=${supportText}`}
              target="_blank"
              className="relative flex items-center justify-between overflow-hidden rounded-lg border border-foreground/60 bg-foreground px-3 py-2 text-xs xs:text-sm text-background transition-colors before:pointer-events-none before:absolute before:inset-0 before:-z-10 before:origin-left before:scale-x-0 before:bg-background/20 before:content-[''] before:transition-transform before:duration-300 hover:before:scale-x-100"
            >
              <span>Support</span>
              <MessageCircle className="h-4 w-4" />
            </Link>
          </div>
        </div>
      )}

      <button
        type="button"
        onClick={() => setOpen((prev) => !prev)}
        aria-label="Open WhatsApp chat options"
        className="flex h-12 w-12 items-center justify-center rounded-full border border-black/40 bg-background/80 text-black shadow-lg backdrop-blur-sm transition-transform duration-200 hover:-translate-y-0.5 dark:border-white/60 dark:text-white"
      >
        <MessageCircle className="h-5 w-5" />
      </button>
    </div>
  );
};

export default WhatsAppBubble;
