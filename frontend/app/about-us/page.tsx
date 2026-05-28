import type { Metadata } from "next";
import AboutUsPage from "./AboutUsPage";
import { pagesApi } from "@/lib/api";

interface PageData {
  id: number;
  title: string;
  slug: string;
  content: string;
  meta_description: string;
  image?: string;
  is_published: boolean;
  order: number;
}

async function getPage(): Promise<PageData | null> {
  try {
    const res = await pagesApi.getAboutUs();
    return res.data;
  } catch (error) {
    console.error("Error fetching about-us page:", error);
    return null;
  }
}

export async function generateMetadata(): Promise<Metadata> {
  const page = await getPage();

  return {
    title: `${page?.title || "About Us"} | NoFileExistsHere. (Nexteam)`,
    description: page?.meta_description || "Kenali lebih dekat tim Nexteam - partner teknologi untuk UMKM dan bisnis di Indonesia yang fokus pada solusi praktis dan hasil nyata.",
    keywords: ["about us", "tentang kami", "Nexteam profile", "tim developer", "TEKNOLOGI KREASI DIGITAL", "jasa IT profesional"],
    openGraph: {
      title: `${page?.title || "About Us"} | NoFileExistsHere. (Nexteam)`,
      description: page?.meta_description || "Kenali lebih dekat tim Nexteam - partner teknologi untuk UMKM dan bisnis di Indonesia.",
      url: "/about-us",
      type: "website",
      images: [
        {
          url: page?.image ? `${process.env.NEXT_PUBLIC_API_URL}/storage/${page.image}` : "/logo/logo.webp",
          width: 1200,
          height: 630,
          alt: "NoFileExistsHere (Nexteam) team",
        },
      ],
    },
  };
}

export default async function Page() {
  const page = await getPage();
  return <AboutUsPage pageData={page} />;
}
