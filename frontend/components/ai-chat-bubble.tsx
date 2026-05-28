"use client";

import React, { useState, useRef, useEffect } from "react";
import { Sparkles, X, Send, MessageCircle } from "lucide-react";
import { cn } from "@/lib/utils";

interface Message {
  id: string;
  text: string;
  sender: "user" | "ai";
  timestamp: Date;
}

// Simple markdown renderer for chat messages
const renderMarkdown = (text: string) => {
  // Split by newlines while preserving them
  const lines = text.split("\n");

  return lines.map((line, idx) => {
    const content = line;
    const elements: (string | React.ReactNode)[] = [];
    let lastIndex = 0;

    // Handle bold text **word**
    const boldRegex = /\*\*(.*?)\*\*/g;
    let match;
    while ((match = boldRegex.exec(content)) !== null) {
      if (match.index > lastIndex) {
        elements.push(content.substring(lastIndex, match.index));
      }
      elements.push(
        <strong key={`bold-${idx}-${match.index}`} className="font-semibold">
          {match[1]}
        </strong>,
      );
      lastIndex = boldRegex.lastIndex;
    }
    if (lastIndex < content.length) {
      elements.push(content.substring(lastIndex));
    }

    // Handle italic text *word*
    if (elements.length === 0) {
      elements.push(content);
    }

    const processedContent = elements.length > 0 ? elements : [content];

    // Check if line is a heading
    if (line.startsWith("## ")) {
      return (
        <h3 key={idx} className="font-semibold text-base mt-2 mb-1">
          {line.substring(3)}
        </h3>
      );
    }
    if (line.startsWith("### ")) {
      return (
        <h4 key={idx} className="font-medium text-sm mt-1.5 mb-0.5">
          {line.substring(4)}
        </h4>
      );
    }
    if (line.startsWith("- ")) {
      return (
        <div key={idx} className="ml-3 flex gap-2">
          <span>•</span>
          <span>{line.substring(2)}</span>
        </div>
      );
    }
    if (line.trim() === "") {
      return <div key={idx} className="h-1" />;
    }

    return (
      <p key={idx} className="leading-relaxed">
        {processedContent}
      </p>
    );
  });
};

export default function AiChatBubble() {
  const [isOpen, setIsOpen] = useState(false);
  const [messages, setMessages] = useState<Message[]>([]);
  const [inputValue, setInputValue] = useState("");
  const [isLoading, setIsLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);
  const messagesEndRef = useRef<HTMLDivElement>(null);

  const scrollToBottom = () => {
    messagesEndRef.current?.scrollIntoView({ behavior: "smooth" });
  };

  useEffect(() => {
    scrollToBottom();
  }, [messages]);

  const handleSendMessage = async () => {
    if (!inputValue.trim()) return;

    const messageToSend = inputValue;

    // Add user message to chat
    const userMessage: Message = {
      id: Date.now().toString(),
      text: messageToSend,
      sender: "user",
      timestamp: new Date(),
    };

    setMessages((prev) => [...prev, userMessage]);
    setInputValue("");
    setIsLoading(true);
    setError(null);

    try {
      const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/api/ai/chat`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          message: messageToSend,
        }),
      });

      const data = await response.json();

      // Always show message if we have one, whether success or not
      if (data.message) {
        const aiMessage: Message = {
          id: (Date.now() + 1).toString(),
          text: data.message,
          sender: "ai",
          timestamp: new Date(),
        };
        setMessages((prev) => [...prev, aiMessage]);
      } else if (!response.ok || !data.success) {
        throw new Error(data.message || "Failed to get response");
      }
    } catch (err) {
      const errorMessage = err instanceof Error ? err.message : "An error occurred";
      setError(errorMessage);
      console.error("Chat error:", err);
    } finally {
      setIsLoading(false);
    }
  };

  const handleKeyPress = (e: React.KeyboardEvent) => {
    if (e.key === "Enter" && !e.shiftKey) {
      e.preventDefault();
      handleSendMessage();
    }
  };

  return (
    <div className="fixed bottom-6 left-6 z-40">
      {/* Chat Window */}
      {isOpen && (
        <div className="mb-4 w-80 bg-white dark:bg-slate-900 rounded-2xl shadow-xl border border-slate-200 dark:border-slate-700 flex flex-col overflow-hidden animate-in fade-in slide-in-from-bottom-4 duration-300">
          {/* Header */}
          <div className="bg-gradient-to-r from-primary to-primary/80 text-white p-4 flex items-center justify-between">
            <div className="flex items-center gap-2">
              <Sparkles className="w-5 h-5" />
              <h3 className="font-semibold">Nexteam AI Assistant</h3>
            </div>
            <button onClick={() => setIsOpen(false)} className="hover:bg-white/20 p-1 rounded-full transition-colors" aria-label="Close chat">
              <X className="w-5 h-5" />
            </button>
          </div>

          {/* Messages Area */}
          <div className="h-96 overflow-y-auto p-4 space-y-3 backdrop-blur-sm">
            {messages.length === 0 && (
              <div className="h-full flex flex-col items-center justify-center text-center text-muted-foreground">
                <Sparkles className="w-10 h-10 mb-2 text-primary/50" />
                <p className="text-sm">Hi! How can I help you with Nexteam services?</p>
              </div>
            )}

            {messages.map((message) => (
              <div key={message.id} className={cn("flex gap-2", message.sender === "user" ? "justify-end" : "justify-start")}>
                <div className={cn("max-w-xs px-4 py-2 rounded-lg text-sm", message.sender === "user" ? "bg-primary text-white rounded-br-none" : "bg-slate-100 dark:bg-slate-800 text-slate-900 dark:text-slate-100 rounded-bl-none")}>
                  {message.sender === "ai" ? renderMarkdown(message.text) : message.text}
                </div>
              </div>
            ))}

            {isLoading && (
              <div className="flex gap-2">
                <div className="bg-slate-100 dark:bg-slate-800 rounded-lg rounded-bl-none px-4 py-2">
                  <div className="flex gap-1">
                    <div className="w-2 h-2 bg-slate-400 rounded-full animate-bounce" style={{ animationDelay: "0ms" }} />
                    <div className="w-2 h-2 bg-slate-400 rounded-full animate-bounce" style={{ animationDelay: "150ms" }} />
                    <div className="w-2 h-2 bg-slate-400 rounded-full animate-bounce" style={{ animationDelay: "300ms" }} />
                  </div>
                </div>
              </div>
            )}

            {error && <div className="bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 px-4 py-2 rounded-lg text-sm">{error}</div>}

            <div ref={messagesEndRef} />
          </div>

          {/* Input Area */}
          <div className="border-t border-slate-200 dark:border-slate-700 p-3 bg-slate-50 dark:bg-slate-800">
            <div className="flex gap-2">
              <input
                type="text"
                value={inputValue}
                onChange={(e) => setInputValue(e.target.value)}
                onKeyPress={handleKeyPress}
                placeholder="Ask me anything..."
                disabled={isLoading}
                className="flex-1 bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 text-sm placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary disabled:opacity-50"
              />
              <button
                onClick={handleSendMessage}
                disabled={isLoading || !inputValue.trim()}
                className="bg-primary hover:bg-primary/90 text-white rounded-lg px-3 py-2 transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-1"
                aria-label="Send message"
              >
                <Send className="w-4 h-4" />
              </button>
            </div>
          </div>
        </div>
      )}

      {/* Floating Button */}
      <button
        onClick={() => setIsOpen(!isOpen)}
        className={cn(
          "w-14 h-14 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center",
          isOpen ? "bg-slate-200 dark:bg-slate-700 text-slate-900 dark:text-slate-100" : "bg-gradient-to-r from-primary to-primary/80 text-white hover:scale-110",
        )}
        aria-label="Toggle AI chat"
      >
        {isOpen ? <MessageCircle className="w-6 h-6" /> : <Sparkles className="w-6 h-6 animate-pulse" />}
      </button>
    </div>
  );
}
