"use client";

import RevealOnScroll from "./animation/reveal-on-scroll";
import { Avatar, AvatarFallback } from "@/components/ui/avatar";
import { StarIcon } from "lucide-react";
import { useParallax } from "@/lib/use-parallax";
import { useEffect, useState } from "react";

interface TestimonialData {
  id: number;
  name: string;
  position: string | null;
  company: string | null;
  content: string;
  rating: number;
  is_featured: boolean;
  order: number;
}

const TestimonialCard = ({ testimonial, index }: { testimonial: TestimonialData; index: number }) => {
  const { ref } = useParallax(0.1 + (index % 3) * 0.05);

  const designation = [testimonial.position, testimonial.company].filter(Boolean).join(" - ");

  return (
    <div ref={ref} className="bg-accent rounded-xl py-6 px-4 sm:py-6 sm:px-6 h-full">
      <div className="flex flex-col gap-4 sm:gap-6 h-full">
        <div className="flex items-start justify-between gap-2 sm:gap-4">
          <div className="flex items-center gap-3 sm:gap-4 min-w-0 flex-1">
            <Avatar className="w-10 h-10 shrink-0">
              <AvatarFallback className="text-xl font-medium bg-primary text-primary-foreground">{testimonial.name.charAt(0)}</AvatarFallback>
            </Avatar>
            <div className="min-w-0 flex-1">
              <p className="text-base sm:text-lg font-semibold truncate">{testimonial.name}</p>
              <p className="text-xs sm:text-sm text-gray-500 line-clamp-2">{designation}</p>
            </div>
          </div>
          <div className="flex items-center gap-0.5 sm:gap-1 shrink-0">
            {Array.from({ length: testimonial.rating }).map((_, i) => (
              <StarIcon key={i} className="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 fill-yellow-400 stroke-yellow-500" />
            ))}
          </div>
        </div>

        <p className="text-base sm:text-lg lg:text-xl leading-relaxed font-semibold tracking-tight grow">&quot;{testimonial.content}&quot;</p>
      </div>
    </div>
  );
};

const Testimonial = () => {
  const [testimonials, setTestimonials] = useState<TestimonialData[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchTestimonials = async () => {
      try {
        const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/api/testimonials`);
        const data = await response.json();
        setTestimonials(data);
      } catch (error) {
        console.error("Error fetching testimonials:", error);
      } finally {
        setLoading(false);
      }
    };

    fetchTestimonials();
  }, []);

  if (loading) {
    return (
      <div id="testimonials" className="w-full max-w-7xl mx-auto py-6 xs:py-12 px-4 sm:px-6">
        <div className="text-center text-muted-foreground">Loading testimonials...</div>
      </div>
    );
  }

  return (
    <div id="testimonials" className="w-full max-w-7xl mx-auto py-6 xs:py-12 px-4 sm:px-6">
      <RevealOnScroll>
        <h2 className="mb-8 xs:mb-14 text-4xl md:text-5xl font-bold text-center tracking-tight">Testimonials</h2>
      </RevealOnScroll>
      <RevealOnScroll delay={0.05}>
        <div className="grid gap-4 sm:gap-6 md:gap-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
          {testimonials.map((testimonial, index) => (
            <RevealOnScroll key={testimonial.id} delay={0.04 * index}>
              <TestimonialCard testimonial={testimonial} index={index} />
            </RevealOnScroll>
          ))}
        </div>
      </RevealOnScroll>
    </div>
  );
};

export default Testimonial;
