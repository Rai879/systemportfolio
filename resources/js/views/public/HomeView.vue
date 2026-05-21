<template>
  <div class="home-page">
    <!-- Loader -->
    <div v-if="loading" class="loader-container">
      <div class="spinner"></div>
    </div>

    <div v-else class="content-wrapper">
      
      <!-- HERO SECTION (Full Screen Carousel) -->
      <section class="hero-section" v-if="heroSlides && heroSlides.length > 0">
        <div class="hero-carousel">
          <transition-group name="fade" tag="div" class="carousel-inner">
            <div 
              v-for="(slide, index) in heroSlides" 
              :key="slide.id || index"
              class="hero-slide"
              v-show="currentSlide === index"
            >
              <div class="hero-content">
                <h2 class="hero-subtitle">{{ slide.subtitle || 'Welcome to' }}</h2>
                <h1 class="hero-title" v-html="formatTitle(slide.title)"></h1>
                <p class="hero-desc">{{ slide.description }}</p>
                <div class="hero-actions" v-if="slide.button_link">
                  <a :href="slide.button_link" class="btn-primary-apple">{{ slide.button_text || 'Learn More' }}</a>
                </div>
              </div>
              <div class="hero-image-wrapper">
                <img v-if="slide.image" :src="`${baseUrl}uploads/hero/${slide.image}`" class="hero-image" alt="Hero" />
              </div>
            </div>
          </transition-group>
        </div>
        
        <!-- Navigation Controls -->
        <div class="hero-controls" v-if="heroSlides.length > 1">
          <button class="ctrl-btn prev" @click="prevSlide" aria-label="Previous Slide">
            <i class="bi bi-chevron-left"></i>
          </button>
          <button class="ctrl-btn next" @click="nextSlide" aria-label="Next Slide">
            <i class="bi bi-chevron-right"></i>
          </button>
        </div>
        
        <!-- Indicators -->
        <div class="hero-indicators" v-if="heroSlides.length > 1">
          <button 
            v-for="(_, index) in heroSlides" 
            :key="'ind-'+index"
            class="indicator"
            :class="{ active: currentSlide === index }"
            @click="setSlide(index)"
            aria-label="Go to slide"
          ></button>
        </div>
      </section>

      <!-- FEATURES SECTION (Apple Grid Style) -->
      <section class="features-section" v-if="features && features.length > 0">
        <div class="section-header">
          <h2 class="section-title">Fitur Unggulan</h2>
          <p class="section-subtitle">Solusi lengkap yang dirancang khusus untuk kebutuhan sistem informasi Anda.</p>
        </div>
        
        <div class="features-grid">
          <div v-for="(feature, index) in features" :key="index" class="feature-card" :style="{ animationDelay: `${index * 0.1}s` }">
            <div class="feature-icon-wrapper" :class="`text-${feature.color}`">
              <i :class="`bi ${feature.icon}`"></i>
            </div>
            <h3 class="feature-title">{{ feature.title }}</h3>
            <p class="feature-desc">{{ feature.description }}</p>
          </div>
        </div>
      </section>

      <!-- STATISTICS SECTION (Dark Apple Style) -->
      <section class="stats-section" v-if="statistics && statistics.length > 0">
        <div class="stats-grid">
          <div v-for="(stat, index) in statistics" :key="index" class="stat-item">
            <h3 class="stat-value">{{ stat.value }}<span class="stat-plus">+</span></h3>
            <p class="stat-label">{{ stat.label }}</p>
          </div>
        </div>
      </section>

      <!-- LATEST BLOG POSTS SECTION -->
      <section class="blog-section" v-if="latestBlogPosts && latestBlogPosts.length > 0">
        <div class="section-header">
          <h2 class="section-title">Artikel Terbaru</h2>
          <p class="section-subtitle">Wawasan dan pembaruan seputar teknologi kesehatan terkini.</p>
        </div>

        <div class="blog-grid">
          <div v-for="post in latestBlogPosts" :key="post.id" class="blog-card">
            <div class="blog-image">
              <img v-if="post.featured_image" :src="`${baseUrl}uploads/blog/${post.featured_image}`" :alt="post.title" />
              <div v-else class="blog-image-placeholder"></div>
            </div>
            <div class="blog-content">
              <span class="blog-category">{{ post.category || 'Artikel' }}</span>
              <h3 class="blog-title">{{ post.title }}</h3>
              <p class="blog-excerpt">{{ post.excerpt }}</p>
              <router-link :to="`/blog/${post.slug}`" class="blog-link">Baca Selengkapnya <i class="bi bi-chevron-right"></i></router-link>
            </div>
          </div>
        </div>
        
        <div class="text-center mt-5">
          <router-link to="/blog" class="btn-secondary-apple">Lihat Semua Artikel</router-link>
        </div>
      </section>

    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loading: true,
      error: null,
      mounted: false,
      heroSlides: [],
      features: [],
      statistics: [],
      latestBlogPosts: [],
      baseUrl: window.__BASE_URL__ || '/system879/',
      currentSlide: 0,
      slideInterval: null
    };
  },
  async created() {
    await this.fetchData();
  },
  mounted() {
    setTimeout(() => {
      this.mounted = true;
    }, 100);
    this.startSlideShow();
  },
  beforeUnmount() {
    if (this.slideInterval) {
      clearInterval(this.slideInterval);
    }
  },
  methods: {
    async fetchData() {
      try {
        const response = await fetch(`${this.baseUrl}api/public/home`);
        if (!response.ok) throw new Error('Network response was not ok');
        const data = await response.json();
        
        this.heroSlides = data.heroSlides || [];
        this.features = data.features || [];
        this.statistics = data.statistics || [];
        this.latestBlogPosts = data.latestBlogPosts || [];
        
      } catch (err) {
        this.error = err.message;
        console.error("Failed to load home data:", err);
      } finally {
        this.loading = false;
      }
    },
    formatTitle(title) {
      if (!title) return '';
      return title.replace('Solution', '<span class="text-gradient">Solution</span>');
    },
    nextSlide() {
      if (this.heroSlides.length === 0) return;
      this.currentSlide = (this.currentSlide + 1) % this.heroSlides.length;
      this.resetSlideShow();
    },
    prevSlide() {
      if (this.heroSlides.length === 0) return;
      this.currentSlide = (this.currentSlide - 1 + this.heroSlides.length) % this.heroSlides.length;
      this.resetSlideShow();
    },
    setSlide(index) {
      this.currentSlide = index;
      this.resetSlideShow();
    },
    startSlideShow() {
      this.slideInterval = setInterval(() => {
        if (this.heroSlides.length > 1) {
          this.currentSlide = (this.currentSlide + 1) % this.heroSlides.length;
        }
      }, 5000); // 5 seconds per slide
    },
    resetSlideShow() {
      if (this.slideInterval) {
        clearInterval(this.slideInterval);
      }
      this.startSlideShow();
    }
  }
};
</script>

<style scoped>
.home-page {
  width: 100%;
  overflow-x: hidden;
}

.loader-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 60vh;
}

.spinner {
  width: 40px;
  height: 40px;
  border: 3px solid rgba(0, 0, 0, 0.1);
  border-radius: 50%;
  border-top-color: #000;
  animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

/* Typography & Utilities */
.text-gradient {
  background: linear-gradient(90deg, #2563eb, #8b5cf6);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.section-header {
  text-align: center;
  max-width: 700px;
  margin: 0 auto 4rem;
  padding: 0 1.5rem;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 700;
  letter-spacing: -0.02em;
  margin-bottom: 1rem;
}

.section-subtitle {
  font-size: 1.1rem;
  color: #86868b;
  line-height: 1.6;
}

.btn-primary-apple {
  display: inline-block;
  background-color: #0071e3;
  color: #fff;
  padding: 12px 24px;
  border-radius: 980px;
  font-size: 17px;
  font-weight: 400;
  letter-spacing: -0.02em;
  transition: all 0.3s ease;
}

.btn-primary-apple:hover {
  background-color: #0077ED;
  transform: scale(1.02);
}

.btn-secondary-apple {
  display: inline-block;
  background-color: transparent;
  color: #0071e3;
  border: 1px solid #0071e3;
  padding: 10px 22px;
  border-radius: 980px;
  font-size: 15px;
  font-weight: 400;
  transition: all 0.3s ease;
}

.btn-secondary-apple:hover {
  background-color: #0071e3;
  color: #fff;
}

.text-center { text-align: center; }
.mt-5 { margin-top: 3rem; }

/* HERO SECTION - FULL SCREEN */
.hero-section {
  position: relative;
  width: 100vw;
  height: 100vh;
  margin-left: calc(-50vw + 50%); /* Force full width breaking out of container */
  display: flex;
  overflow: hidden;
  background-color: transparent;
}

.hero-carousel {
  width: 100%;
  height: 100%;
  position: relative;
}

.carousel-inner {
  width: 100%;
  height: 100%;
  position: relative;
}

.hero-slide {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  padding: 0 1.5rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  max-width: 1200px;
  margin: 0 auto;
  left: 50%;
  transform: translateX(-50%);
}

@media (min-width: 992px) {
  .hero-slide {
    flex-direction: row;
    text-align: left;
    padding: 0 4rem;
    gap: 4rem;
  }
}

.hero-content {
  flex: 1;
  z-index: 2;
}

.hero-subtitle {
  font-size: 1.25rem;
  font-weight: 600;
  color: #86868b;
  margin-bottom: 0.5rem;
}

.hero-title {
  font-size: 3.5rem;
  line-height: 1.1;
  font-weight: 700;
  letter-spacing: -0.03em;
  margin-bottom: 1.5rem;
}

@media (min-width: 992px) {
  .hero-title { font-size: 4.5rem; }
}

.hero-desc {
  font-size: 1.25rem;
  line-height: 1.5;
  color: #86868b;
  margin-bottom: 2.5rem;
  max-width: 600px;
  margin-left: auto;
  margin-right: auto;
}

@media (min-width: 992px) {
  .hero-desc { margin-left: 0; margin-right: 0; }
}

.hero-image-wrapper {
  flex: 1;
  width: 100%;
  margin-top: 2rem;
  z-index: 2;
}

@media (min-width: 992px) {
  .hero-image-wrapper { margin-top: 0; }
}

.hero-image {
  width: 100%;
  max-width: 600px;
  max-height: 50vh;
  object-fit: contain;
  filter: drop-shadow(0 20px 40px rgba(0,0,0,0.1));
}

/* Transitions */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.8s ease, transform 0.8s ease;
}
.fade-enter-from {
  opacity: 0;
  transform: translateX(30px);
}
.fade-leave-to {
  opacity: 0;
  transform: translateX(-30px);
}

/* Controls */
.hero-controls {
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  transform: translateY(-50%);
  display: flex;
  justify-content: space-between;
  padding: 0 1rem;
  z-index: 10;
  pointer-events: none;
}
@media (min-width: 992px) {
  .hero-controls { padding: 0 2rem; }
}

.ctrl-btn {
  background: rgba(255, 255, 255, 0.5);
  backdrop-filter: blur(4px);
  border: none;
  width: 48px;
  height: 48px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  pointer-events: auto;
  font-size: 1.5rem;
  color: #1d1d1f;
  transition: all 0.3s ease;
  box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}
.ctrl-btn:hover {
  background: rgba(255, 255, 255, 0.9);
  transform: scale(1.1);
}

.hero-indicators {
  position: absolute;
  bottom: 2rem;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  gap: 12px;
  z-index: 10;
}

.indicator {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background: rgba(0, 0, 0, 0.2);
  border: none;
  cursor: pointer;
  padding: 0;
  transition: all 0.3s ease;
}

.indicator.active {
  background: #0071e3;
  transform: scale(1.3);
}

/* FEATURES SECTION */
.features-section {
  background-color: rgba(255, 255, 255, 0.4);
  backdrop-filter: blur(10px);
  padding: 8rem 1.5rem;
}

.features-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 2rem;
  max-width: 1200px;
  margin: 0 auto;
}

@media (min-width: 768px) {
  .features-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (min-width: 1024px) {
  .features-grid { grid-template-columns: repeat(3, 1fr); gap: 3rem; }
}

.feature-card {
  padding: 2.5rem;
  background-color: rgba(251, 251, 253, 0.7);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.6);
  border-radius: 24px;
  transition: transform 0.3s ease, background-color 0.3s ease;
}

.feature-card:hover {
  transform: translateY(-8px);
  background-color: rgba(255, 255, 255, 0.9);
}

.feature-icon-wrapper {
  font-size: 2.5rem;
  margin-bottom: 1.5rem;
  color: #0071e3;
}

.feature-title {
  font-size: 1.5rem;
  font-weight: 600;
  margin-bottom: 1rem;
  letter-spacing: -0.01em;
}

.feature-desc {
  font-size: 1rem;
  line-height: 1.5;
  color: #86868b;
}

/* STATS SECTION */
.stats-section {
  background-color: #000;
  color: #fff;
  padding: 6rem 1.5rem;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 3rem 1.5rem;
  max-width: 1000px;
  margin: 0 auto;
  text-align: center;
}

@media (min-width: 768px) {
  .stats-grid { grid-template-columns: repeat(4, 1fr); gap: 2rem; }
}

.stat-value {
  font-size: 3.5rem;
  font-weight: 700;
  letter-spacing: -0.04em;
  background: linear-gradient(180deg, #fff, #86868b);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  margin-bottom: 0.5rem;
}

.stat-plus {
  color: #0071e3;
  -webkit-text-fill-color: #0071e3;
}

.stat-label {
  font-size: 1rem;
  color: #86868b;
  font-weight: 500;
}

/* BLOG SECTION */
.blog-section {
  background-color: rgba(245, 245, 247, 0.4);
  backdrop-filter: blur(10px);
  padding: 8rem 1.5rem;
}

.blog-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 2rem;
  max-width: 1200px;
  margin: 0 auto;
}

@media (min-width: 768px) {
  .blog-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (min-width: 1024px) {
  .blog-grid { grid-template-columns: repeat(3, 1fr); }
}

.blog-card {
  background: rgba(255, 255, 255, 0.7);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.6);
  border-radius: 24px;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0,0,0,0.04);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  display: flex;
  flex-direction: column;
}

.blog-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 20px 40px rgba(0,0,0,0.08);
}

.blog-image {
  height: 220px;
  overflow: hidden;
}

.blog-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.blog-card:hover .blog-image img {
  transform: scale(1.05);
}

.blog-image-placeholder {
  width: 100%;
  height: 100%;
  background-color: #e5e5ea;
}

.blog-content {
  padding: 2rem;
  flex: 1;
  display: flex;
  flex-direction: column;
}

.blog-category {
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  color: #86868b;
  margin-bottom: 0.75rem;
}

.blog-title {
  font-size: 1.25rem;
  font-weight: 600;
  line-height: 1.3;
  margin-bottom: 1rem;
  letter-spacing: -0.01em;
}

.blog-excerpt {
  color: #86868b;
  font-size: 0.95rem;
  line-height: 1.5;
  margin-bottom: 1.5rem;
  flex: 1;
}

.blog-link {
  color: #0071e3;
  font-weight: 500;
  font-size: 0.95rem;
  display: inline-flex;
  align-items: center;
  gap: 4px;
}
.blog-link i { font-size: 0.8rem; }
.blog-link:hover { text-decoration: underline; }
</style>
