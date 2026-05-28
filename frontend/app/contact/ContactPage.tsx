"use client";

import { useState, useEffect } from "react";
import RevealOnScroll from "@/components/animation/reveal-on-scroll";
import { Button } from "@/components/ui/button";
import Link from "next/link";
import { Instagram, Linkedin, Music2 } from "lucide-react";
import { contactApi } from "@/lib/api";

interface FormState {
  name: string;
  email: string;
  phone: string;
  needs: string;
}

interface ContactInfoData {
  title: string;
  description: string;
  chat_admin_name: string | null;
  chat_hours: string | null;
  address_title: string | null;
  address_line1: string | null;
  address_line2: string | null;
  map_embed_url: string | null;
  tiktok_url: string | null;
  instagram_url: string | null;
  linkedin_url: string | null;
}

const initialState: FormState = {
  name: "",
  email: "",
  phone: "",
  needs: "",
};

const ContactPage = () => {
  const [form, setForm] = useState<FormState>(initialState);
  const [isSending, setIsSending] = useState(false);
  const [status, setStatus] = useState<"idle" | "success" | "error">("idle");
  const [contactInfo, setContactInfo] = useState<ContactInfoData | null>(null);

  useEffect(() => {
    const fetchContactInfo = async () => {
      try {
        const response = await contactApi.getInfo();
        setContactInfo(response.data);
      } catch (error) {
        console.error("Failed to fetch contact info:", error);
      }
    };

    fetchContactInfo();
  }, []);

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    const { name, value } = e.target;
    setForm((prev) => ({ ...prev, [name]: value }));
  };

  const handleSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    setIsSending(true);
    setStatus("idle");

    try {
      await contactApi.submit(form);
      setStatus("success");
      setForm(initialState);
    } catch (err) {
      console.error(err);
      setStatus("error");
    } finally {
      setIsSending(false);
    }
  };

  return (
    <main className="min-h-[calc(100vh-4rem)] w-full border-b border-accent">
      <section className="max-w-(--breakpoint-xl) mx-auto w-full py-12 xs:py-20 px-6">
        <RevealOnScroll>
          <h1 className="text-3xl xs:text-4xl md:text-5xl font-bold tracking-tight text-center">{contactInfo?.title || "let's get connected"}</h1>
          <p className="mt-3 text-center text-muted-foreground max-w-xl mx-auto">{contactInfo?.description || "Memberdayakan bisnis Anda melalui teknologi. Hubungi kami sekarang!"}</p>
        </RevealOnScroll>

        <RevealOnScroll delay={0.05}>
          <div className="mt-10 max-w-4xl mx-auto rounded-3xl border bg-background/80 shadow-sm">
            <div className="grid grid-cols-1 lg:grid-cols-[minmax(0,1.4fr)_minmax(0,1fr)] gap-10 p-6 sm:p-10">
              {/* Left: form */}
              <form onSubmit={handleSubmit} className="space-y-6 max-w-xl">
                <div>
                  <h3 className="text-lg font-semibold tracking-tight">Leave Us A Message</h3>
                </div>

                <div className="space-y-1.5">
                  <label htmlFor="name" className="text-xs font-medium uppercase text-muted-foreground">
                    Nama Lengkap
                  </label>
                  <input
                    id="name"
                    name="name"
                    type="text"
                    required
                    value={form.name}
                    onChange={handleChange}
                    className="w-full rounded-md border border-border bg-background px-3 py-2 text-sm outline-none focus-visible:ring-2 focus-visible:ring-primary"
                  />
                </div>

                <div className="space-y-1.5">
                  <label htmlFor="email" className="text-xs font-medium uppercase text-muted-foreground">
                    Alamat Email
                  </label>
                  <input
                    id="email"
                    name="email"
                    type="email"
                    required
                    value={form.email}
                    onChange={handleChange}
                    className="w-full rounded-md border border-border bg-background px-3 py-2 text-sm outline-none focus-visible:ring-2 focus-visible:ring-primary"
                  />
                </div>

                <div className="space-y-1.5">
                  <label htmlFor="phone" className="text-xs font-medium uppercase text-muted-foreground">
                    No HP
                  </label>
                  <input
                    id="phone"
                    name="phone"
                    type="tel"
                    required
                    value={form.phone}
                    onChange={handleChange}
                    className="w-full rounded-md border border-border bg-background px-3 py-2 text-sm outline-none focus-visible:ring-2 focus-visible:ring-primary"
                  />
                </div>

                <div className="space-y-1.5">
                  <label htmlFor="needs" className="text-xs font-medium uppercase text-muted-foreground">
                    Tulis Pesan
                  </label>
                  <textarea
                    id="needs"
                    name="needs"
                    required
                    rows={4}
                    value={form.needs}
                    onChange={handleChange}
                    className="w-full rounded-md border border-border bg-background px-3 py-2 text-sm outline-none focus-visible:ring-2 focus-visible:ring-primary resize-none"
                  />
                </div>

                <div className="space-y-3 pt-2">
                  <Button type="submit" disabled={isSending} className="w-full rounded-full text-base flex items-center justify-center gap-2">
                    {isSending && <span className="inline-block h-4 w-4 rounded-full border-2 border-current border-t-transparent animate-spin" />}
                    {isSending ? "Sending..." : "Send Message"}
                  </Button>

                  {status === "success" && <p className="text-sm text-emerald-500 text-center">Terima kasih! Pesanmu sudah terkirim.</p>}
                  {status === "error" && <p className="text-sm text-red-500 text-center">Terjadi kesalahan saat mengirim pesan. Coba lagi nanti.</p>}
                </div>
              </form>

              {/* Right: info */}
              <div className="space-y-8 text-sm text-muted-foreground">
                <div>
                  <h3 className="text-base font-semibold text-foreground">Masih banyak ingin ditanya?</h3>
                  {contactInfo?.chat_admin_name && <p className="mt-2">{contactInfo.chat_admin_name}</p>}
                  {contactInfo?.chat_hours && <div className="whitespace-pre-line">{contactInfo.chat_hours}</div>}
                </div>

                {contactInfo?.address_title && (
                  <div>
                    <h3 className="text-base font-semibold text-foreground">{contactInfo.address_title}</h3>
                    <p className="mt-2 max-w-xs">
                      {contactInfo.address_line1 && (
                        <>
                          {contactInfo.address_line1}
                          <br />
                        </>
                      )}
                      {contactInfo.address_line2 && <>{contactInfo.address_line2}</>}
                    </p>
                  </div>
                )}

                <div>
                  <h3 className="text-base font-semibold text-foreground">Media Sosial</h3>
                  <div className="mt-3 flex items-center gap-3">
                    {contactInfo?.tiktok_url && (
                      <Link href={contactInfo.tiktok_url} target="_blank" aria-label="TikTok" className="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-border text-foreground hover:bg-accent/60 transition-colors">
                        <Music2 className="h-4 w-4" />
                      </Link>
                    )}
                    {contactInfo?.instagram_url && (
                      <Link
                        href={contactInfo.instagram_url}
                        target="_blank"
                        aria-label="Instagram"
                        className="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-border text-foreground hover:bg-accent/60 transition-colors"
                      >
                        <Instagram className="h-4 w-4" />
                      </Link>
                    )}
                    {contactInfo?.linkedin_url && (
                      <Link
                        href={contactInfo.linkedin_url}
                        target="_blank"
                        aria-label="LinkedIn"
                        className="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-border text-foreground hover:bg-accent/60 transition-colors"
                      >
                        <Linkedin className="h-4 w-4" />
                      </Link>
                    )}
                  </div>

                  {/* Embedded maps below social icons */}
                  {contactInfo?.map_embed_url && (
                    <div className="mt-5 rounded-2xl overflow-hidden border border-border/70 bg-muted/40">
                      <iframe src={contactInfo.map_embed_url} title="Location Map" className="w-full h-48 sm:h-56 md:h-64" loading="lazy" referrerPolicy="no-referrer-when-downgrade" />
                    </div>
                  )}
                </div>
              </div>
            </div>
          </div>
        </RevealOnScroll>

        <div className="mt-8 flex justify-center">
          <Button variant="outline" asChild className="rounded-full px-6">
            <Link href="/">Back to Home</Link>
          </Button>
        </div>
      </section>
    </main>
  );
};

export default ContactPage;
