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
        pathname: "/storage/**",
      },
      {
        protocol: "http",
        hostname: "localhost",
        port: "8000",
        pathname: "/hero/**",
      },

      // Production API server
      {
        protocol: "https",
        hostname: "board.fornexteam.com",
        pathname: "/storage/**",
      },
      {
        protocol: "https",
        hostname: "board.fornexteam.com",
        pathname: "/hero/**",
      },
    ],
  },
};

export default nextConfig;
