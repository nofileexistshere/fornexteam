import type { Metadata } from "next";
export const revalidate = 60;
import RevealOnScroll from "@/components/animation/reveal-on-scroll";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardHeader } from "@/components/ui/card";
import Image from "next/image";
import Link from "next/link";
import { notFound } from "next/navigation";
import { projectsApi } from "@/lib/api";

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

async function getProject(slug: string): Promise<ProjectData | null> {
  try {
    const res = await projectsApi.getBySlug(slug);
    return res.data;
  } catch (error) {
    console.error("Error fetching project:", error);
    return null;
  }
}

export async function generateMetadata({ params }: { params: Promise<{ slug: string }> }): Promise<Metadata> {
  const { slug } = await params;
  const project = await getProject(slug);

  if (!project) {
    return {
      title: "Project Not Found",
    };
  }

  const imageUrl = project.featured_image ? `${process.env.NEXT_PUBLIC_API_URL}/storage/${project.featured_image}` : "/logo/logo.webp";

  return {
    title: `${project.name} | NoFileExistsHere. (Nexteam)`,
    description: project.description,
    openGraph: {
      title: `${project.name} | NoFileExistsHere. (Nexteam)`,
      description: project.description,
      url: `/project/${project.slug}`,
      type: "article",
      images: [
        {
          url: imageUrl,
          width: 1200,
          height: 630,
          alt: `${project.name} - Nexteam`,
        },
      ],
    },
  };
}

const ProjectDetailPage = async ({ params }: { params: Promise<{ slug: string }> }) => {
  const { slug } = await params;
  const project = await getProject(slug);

  if (!project) {
    notFound();
  }

  return (
    <main className="min-h-[calc(100vh-4rem)] w-full border-b border-accent">
      <section className="max-w-(--breakpoint-xl) mx-auto w-full py-10 xs:py-14 px-6 space-y-10">
        <RevealOnScroll>
          <div className="space-y-3 text-center mb-6 md:mb-8">
            <h1 className="text-3xl xs:text-4xl md:text-5xl font-bold tracking-tight">{project.name}</h1>
            <p className="text-xs xs:text-sm text-muted-foreground">
              <br />
              <Link href="/" className="hover:text-foreground">
                Home
              </Link>{" "}
              /{" "}
              <Link href="/project" className="hover:text-foreground">
                Projects
              </Link>{" "}
              / <span className="text-foreground font-medium">{project.name}</span>
            </p>
            <br />
            <p className="max-w-2xl mx-auto text-muted-foreground text-sm md:text-base">{project.description}</p>
          </div>
        </RevealOnScroll>

        {/* Featured Image */}
        <RevealOnScroll delay={0.05}>
          <div className="rounded-xl overflow-hidden shadow-sm border bg-background">
            <div className="relative aspect-video">
              <Image
                src={project.featured_image ? `${process.env.NEXT_PUBLIC_API_URL}/storage/${project.featured_image}` : "/placeholder.svg"}
                alt={project.name}
                fill
                priority
                sizes="(min-width: 1024px) 1000px, (min-width: 768px) 800px, 100vw"
                className="object-cover object-top"
              />
            </div>
          </div>
        </RevealOnScroll>

        <RevealOnScroll delay={0.08}>
          <div className="grid grid-cols-1 lg:grid-cols-[minmax(0,1.6fr)_minmax(0,1fr)] gap-10 items-start">
            {/* Main Content */}
            <div className="prose max-w-none">{project.content && <div dangerouslySetInnerHTML={{ __html: project.content }} />}</div>

            {/* Sidebar Info */}
            <div className="space-y-6 text-sm md:text-base text-muted-foreground lg:sticky lg:top-6 lg:max-h-[calc(100vh-2rem)]">
              <Card className="border bg-card">
                <CardHeader className="border-b bg-background/60">
                  <p className="text-xs text-muted-foreground">Project Information</p>
                </CardHeader>
                <CardContent className="space-y-6 pt-6">
                  {project.client_name && (
                    <div className="space-y-2">
                      <h3 className="text-xs font-semibold text-foreground uppercase">Client</h3>
                      <p className="font-medium">{project.client_name}</p>
                    </div>
                  )}

                  <div className="space-y-2">
                    <h3 className="text-xs font-semibold text-foreground uppercase">Category</h3>
                    <p className="font-medium">{project.category}</p>
                  </div>

                  {project.technologies && project.technologies.length > 0 && (
                    <div className="space-y-2">
                      <h3 className="text-xs font-semibold text-foreground uppercase">Technologies</h3>
                      <div className="flex flex-wrap gap-2">
                        {project.technologies.map((tech, index) => (
                          <span key={index} className="rounded-full bg-muted px-3 py-1 text-xs font-medium text-muted-foreground">
                            {tech}
                          </span>
                        ))}
                      </div>
                    </div>
                  )}

                  {(project.start_date || project.end_date) && (
                    <div className="space-y-2">
                      <h3 className="text-xs font-semibold text-foreground uppercase">Timeline</h3>
                      <p className="font-medium">
                        {project.start_date && new Date(project.start_date).toLocaleDateString("id-ID", { month: "long", year: "numeric" })}
                        {project.start_date && project.end_date && " - "}
                        {project.end_date && new Date(project.end_date).toLocaleDateString("id-ID", { month: "long", year: "numeric" })}
                      </p>
                    </div>
                  )}

                  {project.project_url && (
                    <div className="space-y-2">
                      <h3 className="text-xs font-semibold text-foreground uppercase">Live URL</h3>
                      <Link href={project.project_url} target="_blank" className="text-primary underline underline-offset-4 hover:text-primary/80 break-all">
                        {project.project_url}
                      </Link>
                    </div>
                  )}
                </CardContent>
              </Card>
            </div>
          </div>
        </RevealOnScroll>

        {/* CTA Buttons */}
        <div className="mt-8 flex flex-wrap gap-3">
          <Button asChild size="sm" className="rounded-full">
            <Link href="/project">Back To Projects</Link>
          </Button>
          <Button asChild size="sm" variant="outline" className="rounded-full">
            <Link href="/contact">Discuss Similar Project</Link>
          </Button>
        </div>
      </section>
    </main>
  );
};

export default ProjectDetailPage;
