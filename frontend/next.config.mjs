/** @type {import('next').NextConfig} */
const nextConfig = {
  output: "standalone",

  images: {
    remotePatterns: [
      // Local dev (Laravel)
      {
        protocol: "http",
        hostname: "localhost",
        port: "8000",
        pathname: "/**",
      },
      {
        protocol: "https",
        hostname: "localhost",
        port: "8000",
        pathname: "/**",
      },

      // Production API server
      {
        protocol: "https",
        hostname: "board.fornexteam.com",
        pathname: "/**",
      },
    ],
  },
};

export default nextConfig;
