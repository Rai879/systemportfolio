<template>
  <section class="hero-section py-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <h1 class="display-5 fw-bold">Selamat datang di {{ siteName }}</h1>
          <p class="lead text-secondary">Sistem SPA keren dengan Vue yang berjalan penuh di dalam aplikasi CodeIgniter.</p>
          <div class="d-flex gap-2 flex-wrap mt-4">
            <router-link to="/services" class="btn btn-primary btn-lg">Lihat Layanan</router-link>
            <router-link to="/about" class="btn btn-outline-primary btn-lg">Tentang Kami</router-link>
          </div>
        </div>
        <div class="col-lg-6 text-center mt-4 mt-lg-0">
          <div class="hero-box p-4 rounded-4 shadow-sm bg-white">
            <h3 class="mb-3">Solusi digital modern</h3>
            <p class="mb-0">Kelola konten, produk, dan pelanggan dengan tampilan yang lebih cepat dan interaktif.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section-padding bg-light">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="section-title">Kenapa Pilih Kami?</h2>
        <p class="section-subtitle">Desain modern, navigasi cepat, dan halaman tanpa reload.</p>
      </div>
      <div class="row g-4">
        <div class="col-md-4" v-for="item in features" :key="item.title">
          <div class="card feature-card h-100 p-4 border-0 shadow-sm">
            <div class="feature-icon mb-3">{{ item.icon }}</div>
            <h5>{{ item.title }}</h5>
            <p class="text-muted">{{ item.description }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      siteName: window.__SITE_SETTINGS__?.site_name || 'System879',
      features: [
        { title: 'Navigasi Cepat', description: 'Semua halaman dimuat tanpa reload penuh.', icon: '🚀' },
        { title: 'Vue + Router', description: 'SPA penuh menggunakan Vue Router untuk pengalaman smooth.', icon: '📱' },
        { title: 'Integrasi Modern', description: 'Tampilan lebih modern dan dinamis untuk website anda.', icon: '✨' }
      ]
    };
  }
};
</script>

<style>
.hero-section {
  min-height: calc(100vh - 140px);
  display: flex;
  align-items: center;
}
.hero-box {
  border: 1px solid rgba(13, 110, 253, 0.12);
}
.section-title {
  font-weight: 700;
}
.section-subtitle {
  color: #6c757d;
}
.feature-card {
  background: #fff;
}
.feature-icon {
  font-size: 2rem;
}
</style>
