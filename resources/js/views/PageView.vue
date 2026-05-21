<template>
  <section class="section-padding">
    <div class="container">
      <div class="text-center mb-5">
        <h1>{{ page.title }}</h1>
        <p class="text-muted">{{ page.subtitle }}</p>
      </div>

      <div v-if="page.sections.length">
        <div v-for="(section, index) in page.sections" :key="index" class="mb-5">
          <h3>{{ section.heading }}</h3>
          <p>{{ section.content }}</p>
        </div>
      </div>

      <div v-if="page.cards?.length" class="row g-4">
        <div class="col-md-4" v-for="card in page.cards" :key="card.title">
          <div class="card p-4 h-100 shadow-sm border-0">
            <h5>{{ card.title }}</h5>
            <p class="text-muted">{{ card.description }}</p>
          </div>
        </div>
      </div>

      <div v-if="page.list?.length" class="mt-4">
        <ul class="list-group">
          <li class="list-group-item" v-for="item in page.list" :key="item.title">
            <strong>{{ item.title }}</strong>
            <p class="mb-0 text-muted">{{ item.description }}</p>
          </li>
        </ul>
      </div>

      <div v-if="page.action" class="text-center mt-5">
        <router-link :to="page.action.link" class="btn btn-primary btn-lg">{{ page.action.label }}</router-link>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: {
    slug: {
      type: String,
      default: ''
    },
    id: {
      type: String,
      default: ''
    }
  },
  computed: {
    routeName() {
      return this.$route.name;
    },
    page() {
      const pages = {
        about: {
          title: 'Tentang Kami',
          subtitle: 'Kami membangun solusi digital yang berfokus pada bisnis Anda.',
          sections: [
            { heading: 'Visi Kami', content: 'Menciptakan pengalaman digital yang modern, cepat, dan mudah digunakan.' },
            { heading: 'Misi Kami', content: 'Memberi kemudahan pengelolaan konten dan layanan dengan desain yang responsif.' }
          ],
          cards: [
            { title: 'Tim Profesional', description: 'Tenaga ahli frontend, backend, dan desain UI/UX.' },
            { title: 'Pendekatan Terukur', description: 'Solusi digital yang dikembangkan berdasarkan kebutuhan nyata.' },
            { title: 'Dukungan Penuh', description: 'Bantuan teknis berkelanjutan untuk setiap pengguna.' }
          ]
        },
        services: {
          title: 'Layanan Kami',
          subtitle: 'Solusi web, manajemen data, dan integrasi modern untuk bisnis Anda.',
          cards: [
            { title: 'Website Bisnis', description: 'Desain responsif dan performa tinggi untuk brand Anda.' },
            { title: 'Sistem Informasi', description: 'Aplikasi internal untuk operasional yang lebih efisien.' },
            { title: 'Integrasi Data', description: 'Konektivitas antar sistem dengan API modern.' }
          ]
        },
        clients: {
          title: 'Klien Kami',
          subtitle: 'Partner yang telah mempercayakan transformasi digitalnya kepada kami.',
          list: [
            { title: 'Rumah Sakit A', description: 'Sistem manajemen pasien dan jadwal rawat inap.' },
            { title: 'Klinik B', description: 'Portal layanan online dan booking janji temu.' },
            { title: 'Laboratorium C', description: 'Dashboard laporan dan integrasi data pemeriksaan.' }
          ]
        },
        team: {
          title: 'Tim Kami',
          subtitle: 'Profesional yang bekerja bersama untuk hasil digital terbaik.',
          list: [
            { title: 'Developer', description: 'Membangun aplikasi dengan teknologi modern.' },
            { title: 'Desainer', description: 'Mendesain antarmuka menarik dan mudah digunakan.' },
            { title: 'Project Manager', description: 'Mengawal proyek agar berjalan sesuai target.' }
          ]
        },
        blog: {
          title: 'Blog',
          subtitle: 'Insight terbaru tentang teknologi dan layanan kesehatan.',
          list: [
            { title: 'Transformasi Digital di Kesehatan', description: 'Pelajari bagaimana teknologi mengubah layanan kesehatan.' },
            { title: 'Keamanan Data Pasien', description: 'Pentingnya proteksi data di era digital.' },
            { title: 'Tren UX untuk Web Bisnis', description: 'Desain yang membuat pengalaman pengguna lebih nyaman.' }
          ],
          action: { label: 'Kontak Kami untuk Info Lebih', link: '/contact' }
        },
        faq: {
          title: 'FAQ',
          subtitle: 'Pertanyaan yang sering diajukan oleh pengguna.',
          list: [
            { title: 'Bagaimana cara memulai?', description: 'Hubungi tim kami melalui halaman kontak.' },
            { title: 'Apakah bisa integrasi dengan sistem lama?', description: 'Ya, kami menyediakan layanan integrasi sistem legacy.' },
            { title: 'Berapa lama waktu pengembangan?', description: 'Durasi tergantung kompleksitas proyek.' }
          ]
        },
        products: {
          title: 'Produk & Solusi',
          subtitle: 'Pilih solusi yang cocok untuk kebutuhan bisnis Anda.',
          cards: [
            { title: 'Sistem Informasi Klinik', description: 'Kelola pasien, jadwal, dan pemeriksaan dengan mudah.' },
            { title: 'Portal Layanan', description: 'Web portal dengan akses cepat untuk pelanggan.' },
            { title: 'Sistem Manajemen Data', description: 'Analitik dan pelaporan bisnis dalam satu platform.' }
          ]
        },
        privacy: {
          title: 'Kebijakan Privasi',
          subtitle: 'Kami menghargai privasi data Anda.',
          sections: [
            { heading: 'Pengumpulan Data', content: 'Kami mengumpulkan data untuk meningkatkan layanan dan keamanan.' },
            { heading: 'Penggunaan Data', content: 'Data digunakan hanya untuk tujuan yang telah disetujui.' }
          ]
        },
        terms: {
          title: 'Syarat & Ketentuan',
          subtitle: 'Ketentuan penggunaan layanan kami.',
          sections: [
            { heading: 'Kepatuhan', content: 'Dengan menggunakan layanan, Anda menyetujui ketentuan ini.' },
            { heading: 'Pembatasan', content: 'Penggunaan layanan tidak boleh disalahgunakan.' }
          ]
        }
      };

      if (this.routeName === 'blog-detail') {
        return {
          title: `Blog - ${this.$route.params.slug}`,
          subtitle: 'Detail artikel sedang ditampilkan.',
          sections: [
            { heading: 'Ringkasan', content: 'Konten artikel akan ditampilkan di sini.' }
          ]
        };
      }

      if (this.routeName === 'product-detail') {
        return {
          title: `Produk #${this.$route.params.id}`,
          subtitle: 'Informasi produk dan detail fitur.',
          sections: [
            { heading: 'Deskripsi Singkat', content: 'Detail produk dapat dilihat di halaman ini.' }
          ]
        };
      }

      if (this.routeName === 'privacy-policy') {
        return pages.privacy;
      }

      if (this.routeName === 'terms-of-service') {
        return pages.terms;
      }

      return pages[this.routeName] || {
        title: 'Halaman Tidak Ditemukan',
        subtitle: 'Halaman ini belum tersedia dalam SPA.',
        sections: []
      };
    }
  }
};
</script>

<style>
.section-padding {
  padding: 80px 0;
}
.card {
  border: none;
}
</style>
