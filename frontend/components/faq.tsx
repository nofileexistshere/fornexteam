"use client";

import { Accordion, AccordionContent, AccordionItem } from "@/components/ui/accordion";
import RevealOnScroll from "./animation/reveal-on-scroll";
import { cn } from "@/lib/utils";
import * as AccordionPrimitive from "@radix-ui/react-accordion";
import { PlusIcon } from "lucide-react";
import { useParallax } from "@/lib/use-parallax";
import { useEffect, useState } from "react";

interface FaqData {
  id: number;
  question: string;
  answer: string;
  category: string | null;
  is_active: boolean;
  order: number;
}

const FAQItem = ({ question, answer, index }: { question: string; answer: string; index: number }) => {
  const { ref } = useParallax(0.08 + (index % 2) * 0.05);

  return (
    <div ref={ref}>
      <RevealOnScroll delay={0.04 * index}>
        <AccordionItem value={`question-${index}`} className="bg-accent py-1 px-4 rounded-xl border-none mt-0! mb-4! break-inside-avoid">
          <AccordionPrimitive.Header className="flex">
            <AccordionPrimitive.Trigger className={cn("flex flex-1 items-center justify-between py-4 font-semibold tracking-tight transition-all hover:underline [&[data-state=open]>svg]:rotate-45", "text-start text-lg")}>
              {question}
              <PlusIcon className="h-5 w-5 shrink-0 text-muted-foreground transition-transform duration-200" />
            </AccordionPrimitive.Trigger>
          </AccordionPrimitive.Header>
          <AccordionContent className="text-[15px]">{answer}</AccordionContent>
        </AccordionItem>
      </RevealOnScroll>
    </div>
  );
};

const FAQ = () => {
  const [faqs, setFaqs] = useState<FaqData[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchFaqs = async () => {
      try {
        const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/api/faqs`);
        const data = await response.json();
        setFaqs(data);
      } catch (error) {
        console.error("Error fetching FAQs:", error);
      } finally {
        setLoading(false);
      }
    };

    fetchFaqs();
  }, []);

  if (loading) {
    return (
      <div id="faq" className="w-full max-w-(--breakpoint-xl) mx-auto py-8 xs:py-16 px-6">
        <div className="text-center text-muted-foreground">Loading FAQs...</div>
      </div>
    );
  }

  return (
    <div id="faq" className="w-full max-w-(--breakpoint-xl) mx-auto py-8 xs:py-16 px-6">
      <RevealOnScroll>
        <h2 className="md:text-center text-3xl xs:text-4xl md:text-5xl leading-[1.15]! font-bold tracking-tighter">Frequently Asked Questions</h2>
        <p className="mt-1.5 md:text-center xs:text-lg text-muted-foreground">Jawaban singkat untuk pertanyaan yang paling sering ditanyakan seputar layanan kami.</p>
      </RevealOnScroll>

      <div className="min-h-137.5 md:min-h-80 xl:min-h-75">
        <RevealOnScroll delay={0.05}>
          <Accordion type="single" collapsible className="mt-8 space-y-4 md:columns-2 gap-4">
            {faqs.map(({ question, answer }, index) => (
              <FAQItem key={index} question={question} answer={answer} index={index} />
            ))}
          </Accordion>
        </RevealOnScroll>
      </div>
    </div>
  );
};

export default FAQ;
