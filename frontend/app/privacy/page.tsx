import type { Metadata } from "next";
import PrivacyPage from "./PrivacyPage";
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
    const res = await pagesApi.getPrivacy();
    return res.data;
  } catch (error) {
    console.error("Error fetching privacy page:", error);
    return null;
  }
}

export async function generateMetadata(): Promise<Metadata> {
  const page = await getPage();

  return {
    title: `${page?.title || "Privacy Policy"} | NoFileExistsHere. (Nexteam)`,
    description: page?.meta_description || "Kebijakan privasi Nexteam yang menjelaskan pengumpulan, penggunaan, dan perlindungan data pribadi pengguna website dan layanan teknologi kami.",
    keywords: ["privacy policy", "kebijakan privasi", "perlindungan data", "data pribadi", "Nexteam privacy", "GDPR Indonesia", "keamanan data"],
    openGraph: {
      title: `${page?.title || "Privacy Policy"} | NoFileExistsHere. (Nexteam)`,
      description: page?.meta_description || "Kebijakan privasi Nexteam yang menjelaskan pengumpulan, penggunaan, dan perlindungan data pribadi pengguna.",
      url: "/privacy",
      type: "website",
      images: [
        {
          url: page?.image ? `${process.env.NEXT_PUBLIC_API_URL}/storage/${page.image}` : "/logo/logo.webp",
          width: 1200,
          height: 630,
          alt: "NoFileExistsHere (Nexteam) privacy policy",
        },
      ],
    },
  };
}

export default async function Page() {
  const page = await getPage();
  return <PrivacyPage pageData={page} />;
}
