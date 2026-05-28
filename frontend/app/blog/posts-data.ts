export type BlogPost = {
  slug: string;
  title: string;
  excerpt: string;
  tag: string;
  content: string[];
};

export const posts: BlogPost[] = [
  {
    slug: "network-troubleshooting-tips",
    title: "5 Catatan Saat Troubleshooting Jaringan di Lapangan",
    excerpt: "Beberapa hal praktis yang kami pelajari ketika menangani kasus jaringan di kantor klien, supaya downtime bisa ditekan seminimal mungkin.",
    tag: "Infrastructure",
    content: [
      "Troubleshooting jaringan di lapangan itu kadang kayak detektif: tempatnya beda, gejalanya beda, tapi polanya sering mirip. Makanya, kami selalu mulai dengan checklist kecil sebelum masuk ke analisa yang lebih rumit.",
      "Hal yang paling sering menyelamatkan waktu? Cek fisik. Kabel yang kegencet meja, patch cord yang longgar, hingga switch yang panas berlebih—masalah simpel kayak gini ternyata penyebab downtime yang paling sering kami temukan.",
      "Setelah itu, dokumentasi topologi jadi penyelamat kedua. Foto rack, catatan port, dan skema sederhana bikin proses tracing jauh lebih cepat, apalagi kalau project-nya 'warisan' dari teknisi sebelumnya.",
      "Dan terakhir, komunikasi. Nggak sedikit kasus yang ternyata salah paham antara tim internal dan user. Dengan informasi yang jelas sejak awal, proses troubleshooting bisa selesai dalam hitungan menit, bukan jam.",
    ],
  },
  {
    slug: "first-pesantren-website",
    title: "Belajar dari Project Website Pesantren Pertama Kami",
    excerpt: "Bagaimana proses kami membantu pesantren memiliki profil online yang rapi, serta apa saja pelajaran yang bisa diterapkan ke project berikutnya.",
    tag: "Web Development",
    content: [
      "Project website pesantren pertama ini mengajarkan kami untuk benar-benar memahami kebutuhan komunikasi lembaga pendidikan ke orang tua dan calon santri.",
      "Mulai dari penyusunan struktur halaman, pengelompokan informasi program, sampai cara menyajikan galeri kegiatan dengan ringan diakses dari HP.",
    ],
  },
  {
    slug: "small-team-workflow",
    title: "Workflow Tim Kecil untuk Menyelesaikan Project Teknologi",
    excerpt: "Catatan ringan tentang bagaimana tim kecil kami membagi peran, menjaga komunikasi, dan merapikan dokumentasi project.",
    tag: "Team Notes",
    content: [
      "Sebagai tim kecil, kami harus sangat sadar dengan kapasitas dan waktu yang tersedia. Itu artinya, workflow dan dokumentasi bukan cuma formalitas, tapi jadi alat bantu utama agar semua orang tetap on-track.",
      "Kami membagi project menjadi blok kerja kecil, menentukan PIC dengan jelas, dan memastikan semua keputusan penting tercatat di satu tempat yang mudah diakses.",
    ],
  },
];
