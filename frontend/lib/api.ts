import apiClient from "./api-client";

// Blog API
export const blogApi = {
  getAll: () => apiClient.get("/api/blog-posts"),
  getBySlug: (slug: string) => apiClient.get(`/api/blog-posts/${slug}`),
};

// Media API
export const mediaApi = {
  getAll: () => apiClient.get("/api/media"),
  getBySlug: (slug: string) => apiClient.get(`/api/media/${slug}`),
};

// Projects API
export const projectsApi = {
  getAll: () => apiClient.get("/api/projects"),
  getBySlug: (slug: string) => apiClient.get(`/api/projects/${slug}`),
};

// Services API
export const servicesApi = {
  getAll: () => apiClient.get("/api/services"),
  getBySlug: (slug: string) => apiClient.get(`/api/services/${slug}`),
};

// Templates/Store API
export const templatesApi = {
  getAll: () => apiClient.get("/api/templates"),
  getBySlug: (slug: string) => apiClient.get(`/api/templates/${slug}`),
};

// Pages API
export const pagesApi = {
  getAboutUs: () => apiClient.get("/api/pages/about-us"),
  getTerms: () => apiClient.get("/api/pages/terms"),
  getPrivacy: () => apiClient.get("/api/pages/privacy"),
};

// Footer Pages API
export const footerPagesApi = {
  getBySlug: (slug: string) => apiClient.get(`/api/footer-pages/${slug}`),
};

// Contact API
export const contactApi = {
  getInfo: () => apiClient.get("/api/contact-info"),
  submit: (data: { name: string; email: string; phone: string; needs: string }) => apiClient.post("/api/contact", data),
};

// License API
export const licenseApi = {
  get: () => apiClient.get("/api/license"),
};

export default apiClient;
