"use client";

import { useMemo, useState, useEffect } from "react";
import Link from "next/link";
import Image from "next/image";
import { Card, CardContent, CardFooter, CardHeader } from "@/components/ui/card";
import { templatesApi } from "@/lib/api";

type StoreTemplate = {
  id: number;
  slug: string;
  name: string;
  description: string;
  category: string;
  tags: string[];
  price: number;
  preview_image: string | null;
  demo_url: string | null;
  version: string;
  is_featured: boolean;
  downloads: number;
  updated_at: string;
};

const StorePageClient = () => {
  const [templates, setTemplates] = useState<StoreTemplate[]>([]);
  const [loading, setLoading] = useState(true);
  const [query, setQuery] = useState("");
  const [onlyFree, setOnlyFree] = useState(false);
  const [sort, setSort] = useState<"newest" | "popular">("newest");
  const [category, setCategory] = useState<string | "all">("all");

  useEffect(() => {
    const fetchTemplates = async () => {
      try {
        const response = await templatesApi.getAll();
        setTemplates(response.data);
      } catch (error) {
        console.error("Failed to fetch templates:", error);
      } finally {
        setLoading(false);
      }
    };

    fetchTemplates();
  }, []);

  const categories = useMemo(() => {
    const counts = new Map<string, number>();
    for (const tpl of templates) {
      counts.set(tpl.category, (counts.get(tpl.category) ?? 0) + 1);
    }
    return Array.from(counts.entries()).sort((a, b) => a[0].localeCompare(b[0]));
  }, [templates]);

  const filtered = useMemo(() => {
    let data = [...templates];

    if (onlyFree) {
      data = data.filter((tpl) => tpl.price === 0);
    }

    if (category !== "all") {
      data = data.filter((tpl) => tpl.category === category);
    }

    if (query.trim()) {
      const q = query.toLowerCase();
      data = data.filter((tpl) => tpl.name.toLowerCase().includes(q) || tpl.description.toLowerCase().includes(q) || tpl.tags.some((tag) => tag.toLowerCase().includes(q)));
    }

    data.sort((a, b) => {
      if (sort === "popular") {
        return b.downloads - a.downloads;
      }
      return new Date(b.updated_at).getTime() - new Date(a.updated_at).getTime();
    });

    return data;
  }, [templates, category, onlyFree, query, sort]);

  if (loading) {
    return <div className="text-center text-muted-foreground">Loading templates...</div>;
  }

  return (
    <div className="flex flex-col gap-6 md:flex-row md:items-start">
      <aside className="w-full shrink-0 md:w-60">
        <div className="rounded-xl border bg-background p-4 shadow-sm">
          <p className="text-xs font-semibold uppercase tracking-wide text-muted-foreground">Categories</p>
          <div className="mt-4 space-y-1 text-sm">
            <button
              type="button"
              onClick={() => setCategory("all")}
              className={`flex w-full items-center justify-between rounded-lg px-3 py-2 text-left transition-colors ${category === "all" ? "bg-foreground text-background" : "hover:bg-accent hover:text-accent-foreground"}`}
            >
              <span>All</span>
              <span className="text-xs opacity-80">{templates.length}</span>
            </button>
            {categories.map(([cat, count]) => (
              <button
                key={cat}
                type="button"
                onClick={() => setCategory(cat)}
                className={`flex w-full items-center justify-between rounded-lg px-3 py-2 text-left text-xs xs:text-sm transition-colors ${
                  category === cat ? "bg-foreground text-background" : "hover:bg-accent hover:text-accent-foreground"
                }`}
              >
                <span>{cat}</span>
                <span className="text-[10px] xs:text-xs opacity-80">{count}</span>
              </button>
            ))}
          </div>
        </div>
      </aside>

      <div className="flex-1 space-y-4">
        <div className="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
          <div className="flex w-full items-center gap-2 rounded-full border bg-background px-4 py-2 text-sm shadow-sm">
            <span className="text-xs text-muted-foreground">Search</span>
            <input value={query} onChange={(e) => setQuery(e.target.value)} placeholder="Search templates" className="h-8 w-full bg-transparent text-xs xs:text-sm outline-none placeholder:text-muted-foreground/70" />
          </div>

          <div className="flex items-center gap-2 self-end text-xs xs:text-sm">
            <div className="inline-flex rounded-full border bg-background p-1 text-xs xs:text-sm shadow-sm">
              <button type="button" onClick={() => setSort("newest")} className={`rounded-full px-3 py-1 ${sort === "newest" ? "bg-foreground text-background" : "text-muted-foreground hover:bg-accent hover:text-accent-foreground"}`}>
                Newest
              </button>
              <button type="button" onClick={() => setSort("popular")} className={`rounded-full px-3 py-1 ${sort === "popular" ? "bg-foreground text-background" : "text-muted-foreground hover:bg-accent hover:text-accent-foreground"}`}>
                Popular
              </button>
            </div>

            <div className="inline-flex rounded-full border bg-background p-1 text-xs xs:text-sm shadow-sm">
              <button type="button" onClick={() => setOnlyFree(true)} className={`rounded-full px-3 py-1 ${onlyFree ? "bg-foreground text-background" : "text-muted-foreground hover:bg-accent hover:text-accent-foreground"}`}>
                Free
              </button>
              <button type="button" onClick={() => setOnlyFree(false)} className={`rounded-full px-3 py-1 ${!onlyFree ? "bg-foreground text-background" : "text-muted-foreground hover:bg-accent hover:text-accent-foreground"}`}>
                All
              </button>
            </div>
          </div>
        </div>

        <div className="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
          {filtered.map((tpl) => (
            <Link key={tpl.slug} href={`/store/${tpl.slug}`} className="group flex h-full flex-col">
              <Card className="flex h-full flex-col overflow-hidden rounded-xl border bg-card text-card-foreground shadow-sm transition-transform duration-150 group-hover:-translate-y-0.5">
                <div className="relative h-40 w-full overflow-hidden bg-muted">
                  {tpl.preview_image ? (
                    <Image
                      src={`${process.env.NEXT_PUBLIC_API_URL}/storage/${tpl.preview_image}`}
                      alt={tpl.name}
                      fill
                      sizes="(min-width: 1024px) 360px, (min-width: 768px) 50vw, 100vw"
                      className="object-cover transition-transform duration-200 group-hover:scale-[1.02]"
                    />
                  ) : (
                    <div className="w-full h-full flex items-center justify-center bg-accent/20">
                      <span className="text-4xl text-muted-foreground">{tpl.name.charAt(0)}</span>
                    </div>
                  )}
                  <div className="pointer-events-none absolute inset-x-3 top-3 flex items-center justify-between text-[10px]">
                    <span className="rounded-full bg-background/90 px-2 py-0.5 text-muted-foreground">Preview</span>
                    <span className="rounded-full bg-foreground px-2 py-0.5 text-background">{tpl.price === 0 ? "Free" : "Premium"}</span>
                  </div>
                </div>
                <CardHeader className="flex-1 space-y-2 bg-background/60 px-6 pt-5 pb-3">
                  <p className="text-[10px] font-medium uppercase tracking-wide text-muted-foreground">{tpl.category}</p>
                  <h2 className="text-sm font-semibold tracking-tight group-hover:underline">{tpl.name}</h2>
                  <p className="line-clamp-3 text-xs text-muted-foreground">{tpl.description}</p>
                </CardHeader>
                <CardContent className="space-y-2 text-xs">
                  <div className="flex flex-wrap gap-1">
                    {tpl.tags.map((tag) => (
                      <span key={tag} className="rounded-full bg-muted px-2 py-0.5 text-[10px] text-muted-foreground">
                        {tag}
                      </span>
                    ))}
                  </div>
                </CardContent>
                <CardFooter className="flex items-center justify-between bg-background/60 text-[11px]">
                  <div className="flex items-center gap-2 text-muted-foreground">
                    <span>{tpl.price === 0 ? "Free" : "Premium"}</span>
                    <span className="h-1 w-1 rounded-full bg-muted-foreground" />
                    <span>Updated {new Date(tpl.updated_at).toLocaleDateString("en-US", { year: "numeric", month: "2-digit", day: "2-digit" })}</span>
                  </div>
                  <div className="flex items-center gap-2">
                    <span className="rounded-full bg-foreground px-3 py-1 text-[11px] font-medium text-background">Preview</span>
                  </div>
                </CardFooter>
              </Card>
            </Link>
          ))}

          {filtered.length === 0 && <p className="col-span-full text-center text-sm text-muted-foreground">Tidak ada template yang cocok dengan filter saat ini.</p>}
        </div>
      </div>
    </div>
  );
};

export default StorePageClient;
