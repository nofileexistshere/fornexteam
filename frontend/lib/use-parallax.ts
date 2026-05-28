"use client";

import { useEffect, useRef } from "react";

export const useParallax = (speed: number = 0.5) => {
  const ref = useRef<HTMLDivElement>(null);

  useEffect(() => {
    if (!ref.current) return;

    const element = ref.current;

    const handleScroll = () => {
      const elementTop = element.getBoundingClientRect().top;
      const elementHeight = element.offsetHeight;
      const windowHeight = window.innerHeight;

      // Only apply parallax when element is in viewport
      if (elementTop < windowHeight && elementTop + elementHeight > 0) {
        const percentScroll = (windowHeight - elementTop) / (windowHeight + elementHeight);
        const offset = percentScroll * 100 * speed;
        element.style.transform = `translateY(${offset * 0.3}px)`;
      }
    };

    window.addEventListener("scroll", handleScroll, { passive: true });
    handleScroll(); // Call once on mount
    return () => window.removeEventListener("scroll", handleScroll);
  }, [speed]);

  return { ref };
};
