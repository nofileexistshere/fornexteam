"use client";

import { ReactNode } from "react";
import { motion } from "framer-motion";

interface RevealOnScrollProps {
  children: ReactNode;
  delay?: number;
}

const RevealOnScroll = ({ children, delay = 0 }: RevealOnScrollProps) => {
  return (
    <motion.div initial={{ opacity: 0, y: 16 }} whileInView={{ opacity: 1, y: 0 }} viewport={{ once: true, amount: 0.1 }} transition={{ duration: 0.2, ease: "easeOut", delay }}>
      {children}
    </motion.div>
  );
};

export default RevealOnScroll;
