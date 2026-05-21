<template>
  <div class="dashboard-wrapper">
    <div class="dashboard-header">
      <h2>Dashboard Overview</h2>
      <p>Welcome back to your admin panel.</p>
    </div>

    <div v-if="loading" class="loading-state">
      Memuat data...
    </div>

    <div v-else-if="error" class="error-state">
      {{ error }}
    </div>

    <div v-else class="dashboard-content">
      <!-- Stats Cards -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon bg-blue">
            <span class="icon">👥</span>
          </div>
          <div class="stat-details">
            <h3>{{ stats.totalUsers }}</h3>
            <p>Total Users</p>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon bg-green">
            <span class="icon">🏢</span>
          </div>
          <div class="stat-details">
            <h3>{{ stats.totalClients }}</h3>
            <p>Active Clients</p>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon bg-purple">
            <span class="icon">📝</span>
          </div>
          <div class="stat-details">
            <h3>{{ stats.totalBlogPosts }}</h3>
            <p>Blog Posts</p>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon bg-orange">
            <span class="icon">📦</span>
          </div>
          <div class="stat-details">
            <h3>{{ stats.totalProducts }}</h3>
            <p>Active Products</p>
          </div>
        </div>
      </div>

      <!-- Recent Posts Section -->
      <div class="content-section">
        <div class="section-header">
          <h3>Latest Blog Posts</h3>
          <router-link to="/admin/blog" class="btn btn-sm btn-outline">View All</router-link>
        </div>
        <div class="card">
          <table class="table">
            <thead>
              <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Created At</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="post in latestPosts" :key="post.id">
                <td>{{ post.title }}</td>
                <td>
                  <span class="badge" :class="post.status === 'published' ? 'badge-success' : 'badge-warning'">
                    {{ post.status }}
                  </span>
                </td>
                <td>{{ formatDate(post.created_at) }}</td>
              </tr>
              <tr v-if="latestPosts.length === 0">
                <td colspan="3" class="text-center">No posts found.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      stats: {
        totalUsers: 0,
        totalClients: 0,
        totalBlogPosts: 0,
        totalProducts: 0
      },
      latestPosts: [],
      loading: true,
      error: null
    };
  },
  async created() {
    await this.fetchDashboardData();
  },
  methods: {
    async fetchDashboardData() {
      this.loading = true;
      this.error = null;
      try {
        const baseUrl = window.__BASE_URL__ || '/system879/';
        const endpoint = `${baseUrl}api/admin/dashboard`.replace('//api', '/api');
        const response = await fetch(endpoint);
        
        // Handle unauthorized (session expired)
        if (response.status === 401 || response.status === 403 || response.redirected) {
          this.$router.push('/admin/login');
          return;
        }
        
        if (!response.ok) {
          throw new Error('Failed to fetch data');
        }
        
        const result = await response.json();
        if (result.success) {
          this.stats = result.data.stats;
          this.latestPosts = result.data.latestPosts;
        } else {
          this.error = result.message || 'Error loading dashboard.';
        }
      } catch (err) {
        this.error = 'Unable to connect to server.';
        console.error(err);
      } finally {
        this.loading = false;
      }
    },
    formatDate(dateString) {
      if (!dateString) return '-';
      const date = new Date(dateString);
      return new Intl.DateTimeFormat('id-ID', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
      }).format(date);
    }
  }
};
</script>

<style scoped>
.dashboard-wrapper {
  animation: fadeIn 0.3s ease;
}
.dashboard-header {
  margin-bottom: 2rem;
}
.dashboard-header h2 {
  font-size: 1.75rem;
  font-weight: 700;
  margin: 0 0 0.25rem 0;
}
.dashboard-header p {
  color: #64748b;
  margin: 0;
}

/* Stats Grid */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 1.5rem;
  margin-bottom: 2.5rem;
}
.stat-card {
  background: #ffffff;
  border-radius: 12px;
  padding: 1.5rem;
  display: flex;
  align-items: center;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
  transition: transform 0.2s ease;
}
.stat-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
}
.stat-icon {
  width: 56px;
  height: 56px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 1.25rem;
  font-size: 1.5rem;
}
.bg-blue { background-color: #e0f2fe; color: #0284c7; }
.bg-green { background-color: #dcfce7; color: #16a34a; }
.bg-purple { background-color: #f3e8ff; color: #9333ea; }
.bg-orange { background-color: #ffedd5; color: #ea580c; }

.stat-details h3 {
  margin: 0;
  font-size: 1.75rem;
  font-weight: 700;
  color: #0f172a;
}
.stat-details p {
  margin: 0;
  color: #64748b;
  font-size: 0.9rem;
  font-weight: 500;
}

/* Section */
.content-section {
  margin-bottom: 2rem;
}
.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}
.section-header h3 {
  margin: 0;
  font-size: 1.25rem;
}

/* Cards & Tables */
.card {
  background: #ffffff;
  border-radius: 12px;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
  overflow: hidden;
}
.table {
  width: 100%;
  border-collapse: collapse;
}
.table th, .table td {
  padding: 1rem 1.25rem;
  text-align: left;
  border-bottom: 1px solid #f1f5f9;
}
.table th {
  background-color: #f8fafc;
  font-weight: 600;
  color: #475569;
  font-size: 0.85rem;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}
.table td {
  color: #334155;
  font-size: 0.95rem;
}
.table tbody tr:last-child td {
  border-bottom: none;
}
.table tbody tr:hover {
  background-color: #f8fafc;
}

/* Buttons & Badges */
.btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 0.5rem 1rem;
  border-radius: 6px;
  font-weight: 500;
  cursor: pointer;
  text-decoration: none;
  transition: all 0.2s;
}
.btn-sm {
  padding: 0.25rem 0.75rem;
  font-size: 0.85rem;
}
.btn-outline {
  background: transparent;
  border: 1px solid #cbd5e1;
  color: #475569;
}
.btn-outline:hover {
  background: #f1f5f9;
  color: #0f172a;
}
.badge {
  padding: 0.25rem 0.6rem;
  border-radius: 9999px;
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
}
.badge-success { background-color: #dcfce7; color: #16a34a; }
.badge-warning { background-color: #fef9c3; color: #ca8a04; }
.text-center { text-align: center; }

/* States */
.loading-state, .error-state {
  padding: 3rem;
  text-align: center;
  background: #fff;
  border-radius: 12px;
  color: #64748b;
}
.error-state {
  color: #ef4444;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
