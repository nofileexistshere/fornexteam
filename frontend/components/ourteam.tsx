"use client";

import { useState, useEffect } from "react";
import { Instagram, Linkedin } from "lucide-react";
import Link from "next/link";
import Image from "next/image";
import RevealOnScroll from "./animation/reveal-on-scroll";
import { cn } from "@/lib/utils";
import { useParallax } from "@/lib/use-parallax";

interface TeamMemberData {
  id: number;
  name: string;
  position: string;
  bio: string | null;
  photo: string | null;
  photo_url: string | null;
  linkedin: string | null;
  instagram: string | null;
  order: number;
  is_active: boolean;
}

interface TeamMemberCardProps {
  member: TeamMemberData;
  index: number;
  isActive: boolean;
  onToggle: (index: number) => void;
}

const TeamMemberCard = ({ member, index, isActive, onToggle }: TeamMemberCardProps) => {
  const { ref } = useParallax(0.15 + (index % 2) * 0.1);
  const imageUrl = member.photo_url || "/placeholder.svg";
  const nameInitial = member.name.charAt(0).toUpperCase();

  return (
    <div ref={ref}>
      <RevealOnScroll delay={0.05 * index}>
        <div className="group bg-accent/60 border rounded-xl overflow-hidden h-full flex flex-col">
          {/* Image */}
          <div className="relative w-full aspect-square cursor-pointer" onClick={() => onToggle(index)}>
            {member.photo_url ? (
              <Image src={imageUrl} alt={member.name} fill sizes="(max-width: 640px) 100vw, (max-width: 1280px) 50vw, 25vw" className="object-cover" />
            ) : (
              <div className="w-full h-full flex items-center justify-center bg-accent">
                <div className="w-32 h-32 rounded-full bg-primary/10 flex items-center justify-center">
                  <span className="text-5xl font-bold text-primary">{nameInitial}</span>
                </div>
              </div>
            )}
            {/* Social overlay */}
            {(member.linkedin || member.instagram) && (
              <div
                className={cn(
                  "absolute inset-0 flex items-center justify-center bg-black/40 transition-opacity",
                  // Mobile: toggle by tap
                  isActive ? "opacity-100" : "opacity-0",
                  // Desktop: show on hover
                  "md:opacity-0 md:group-hover:opacity-100",
                )}
              >
                <div className="flex items-center gap-3 rounded-full bg-background px-4 py-2 shadow-md">
                  {member.linkedin && (
                    <Link href={member.linkedin} target="_blank" aria-label={`${member.name} on LinkedIn`}>
                      <Linkedin className="h-5 w-5 text-muted-foreground hover:text-foreground" />
                    </Link>
                  )}
                  {member.instagram && (
                    <Link href={member.instagram} target="_blank" aria-label={`${member.name} on Instagram`}>
                      <Instagram className="h-5 w-5 text-muted-foreground hover:text-foreground" />
                    </Link>
                  )}
                </div>
              </div>
            )}
          </div>

          {/* Name & role */}
          <div className="px-6 py-4 text-center">
            <h3 className="text-lg font-semibold tracking-tight">{member.name}</h3>
            <p className="text-sm text-muted-foreground font-medium">{member.position}</p>
          </div>
        </div>
      </RevealOnScroll>
    </div>
  );
};

const OurTeam = () => {
  const [activeIndex, setActiveIndex] = useState<number | null>(null);
  const [teamMembers, setTeamMembers] = useState<TeamMemberData[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchTeamMembers = async () => {
      try {
        const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/api/team`);
        const data = await response.json();
        setTeamMembers(data);
      } catch (error) {
        console.error("Failed to fetch team members:", error);
      } finally {
        setLoading(false);
      }
    };

    fetchTeamMembers();
  }, []);

  if (loading) {
    return (
      <div id="team" className="max-w-(--breakpoint-xl) mx-auto py-12 xs:py-20 px-6">
        <div className="text-center">Loading team members...</div>
      </div>
    );
  }

  return (
    <div id="team" className="max-w-(--breakpoint-xl) mx-auto py-12 xs:py-20 px-6">
      <RevealOnScroll>
        <h1 className="text-4xl xs:text-5xl font-bold text-center tracking-tight">Our Team</h1>
        <p className="mt-2 text-center text-muted-foreground max-w-xl mx-auto">Berkenalan dengan tim di balik micro business kami, tim kecil yang fokus, bergerak cepat, dan peduli pada setiap detail.</p>
      </RevealOnScroll>
      <RevealOnScroll delay={0.05}>
        <div className="mt-8 xs:mt-14 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4 gap-8">
          {teamMembers.map((member, index) => (
            <TeamMemberCard key={member.id} member={member} index={index} isActive={activeIndex === index} onToggle={setActiveIndex} />
          ))}
        </div>
      </RevealOnScroll>
    </div>
  );
};

export default OurTeam;
