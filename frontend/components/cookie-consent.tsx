"use client";

import { useEffect, useState } from "react";
import { Button } from "@/components/ui/button";

const STORAGE_KEY = "nexteam_cookie_consent";

export const CookieConsent = () => {
  const [visible, setVisible] = useState(false);

  useEffect(() => {
    if (typeof window === "undefined") return;
    const stored = window.localStorage.getItem(STORAGE_KEY);
    if (!stored) {
      // Belum pernah accept
      setVisible(true);
    }
  }, []);

  const handleAccept = () => {
    if (typeof window !== "undefined") {
      window.localStorage.setItem(STORAGE_KEY, "accepted");
    }
    setVisible(false);
  };

  if (!visible) return null;

  return (
    <div className="fixed inset-x-0 bottom-4 z-40 flex justify-center px-4 sm:px-0">
      <div className="max-w-(--breakpoint-xl) w-full sm:w-auto sm:max-w-lg rounded-2xl border border-border bg-background/95 shadow-lg backdrop-blur-sm px-4 py-3 sm:px-5 sm:py-4 text-xs sm:text-sm flex flex-col sm:flex-row items-start sm:items-center gap-3">
        <p className="text-muted-foreground leading-relaxed">Kami menggunakan cookie untuk meningkatkan pengalaman Anda di website ini. Dengan melanjutkan, Anda menyetujui penggunaan cookie sesuai kebijakan kami.</p>
        <div className="flex items-center gap-2 self-stretch sm:self-auto sm:ml-2">
          <Button size="sm" className="w-full sm:w-auto rounded-full px-4" onClick={handleAccept}>
            Accept
          </Button>
        </div>
      </div>
    </div>
  );
};

export default CookieConsent;
