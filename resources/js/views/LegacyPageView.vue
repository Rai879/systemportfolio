<template>
  <div class="legacy-page-wrapper">
    <div v-if="loading" class="text-center py-5">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>

    <div v-if="error" class="alert alert-danger container mt-5">
      {{ error }}
    </div>

    <div v-else ref="contentContainer" class="legacy-content" :class="{ 'is-fetching': fetching }" v-html="contentHtml"></div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loading: false,
      fetching: false,
      error: '',
      contentHtml: ''
    };
  },
  created() {
    if (!window.__legacyPageCache) {
      window.__legacyPageCache = {};
    }
  },
  watch: {
    '$route.fullPath': 'loadContent'
  },
  mounted() {
    this.loadContent();
  },
  updated() {
    this.attachInternalLinks();
    if (window.AOS) {
      setTimeout(() => {
        window.AOS.init({ duration: 800, once: true });
        window.AOS.refresh();
      }, 100);
    }
  },
  methods: {
    async loadContent() {
      const path = this.$route.path.replace(/^\//, '');
      const baseUrl = window.__BASE_URL__ || '/system879/';
      const endpoint = path ? `${baseUrl}api/content/${encodeURIComponent(path)}` : `${baseUrl}api/content`;

      // Gunakan cache jika ada untuk mempercepat perpindahan halaman
      if (window.__legacyPageCache && window.__legacyPageCache[endpoint]) {
        this.contentHtml = window.__legacyPageCache[endpoint];
        this.fetching = false;
        this.error = '';
        return;
      }

      this.fetching = true;
      this.error = '';
      
      try {
        const response = await fetch(endpoint, { 
          headers: { 
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
          } 
        });
        if (!response.ok) {
          throw new Error(`HTTP ${response.status}`);
        }
        const data = await response.json();
        this.contentHtml = data.html || '<div class="alert alert-warning">Konten tidak tersedia.</div>';
        
        // Simpan ke cache
        if (window.__legacyPageCache) {
          window.__legacyPageCache[endpoint] = this.contentHtml;
        }
      } catch (err) {
        this.error = 'Tidak dapat memuat halaman: ' + err.message;
      } finally {
        this.fetching = false;
      }
    },
    attachInternalLinks() {
      const container = this.$refs.contentContainer;
      if (!container) return;

      container.querySelectorAll('a').forEach(anchor => {
        const href = anchor.getAttribute('href');
        if (!href || anchor.target === '_blank') return;

        const currentHost = window.location.origin;
        const isInternal = href.startsWith('/') || href.startsWith(currentHost);
        if (!isInternal) return;

        let relative = href.replace(currentHost, '');
        if (relative.startsWith('/system879')) {
          relative = relative.replace('/system879', '');
        }

        if (relative.startsWith('/legacy') || relative.startsWith('/api/content')) return;

        anchor.dataset.spaBind = 'true';
        anchor.addEventListener('click', event => {
          event.preventDefault();
          this.$router.push(relative || '/');
        });
      });
    }
  }
};
</script>

<style>
.legacy-page-wrapper {
  width: 100%;
}
.legacy-content {
  min-height: 50vh;
  width: 100%;
  transition: opacity 0.3s ease;
}
.legacy-content.is-fetching {
  opacity: 0.5;
  pointer-events: none;
}
</style>
