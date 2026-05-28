import axios from "axios";

const getBaseURL = () => {
  // Client-side (browser)
  if (typeof window !== "undefined") {
    return process.env.NEXT_PUBLIC_API_URL;
  }

  // Server-side (SSR / standalone)
  return process.env.NEXT_PUBLIC_API_URL || "https://board.fornexteam.com";
};

const apiClient = axios.create({
  baseURL: getBaseURL(),
  timeout: 30000,
  headers: {
    "Content-Type": "application/json",
    Accept: "application/json",
  },
});

// Request interceptor
apiClient.interceptors.request.use(
  (config) => {
    if (typeof window !== "undefined") {
      const token = localStorage.getItem("auth_token");
      if (token) {
        config.headers.Authorization = `Bearer ${token}`;
      }
    }
    return config;
  },
  (error) => Promise.reject(error),
);

// Response interceptor
apiClient.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response?.status === 401 && typeof window !== "undefined") {
      localStorage.removeItem("auth_token");
    }
    return Promise.reject(error);
  },
);

export default apiClient;
