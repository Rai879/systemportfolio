<template>
  <div class="app-shell">
    <!-- Ambient Animated Background -->
    <div class="ambient-background">
      <div class="blob blob-1"></div>
      <div class="blob blob-2"></div>
      <div class="blob blob-3"></div>
      
      <!-- Tech Nodes SVG -->
      <svg class="tech-node node-1" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="1.5">
        <circle cx="50" cy="50" r="40" stroke-dasharray="4 4" />
        <circle cx="50" cy="50" r="20" />
        <line x1="50" y1="10" x2="50" y2="30" />
        <line x1="50" y1="70" x2="50" y2="90" />
        <line x1="10" y1="50" x2="30" y2="50" />
        <line x1="70" y1="50" x2="90" y2="50" />
      </svg>
      
      <svg class="tech-node node-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
        <path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"></path>
      </svg>
      
      <svg class="tech-node node-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="16 18 22 12 16 6"></polyline>
        <polyline points="8 6 2 12 8 18"></polyline>
      </svg>
    </div>

    <header class="site-header" :class="{ 'scrolled': isScrolled, 'hidden-on-top': isHomePage && !isScrolled }">
      <div class="nav-container">
        <div class="brand">
          <router-link to="/" class="brand-link">
            <img v-if="logoUrl" :src="logoUrl" alt="Logo" class="brand-logo" />
            <span v-else class="brand-text">{{ siteName }}</span>
          </router-link>
        </div>

        <nav class="nav-links desktop-nav">
          <router-link to="/about" class="nav-link">About</router-link>
          <router-link to="/services" class="nav-link">Services</router-link>
          <router-link to="/products" class="nav-link">Products</router-link>
          <router-link to="/blog" class="nav-link">Blog</router-link>
          <router-link to="/contact" class="nav-link">Contact</router-link>
          <div class="nav-item">
            <a :href="(baseUrl || '/system879/') + 'admin/login'" class="nav-link admin-link">Login</a>
          </div>
        </nav>

        <button class="mobile-toggle" @click="toggleMobileMenu" aria-label="Toggle Menu">
          <div class="hamburger" :class="{ 'is-active': mobileMenuOpen }">
            <span></span>
            <span></span>
          </div>
        </button>
      </div>

      <transition name="fade-slide">
        <div v-if="mobileMenuOpen" class="mobile-nav">
          <router-link to="/about" class="mobile-link" @click="toggleMobileMenu">About</router-link>
          <router-link to="/services" class="mobile-link" @click="toggleMobileMenu">Services</router-link>
          <router-link to="/products" class="mobile-link" @click="toggleMobileMenu">Products</router-link>
          <router-link to="/blog" class="mobile-link" @click="toggleMobileMenu">Blog</router-link>
          <router-link to="/contact" class="mobile-link" @click="toggleMobileMenu">Contact</router-link>
          <a :href="(baseUrl || '/system879/') + 'admin/login'" class="mobile-link admin-link" @click="toggleMobileMenu">Login</a>
        </div>
      </transition>
    </header>

    <main class="app-content">
      <router-view />
    </main>

    <footer class="site-footer">
      <div class="footer-container">
        <div class="footer-grid">
          <div class="footer-col brand-col">
            <h5 class="footer-title">{{ siteName }}</h5>
            <p class="footer-text">Premium solutions for modern healthcare and professional services, crafted with precision and care.</p>
          </div>
          <div class="footer-col">
            <h5 class="footer-title">Explore</h5>
            <ul class="footer-links">
              <li><router-link to="/about">About Us</router-link></li>
              <li><router-link to="/services">Services</router-link></li>
              <li><router-link to="/products">Products</router-link></li>
              <li><router-link to="/blog">Blog</router-link></li>
            </ul>
          </div>
          <div class="footer-col">
            <h5 class="footer-title">Contact</h5>
            <ul class="footer-links">
              <li><a href="mailto:info@system879.local">info@system879.local</a></li>
              <li><a href="tel:+622112345678">+62 21 1234 5678</a></li>
            </ul>
          </div>
          <div class="footer-col">
            <h5 class="footer-title">Legal</h5>
            <ul class="footer-links">
              <li><router-link to="/privacy-policy">Privacy Policy</router-link></li>
              <li><router-link to="/terms-of-service">Terms of Service</router-link></li>
            </ul>
          </div>
        </div>
        <div class="footer-bottom">
          <div class="footer-bottom-content">
            <p>&copy; {{ new Date().getFullYear() }} {{ siteName }}. All rights reserved.</p>
            <div class="social-links">
              <a href="#" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
export default {
  data() {
    return {
      mobileMenuOpen: false,
      isScrolled: false,
      siteName: window.__SITE_SETTINGS__?.site_name || 'System879',
      logoUrl: window.__SITE_SETTINGS__?.logo_url || null,
      baseUrl: window.__BASE_URL__ || '/system879/'
    };
  },
  mounted() {
    window.addEventListener('scroll', this.handleScroll);
    document.addEventListener('mouseover', this.handleHoverPrefetch);
  },
  beforeUnmount() {
    window.removeEventListener('scroll', this.handleScroll);
    document.removeEventListener('mouseover', this.handleHoverPrefetch);
  },
  methods: {
    toggleMobileMenu() {
      this.mobileMenuOpen = !this.mobileMenuOpen;
      if (this.mobileMenuOpen) {
        document.body.style.overflow = 'hidden';
      } else {
        document.body.style.overflow = '';
      }
    },
    handleScroll() {
      // If on home page, wait until scrolled past hero section (100vh - 80px)
      if (this.isHomePage) {
        this.isScrolled = window.scrollY > (window.innerHeight - 80);
      } else {
        this.isScrolled = window.scrollY > 20;
      }
    },
    handleHoverPrefetch(e) {
      const link = e.target.closest('a');
      if (!link || !link.href) return;
      
      const currentHost = window.location.origin;
      if (!link.href.startsWith(currentHost)) return;

      let relative = link.href.replace(currentHost, '');
      if (relative.startsWith(this.baseUrl)) {
        relative = relative.replace(this.baseUrl, '/');
      } else if (relative.startsWith('/system879/')) {
        relative = relative.replace('/system879/', '/');
      }

      // Ignore admin links and API links
      if (relative.startsWith('/admin') || relative.startsWith('/legacy') || relative.startsWith('/api')) return;

      const path = relative.replace(/^\//, '');
      const endpoint = path ? `${this.baseUrl}api/content/${encodeURIComponent(path)}` : `${this.baseUrl}api/content`;

      if (!window.__legacyPageCache) window.__legacyPageCache = {};
      
      if (!window.__legacyPageCache[endpoint] && !link.dataset.prefetched) {
        link.dataset.prefetched = 'true';
        fetch(endpoint, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } })
          .then(res => res.json())
          .then(data => {
            if(data && data.html) {
                window.__legacyPageCache[endpoint] = data.html;
            }
          }).catch(() => {});
      }
    }
  },
  computed: {
    isHomePage() {
      return this.$route.path === '/';
    }
  },
  watch: {
    $route() {
      if (this.mobileMenuOpen) {
        this.toggleMobileMenu();
      }
    }
  }
};
</script>

<style>
/* Global Resets for Public Pages to ensure 100% width and premium feel */
body, html {
  margin: 0;
  padding: 0;
  width: 100%;
  overflow-x: hidden;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  background-color: #fbfbfd;
  color: #1d1d1f;
}

* {
  box-sizing: border-box;
}

a {
  text-decoration: none;
  color: inherit;
}
</style>

<style scoped>
.app-shell {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  position: relative;
  z-index: 1;
}

/* Ambient Background Animations */
.ambient-background {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  z-index: -1;
  overflow: hidden;
  pointer-events: none;
}

.blob {
  position: absolute;
  border-radius: 50%;
  filter: blur(80px);
  opacity: 0.35;
  animation: float-blob 20s infinite alternate ease-in-out;
}

.blob-1 {
  width: 50vw;
  height: 50vw;
  background: radial-gradient(circle, rgba(0,113,227,0.8) 0%, rgba(0,113,227,0) 70%);
  top: -10%;
  left: -10%;
  animation-duration: 25s;
}

.blob-2 {
  width: 40vw;
  height: 40vw;
  background: radial-gradient(circle, rgba(139,92,246,0.7) 0%, rgba(139,92,246,0) 70%);
  bottom: -20%;
  right: -10%;
  animation-duration: 28s;
  animation-delay: -5s;
}

.blob-3 {
  width: 35vw;
  height: 35vw;
  background: radial-gradient(circle, rgba(45,212,191,0.6) 0%, rgba(45,212,191,0) 70%);
  top: 30%;
  left: 40%;
  animation-duration: 22s;
  animation-delay: -12s;
}

@keyframes float-blob {
  0% { transform: translate(0, 0) scale(1); }
  33% { transform: translate(5%, 8%) scale(1.1); }
  66% { transform: translate(-4%, 4%) scale(0.9); }
  100% { transform: translate(8%, -4%) scale(1.05); }
}

.tech-node {
  position: absolute;
  color: #1d1d1f;
  opacity: 0.05;
  animation: float-node 30s infinite linear;
}

.node-1 {
  width: 35vw;
  height: 35vw;
  top: 15%;
  right: 5%;
}

.node-2 {
  width: 20vw;
  height: 20vw;
  bottom: 10%;
  left: 10%;
  animation-direction: reverse;
  animation-duration: 40s;
}

.node-3 {
  width: 15vw;
  height: 15vw;
  top: 40%;
  left: 45%;
  animation-duration: 35s;
}

@keyframes float-node {
  0% { transform: translateY(0) rotate(0deg); }
  50% { transform: translateY(-40px) rotate(180deg); }
  100% { transform: translateY(0) rotate(360deg); }
}

/* Glassmorphism Header */
.site-header {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 1000;
  background: rgba(255, 255, 255, 0.35);
  backdrop-filter: saturate(180%) blur(16px);
  -webkit-backdrop-filter: saturate(180%) blur(16px);
  border-bottom: 1px solid rgba(255, 255, 255, 0.4);
  box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
  transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
}

.site-header.hidden-on-top {
  transform: translateY(-100%);
  opacity: 0;
  pointer-events: none;
}

.site-header.scrolled {
  background: rgba(255, 255, 255, 0.65);
  backdrop-filter: saturate(200%) blur(24px);
  -webkit-backdrop-filter: saturate(200%) blur(24px);
  border-bottom: 1px solid rgba(255, 255, 255, 0.6);
  box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
}

.nav-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1.5rem;
  height: 60px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.brand-link {
  display: flex;
  align-items: center;
  gap: 8px;
}

.brand-logo {
  height: 28px;
  width: auto;
}

.brand-text {
  font-size: 1.25rem;
  font-weight: 600;
  letter-spacing: -0.02em;
}

.desktop-nav {
  display: none;
  align-items: center;
  gap: 2rem;
}

@media (min-width: 768px) {
  .desktop-nav {
    display: flex;
  }
}

.nav-link {
  font-size: 0.85rem;
  font-weight: 400;
  color: rgba(0, 0, 0, 0.8);
  letter-spacing: -0.01em;
  transition: color 0.2s ease;
}

.nav-link:hover, .router-link-active {
  color: #000;
}

.admin-link {
  background: #000;
  color: #fff !important;
  padding: 0.4rem 1rem;
  border-radius: 20px;
  font-weight: 500;
  transition: transform 0.2s ease, background 0.2s ease;
}

.admin-link:hover {
  background: #333;
  transform: scale(1.05);
}

/* Mobile Toggle */
.mobile-toggle {
  display: block;
  background: none;
  border: none;
  cursor: pointer;
  padding: 8px;
  z-index: 1001;
}

@media (min-width: 768px) {
  .mobile-toggle {
    display: none;
  }
}

.hamburger {
  width: 20px;
  height: 14px;
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.hamburger span {
  display: block;
  height: 1.5px;
  width: 100%;
  background-color: #1d1d1f;
  transition: all 0.3s ease;
  transform-origin: center;
}

.hamburger.is-active span:nth-child(1) {
  transform: translateY(6.25px) rotate(45deg);
}

.hamburger.is-active span:nth-child(2) {
  transform: translateY(-6.25px) rotate(-45deg);
}

/* Mobile Nav Dropdown */
.mobile-nav {
  position: absolute;
  top: 60px;
  left: 0;
  right: 0;
  height: calc(100vh - 60px);
  background: rgba(255, 255, 255, 0.85);
  backdrop-filter: saturate(180%) blur(20px);
  -webkit-backdrop-filter: saturate(180%) blur(20px);
  padding: 2rem 1.5rem;
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
  overflow-y: auto;
}

.mobile-link {
  font-size: 1.5rem;
  font-weight: 500;
  border-bottom: 1px solid rgba(0, 0, 0, 0.05);
  padding-bottom: 1rem;
  color: #1d1d1f;
}

.fade-slide-enter-active, .fade-slide-leave-active {
  transition: all 0.3s ease;
}
.fade-slide-enter-from, .fade-slide-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}

/* Content */
.app-content {
  flex: 1;
  padding-top: 60px; /* Offset for fixed header */
  width: 100%;
}

/* Apple-style Footer */
.site-footer {
  background-color: #f5f5f7;
  color: #1d1d1f;
  padding: 4rem 0 2rem;
  border-top: 1px solid #d2d2d7;
  font-size: 0.75rem;
}

.footer-container {
  max-width: 1000px;
  margin: 0 auto;
  padding: 0 1.5rem;
}

.footer-grid {
  display: grid;
  grid-template-columns: repeat(1, 1fr);
  gap: 2rem;
  margin-bottom: 3rem;
}

@media (min-width: 576px) {
  .footer-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (min-width: 992px) {
  .footer-grid {
    grid-template-columns: 2fr 1fr 1fr 1fr;
  }
}

.brand-col p {
  color: #86868b;
  line-height: 1.6;
  margin-top: 0.5rem;
  max-width: 250px;
}

.footer-title {
  font-size: 0.75rem;
  font-weight: 600;
  margin-bottom: 0.8rem;
  color: #1d1d1f;
}

.footer-links {
  list-style: none;
  padding: 0;
  margin: 0;
}

.footer-links li {
  margin-bottom: 0.5rem;
}

.footer-links a {
  color: #424245;
  transition: color 0.2s ease;
}

.footer-links a:hover {
  color: #000;
  text-decoration: underline;
}

.footer-bottom {
  border-top: 1px solid #d2d2d7;
  padding-top: 1rem;
}

.footer-bottom-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 1rem;
  color: #86868b;
}

@media (min-width: 768px) {
  .footer-bottom-content {
    flex-direction: row;
    justify-content: space-between;
  }
}

.social-links {
  display: flex;
  gap: 1rem;
}

.social-links a {
  color: #424245;
  font-size: 1.1rem;
  transition: color 0.2s ease;
}

.social-links a:hover {
  color: #000;
}
</style>
