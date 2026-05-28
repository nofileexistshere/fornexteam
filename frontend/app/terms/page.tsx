import type { Metadata } from "next";
import TermsPage from "./TermsPage";
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
    const res = await pagesApi.getTerms();
    return res.data;
  } catch (error) {
    console.error("Error fetching terms page:", error);
    return null;
  }
}

export async function generateMetadata(): Promise<Metadata> {
  const page = await getPage();

  return {
    title: `${page?.title || "Terms & Conditions"} | NoFileExistsHere. (Nexteam)`,
    description: page?.meta_description || "Syarat dan ketentuan layanan Nexteam untuk penggunaan website dan jasa teknologi yang disediakan untuk usaha mikro dan kecil di Indonesia.",
    keywords: ["terms and conditions", "syarat dan ketentuan", "ketentuan layanan", "Nexteam terms", "peraturan layanan", "hukum layanan IT"],
    openGraph: {
      title: `${page?.title || "Terms & Conditions"} | NoFileExistsHere. (Nexteam)`,
      description: page?.meta_description || "Syarat dan ketentuan layanan Nexteam untuk penggunaan website dan jasa teknologi.",
      url: "/terms",
      type: "website",
      images: [
        {
          url: page?.image ? `${process.env.NEXT_PUBLIC_API_URL}/storage/${page.image}` : "/logo/logo.webp",
          width: 1200,
          height: 630,
          alt: "NoFileExistsHere (Nexteam) terms and conditions",
        },
      ],
    },
  };
}

export default async function Page() {
  const page = await getPage();
  return <TermsPage pageData={page} />;
}
