import React from "react";
import SpeedtestUI from "@/components/speedtest-ui";
import Footer from "@/components/footer";
import WhatsAppBubble from "@/components/whatsapp-bubble";

export default function SpeedtestPage() {
  return (
    <div className="min-h-screen flex flex-col bg-background selection:bg-primary/10">
      <main className="grow pt-12 pb-12">
        <SpeedtestUI />
      </main>
      <Footer />
      <WhatsAppBubble />
    </div>
  );
}
