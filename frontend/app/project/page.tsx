import type { Metadata } from "next";
export const revalidate = 60;
import RevealOnScroll from "@/components/animation/reveal-on-scroll";
import { Button } from "@/components/ui/button";
import Image from "next/image";
import Link from "next/link";
import { projectsApi } from "@/lib/api";

export const metadata: Metadata = {
  title: "Projects | NoFileExistsHere. (Nexteam)",
  description: "Kumpulan project yang pernah dikerjakan NoFileExistsHere (Nexteam), mulai dari website, aplikasi, hingga solusi infrastruktur untuk klien di berbagai industri.",
  openGraph: {
    title: "Projects | NoFileExistsHere. (Nexteam)",
    description: "Lihat beberapa contoh project NoFileExistsHere (Nexteam) yang membantu klien menyelesaikan kebutuhan website, aplikasi, dan infrastruktur.",
    url: "/project",
    type: "website",
    images: [
      {
        url: "/logo/logo.webp",
        width: 1200,
        height: 630,
        alt: "NoFileExistsHere (Nexteam) logo",
      },
    ],
  },
};

interface ProjectData {
  id: number;
  name: string;
  slug: string;
  description: string;
  content: string;
  client_name?: string;
  category: string;
  technologies: string[];
  featured_image?: string;
  gallery_images: string[];
  project_url?: string;
  start_date?: string;
  end_date?: string;
  is_featured: boolean;
  is_published: boolean;
  order: number;
  created_at: string;
  updated_at: string;
}

async function getProjects(): Promise<ProjectData[]> {
  try {
    const res = await projectsApi.getAll();
    return res.data;
  } catch (error) {
    console.error("Error fetching projects:", error);
    return [];
  }
}

const ProjectPage = async () => {
  const projects = await getProjects();
  return (
    <main className="min-h-[calc(100vh-4rem)] w-full">
      <section className="max-w-(--breakpoint-xl) mx-auto w-full py-12 xs:py-20 px-6 space-y-10">
        <RevealOnScroll>
          <div className="space-y-3 text-center mb-6 md:mb-8">
            <h1 className="text-3xl xs:text-4xl md:text-5xl font-bold tracking-tight">Projects</h1>
            <p className="text-xs xs:text-sm text-muted-foreground">
              <br />
              <Link href="/" className="hover:text-foreground">
                Home
              </Link>{" "}
              / <span className="text-foreground font-medium">Projects</span>
            </p>
            <br />
            <p className="max-w-2xl mx-auto text-muted-foreground text-sm md:text-base">
              Di halaman ini, Anda dapat melihat beberapa contoh proyek yang pernah kami kerjakan, mulai dari website, aplikasi, hingga solusi infrastruktur yang membantu klien menyelesaikan masalah nyata mereka.
            </p>
          </div>
        </RevealOnScroll>

        <RevealOnScroll delay={0.05}>
          <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            {projects.map((project) => (
              <Link key={project.slug} href={`/project/${project.slug}`} className="group flex h-full flex-col rounded-xl border-2 border-accent bg-background/60 overflow-hidden transition-transform duration-150 hover:-translate-y-0.5">
                <div className="relative aspect-video w-full bg-muted">
                  <Image
                    src={project.featured_image ? `${process.env.NEXT_PUBLIC_API_URL}/storage/${project.featured_image}` : "/placeholder.svg"}
                    alt={project.name}
                    fill
                    sizes="(min-width: 1024px) 400px, (min-width: 768px) 350px, 100vw"
                    className="object-cover"
                  />
                </div>
                <div className="flex flex-col justify-between flex-1 p-6">
                  <div>
                    <p className="text-xs font-medium uppercase tracking-wide text-muted-foreground">{project.category}</p>
                    <h2 className="mt-2 text-lg font-semibold tracking-tight group-hover:underline">{project.name}</h2>
                    <p className="mt-3 text-sm text-muted-foreground">{project.description}</p>
                  </div>
                  <p className="mt-4 text-xs font-medium text-primary group-hover:underline">Lihat detail project</p>
                </div>
              </Link>
            ))}
          </div>
        </RevealOnScroll>

        <div className="mt-8 flex justify-center">
          <Button variant="outline" asChild className="rounded-full px-6">
            <Link href="/contact">Discuss Your Project</Link>
          </Button>
        </div>
      </section>
    </main>
  );
};

export default ProjectPage;
