"use client";

import React, { useState, useEffect, useCallback } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { ArrowDown, ArrowUp, Activity, Play, RotateCcw, ArrowLeft, Share2, CheckCircle2, Zap, MonitorPlay, Globe } from "lucide-react";
import { Button } from "@/components/ui/button";
import Link from "next/link";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { cn } from "@/lib/utils";

interface SpeedStats {
  ping: number | null;
  download: number | null;
  upload: number | null;
}

interface SpeedHistory {
  download: number[];
  upload: number[];
}

interface NetworkInfo {
  ip: string;
  isp: string;
  location: string;
}

export default function SpeedtestUI() {
  const [testing, setTesting] = useState(false);
  const [phase, setPhase] = useState<"idle" | "ping" | "download" | "upload" | "finished">("idle");
  const [stats, setStats] = useState<SpeedStats>({
    ping: null,
    download: null,
    upload: null,
  });
  const [history, setHistory] = useState<SpeedHistory>({
    download: [],
    upload: [],
  });
  const [currentValue, setCurrentValue] = useState(0);
  const [networkInfo, setNetworkInfo] = useState<NetworkInfo>({
    ip: "Detecting...",
    isp: "Detecting...",
    location: "Detecting...",
  });

  useEffect(() => {
    const fetchNetworkInfo = async () => {
      try {
        const res = await fetch("https://ipapi.co/json/");
        const data = await res.json();
        setNetworkInfo({
          ip: data.ip || "Unknown",
          isp: data.org || "Unknown",
          location: `${data.city}, ${data.country_name}` || "Unknown",
        });
      } catch (e) {
        console.error("Failed to fetch network info", e);
        setNetworkInfo({
          ip: "Unavailable",
          isp: "Unavailable",
          location: "Unavailable",
        });
      }
    };
    fetchNetworkInfo();
  }, []);

  const startTest = useCallback(async () => {
    const runPingTest = async (): Promise<number> => {
      const pings: number[] = [];
      for (let i = 0; i < 5; i++) {
        const start = performance.now();
        try {
          await fetch("https://speed.cloudflare.com/__down?bytes=0", { cache: "no-store", mode: "cors" });
          pings.push(performance.now() - start);
        } catch (e) {
          console.error("Ping error", e);
        }
        await new Promise((r) => setTimeout(r, 100));
      }
      return Math.round(Math.min(...pings));
    };

    const runDownloadTest = async (onProgress: (speed: number) => void): Promise<number> => {
      const TEST_DURATION = 15000; // 15 seconds for more stability
      const CHUNK_SIZE = 10 * 1024 * 1024; // 10MB chunks
      const url = "https://speed.cloudflare.com/__down?bytes=" + CHUNK_SIZE;

      let downloaded = 0;
      const start = performance.now();

      while (performance.now() - start < TEST_DURATION) {
        try {
          const res = await fetch(url, { cache: "no-store", mode: "cors" });
          const buffer = await res.arrayBuffer();
          downloaded += buffer.byteLength;

          const elapsed = (performance.now() - start) / 1000;
          const speed = (downloaded * 8) / (elapsed * 1024 * 1024);
          onProgress(speed);
        } catch (e) {
          console.error("Download error", e);
          break;
        }
      }

      const totalTime = (performance.now() - start) / 1000;
      return (downloaded * 8) / (totalTime * 1024 * 1024);
    };

    const runUploadTest = async (onProgress: (speed: number) => void): Promise<number> => {
      const TEST_DURATION = 12000; // 12 seconds
      const size = 5 * 1024 * 1024; // 5MB chunks for faster feedback
      const data = new Uint8Array(size);

      let totalUploaded = 0;
      const start = performance.now();

      // Initial progress to show immediate feedback
      onProgress(0);

      // We loop to ensure it lasts longer as per user request
      while (performance.now() - start < TEST_DURATION) {
        try {
          await fetch("https://speed.cloudflare.com/__up", {
            method: "POST",
            body: data,
            mode: "cors",
          });
          totalUploaded += size;
          const elapsed = (performance.now() - start) / 1000;
          const speed = (totalUploaded * 8) / (elapsed * 1024 * 1024);
          onProgress(speed);
        } catch (e) {
          console.error("Upload error", e);
          break;
        }
      }

      const totalTime = (performance.now() - start) / 1000;
      return (totalUploaded * 8) / (totalTime * 1024 * 1024);
    };

    setTesting(true);
    setStats({ ping: null, download: null, upload: null });
    setHistory({ download: [], upload: [] });

    // Ping Phase
    setPhase("ping");
    const pings = [];
    for (let i = 0; i < 3; i++) {
      pings.push(await runPingTest());
      setCurrentValue(pings[i]);
    }
    const avgPing = Math.round(pings.reduce((a, b) => a + b) / pings.length);
    setStats((prev) => ({ ...prev, ping: avgPing }));

    // Download Phase
    setPhase("download");
    setCurrentValue(0);
    const dlSpeed = await runDownloadTest((s) => {
      setCurrentValue(s);
      setHistory((prev) => ({ ...prev, download: [...prev.download.slice(-19), s] }));
    });
    setStats((prev) => ({ ...prev, download: dlSpeed }));

    // Upload Phase
    setPhase("upload");
    setCurrentValue(0);
    const ulSpeed = await runUploadTest((s) => {
      setCurrentValue(s);
      setHistory((prev) => ({ ...prev, upload: [...prev.upload.slice(-19), s] }));
    });
    setStats((prev) => ({ ...prev, upload: ulSpeed }));

    setPhase("finished");
    setTesting(false);
    setCurrentValue(0);
  }, []);

  const shareResults = async () => {
    const shareData = {
      title: "Speed Test Results",
      text:
        `📊 My Internet Speed Test Results\n\n` +
        `⚡ Download: ${stats.download?.toFixed(1)} Mbps\n` +
        `📤 Upload: ${stats.upload?.toFixed(1)} Mbps\n` +
        `⏱️ Ping: ${stats.ping} ms\n` +
        `🌍 Server: ${networkInfo.location}\n` +
        `🔗 Tested with Nexteam Speed Test`,
      url: window.location.href,
    };

    try {
      if (navigator.share) {
        await navigator.share(shareData);
      } else {
        // Fallback for browsers that don't support Web Share API
        await navigator.clipboard.writeText(shareData.text);
        alert("Results copied to clipboard! 📋");
      }
    } catch (err) {
      console.error("Error sharing:", err);
    }
  };

  const getPerformanceRating = () => {
    const dl = stats.download || 0;
    if (dl > 100) return { label: "Excellent", desc: "Perfect for 4K streaming, gaming, and large file transfers.", icon: <Zap className="w-6 h-6 text-yellow-500" /> };
    if (dl > 50) return { label: "Very Good", desc: "Great for HD streaming on multiple devices and video calls.", icon: <MonitorPlay className="w-6 h-6 text-blue-500" /> };
    if (dl > 25) return { label: "Good", desc: "Reliable for HD streaming and smooth web browsing.", icon: <CheckCircle2 className="w-6 h-6 text-emerald-500" /> };
    return { label: "Standard", desc: "Suitable for basic browsing, email, and music streaming.", icon: <Globe className="w-6 h-6 text-muted-foreground" /> };
  };

  const rating = getPerformanceRating();

  return (
    <div className="w-full max-w-4xl mx-auto p-4 space-y-8 relative">
      <div className="absolute left-4 top-0 -mt-8 md:-mt-12">
        <Button variant="ghost" asChild size="sm" className="gap-2 text-muted-foreground hover:text-foreground">
          <Link href="/">
            <ArrowLeft className="w-4 h-4" />
            Back to Home
          </Link>
        </Button>
      </div>

      <div className="text-center space-y-4 pt-4 md:pt-0">
        <h2 className="text-4xl font-bold tracking-tight bg-linear-to-r from-primary to-blue-600 bg-clip-text text-transparent">Network Speed Test</h2>
        <p className="text-muted-foreground text-lg">Measure your connection performance in seconds.</p>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
        <StatCard title="Ping / Latency" value={stats.ping} unit="ms" icon={<Activity className="w-5 h-5 text-emerald-500" />} active={phase === "ping"} color="emerald" />
        <StatCard
          title="Download"
          value={stats.download}
          unit="Mbps"
          icon={<ArrowDown className="w-5 h-5 text-blue-500" />}
          active={phase === "download"}
          color="blue"
          history={history.download}
          currentValue={phase === "download" ? currentValue : 0}
        />
        <StatCard
          title="Upload"
          value={stats.upload}
          unit="Mbps"
          icon={<ArrowUp className="w-5 h-5 text-purple-500" />}
          active={phase === "upload"}
          color="purple"
          history={history.upload}
          currentValue={phase === "upload" ? currentValue : 0}
        />
      </div>

      <Card className="relative overflow-hidden border-2 border-primary/10 shadow-xl bg-card/50 backdrop-blur-sm min-h-112.5 transition-all duration-500">
        <CardContent className="p-8 md:p-12 flex flex-col items-center justify-center h-full">
          <AnimatePresence mode="wait">
            {phase !== "finished" ? (
              <motion.div key="gauge-view" initial={{ opacity: 0, scale: 0.9 }} animate={{ opacity: 1, scale: 1 }} exit={{ opacity: 0, scale: 0.9 }} className="flex flex-col items-center">
                <div className="relative w-64 h-64 md:w-80 md:h-80">
                  {/* Gauge Background */}
                  <svg className="w-full h-full -rotate-90 transform" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="currentColor" strokeWidth="8" className="text-muted/20" strokeDasharray="212 283" strokeLinecap="round" />
                    {/* Active Gauge */}
                    <motion.circle
                      cx="50"
                      cy="50"
                      r="45"
                      fill="none"
                      stroke="url(#gaugeGradient)"
                      strokeWidth="8"
                      strokeDasharray={`${(currentValue / 100) * 212} 283`}
                      strokeLinecap="round"
                      className="transition-all duration-300 ease-out"
                      animate={{
                        strokeDasharray: `${Math.min((currentValue / 100) * 212, 212)} 283`,
                      }}
                    />
                    <defs>
                      <linearGradient id="gaugeGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stopColor={phase === "ping" ? "#10b981" : phase === "download" ? "#3b82f6" : phase === "upload" ? "#a855f7" : "#3b82f6"} />
                        <stop offset="100%" stopColor={phase === "ping" ? "#34d399" : phase === "download" ? "#60a5fa" : phase === "upload" ? "#c084fc" : "#8b5cf6"} />
                      </linearGradient>
                    </defs>
                  </svg>

                  {/* Value Display */}
                  <div className="absolute inset-0 flex flex-col items-center justify-center text-center">
                    <AnimatePresence mode="wait">
                      <motion.div key={phase} initial={{ opacity: 0, y: 10 }} animate={{ opacity: 1, y: 0 }} exit={{ opacity: 0, y: -10 }} className="mb-1">
                        <span className="text-xs font-bold uppercase tracking-widest text-muted-foreground">{phase === "idle" ? "Ready" : phase}</span>
                      </motion.div>
                    </AnimatePresence>
                    <div className="text-6xl md:text-7xl font-extrabold tracking-tighter tabular-nums">{Math.floor(currentValue)}</div>
                    <div className="text-muted-foreground font-medium">{phase === "ping" ? "ms" : "Mbps"}</div>
                  </div>
                </div>

                <div className="mt-8">
                  <Button size="lg" className="px-12 py-6 text-lg font-bold rounded-full shadow-lg shadow-primary/25 transition-all hover:scale-105 active:scale-95" disabled={testing} onClick={startTest}>
                    {testing ? (
                      <>
                        <RotateCcw className="mr-2 h-5 w-5 animate-spin" />
                        Testing...
                      </>
                    ) : (
                      <>
                        <Play className="mr-2 h-5 w-5 fill-current" />
                        Start Speed Test
                      </>
                    )}
                  </Button>
                </div>
              </motion.div>
            ) : (
              <motion.div key="result-view" initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }} className="w-full text-center space-y-8">
                <div className="space-y-2">
                  <div className="inline-flex p-3 rounded-full bg-primary/10 text-primary mb-4 animate-bounce">{rating.icon}</div>
                  <h3 className="text-3xl font-bold tracking-tight">Your Speed is {rating.label}!</h3>
                  <p className="text-muted-foreground max-w-md mx-auto">{rating.desc}</p>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-2xl mx-auto py-8 border-y">
                  <ResultItem label="Ping" value={stats.ping ?? undefined} unit="ms" />
                  <ResultItem label="Download" value={stats.download?.toFixed(1)} unit="Mbps" />
                  <ResultItem label="Upload" value={stats.upload?.toFixed(1)} unit="Mbps" />
                </div>

                <div className="flex flex-col sm:flex-row items-center justify-center gap-4">
                  <Button size="lg" variant="outline" className="w-full sm:w-auto px-10 py-6 rounded-full font-bold border-2" onClick={shareResults}>
                    <Share2 className="mr-2 h-5 w-5" />
                    Share Result
                  </Button>
                  <Button size="lg" className="w-full sm:w-auto px-10 py-6 rounded-full font-bold shadow-lg shadow-primary/25 transition-all hover:scale-105 active:scale-95" onClick={startTest}>
                    <RotateCcw className="mr-2 h-5 w-5" />
                    Test Again
                  </Button>
                </div>
              </motion.div>
            )}
          </AnimatePresence>
        </CardContent>
      </Card>

      <div className="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-muted-foreground text-center">
        <div className="p-4 border rounded-xl bg-muted/30">
          <strong>Server Location:</strong> {networkInfo.location}
        </div>
        <div className="p-4 border rounded-xl bg-muted/30">
          <strong>ISP:</strong> {networkInfo.isp}
        </div>
        <div className="p-4 border rounded-xl bg-muted/30">
          <strong>IP Address:</strong> {networkInfo.ip}
        </div>
      </div>
    </div>
  );
}

function ResultItem({ label, value, unit }: { label: string; value: string | number | undefined; unit: string }) {
  return (
    <div className="flex flex-col items-center gap-1">
      <span className="text-xs font-bold uppercase tracking-widest text-muted-foreground">{label}</span>
      <div className="flex items-baseline gap-1">
        <span className="text-3xl font-extrabold tabular-nums">{value ?? "---"}</span>
        <span className="text-sm font-medium text-muted-foreground">{unit}</span>
      </div>
    </div>
  );
}

function StatCard({ title, value, unit, icon, active, color, history, currentValue }: { title: string; value: number | null; unit: string; icon: React.ReactNode; active: boolean; color: string; history?: number[]; currentValue?: number }) {
  return (
    <Card className={cn("relative overflow-hidden transition-all duration-500", active && `ring-2 ring-${color}-500/50 shadow-lg shadow-${color}-500/10 scale-105 z-10`, !active && "opacity-80 grayscale-[0.5]")}>
      <CardHeader className="p-4 pb-2 flex flex-row items-center justify-between">
        <CardTitle className="text-sm font-medium text-muted-foreground">{title}</CardTitle>
        {icon}
      </CardHeader>
      <CardContent className="p-4 pt-0 space-y-3">
        <div className="flex items-baseline gap-1">
          <span className="text-2xl font-bold tabular-nums">{active && currentValue !== undefined ? currentValue.toFixed(1) : value !== null ? (title === "Ping / Latency" ? value : value.toFixed(1)) : "---"}</span>
          <span className="text-xs text-muted-foreground font-medium">{unit}</span>
        </div>

        {/* Wave component */}
        {(title === "Download" || title === "Upload") && (
          <div className="h-8 flex items-end gap-0.5">
            {Array.from({ length: 20 }).map((_, i) => {
              const dataValue = history && history[i] ? history[i] : 0;
              // Use the latest max value or current displayed value for better scaling
              const displayedValue = active && currentValue !== undefined ? currentValue : value || 0;
              const maxValue = history && history.length > 0 ? Math.max(...history, displayedValue, 10) : Math.max(displayedValue, 10);
              // Calculate percentage with minimum 5% for visibility
              const h = dataValue > 0 ? Math.max((dataValue / maxValue) * 100, 5) : 5;
              return (
                <motion.div
                  key={i}
                  className={cn("flex-1 rounded-t-sm", color === "blue" ? "bg-blue-500/40" : "bg-purple-500/40", active && (color === "blue" ? "bg-blue-500" : "bg-purple-500"))}
                  initial={{ height: "5%" }}
                  animate={{ height: `${h}%` }}
                  transition={{ type: "spring", stiffness: 300, damping: 20 }}
                />
              );
            })}
          </div>
        )}

        {active && <motion.div className={cn("absolute bottom-0 left-0 h-1 bg-current", `text-${color}-500`)} initial={{ width: 0 }} animate={{ width: "100%" }} transition={{ duration: 10, ease: "linear" }} />}
      </CardContent>
    </Card>
  );
}
