<template>
  <div class="admin-shell">
    <!-- Sidebar -->
    <aside class="sidebar" :class="{ 'sidebar-collapsed': isCollapsed }">
      <div class="sidebar-header">
        <router-link to="/admin/dashboard" class="sidebar-brand">
          <span class="brand-icon">⚡</span>
          <span class="brand-text" v-if="!isCollapsed">Admin Panel</span>
        </router-link>
      </div>

      <div class="sidebar-menu">
        <div class="menu-label" v-if="!isCollapsed">Menu Utama</div>
        <router-link to="/admin/dashboard" class="menu-item" title="Dashboard">
          <span class="menu-icon">📊</span>
          <span class="menu-text" v-if="!isCollapsed">Dashboard</span>
        </router-link>
        
        <div class="menu-label" v-if="!isCollapsed">Kelola Konten</div>
        <router-link to="/admin/blog" class="menu-item" title="Blog Posts">
          <span class="menu-icon">📝</span>
          <span class="menu-text" v-if="!isCollapsed">Blog Posts</span>
        </router-link>
        <router-link to="/admin/faq" class="menu-item" title="FAQ">
          <span class="menu-icon">❓</span>
          <span class="menu-text" v-if="!isCollapsed">FAQ</span>
        </router-link>
        
        <div class="menu-label" v-if="!isCollapsed">Pengaturan</div>
        <router-link to="/admin/users" class="menu-item" title="Users">
          <span class="menu-icon">👥</span>
          <span class="menu-text" v-if="!isCollapsed">Users</span>
        </router-link>
        <router-link to="/admin/settings" class="menu-item" title="Settings">
          <span class="menu-icon">⚙️</span>
          <span class="menu-text" v-if="!isCollapsed">Settings</span>
        </router-link>
      </div>
      
      <div class="sidebar-footer">
        <button class="menu-item text-danger" @click="logout" title="Logout">
          <span class="menu-icon">🚪</span>
          <span class="menu-text" v-if="!isCollapsed">Logout</span>
        </button>
      </div>
    </aside>

    <!-- Main Content -->
    <div class="admin-main">
      <header class="admin-header">
        <button class="toggle-btn" @click="toggleSidebar">
          ☰
        </button>
        <div class="header-right">
          <div class="user-profile">
            <div class="avatar">A</div>
            <span>Admin User</span>
          </div>
        </div>
      </header>

      <main class="admin-content">
        <router-view />
      </main>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isCollapsed: false,
    };
  },
  methods: {
    toggleSidebar() {
      this.isCollapsed = !this.isCollapsed;
    },
    async logout() {
      try {
        const baseUrl = window.__BASE_URL__ || '/system879/';
        const endpoint = `${baseUrl}api/admin/logout`.replace('//api', '/api');
        await fetch(endpoint, { method: 'POST' });
        this.$router.push('/admin/login');
      } catch (e) {
        console.error(e);
        this.$router.push('/admin/login');
      }
    }
  }
};
</script>

<style scoped>
.admin-shell {
  display: flex;
  height: 100vh;
  font-family: 'Inter', sans-serif;
  background-color: #f1f5f9;
  color: #334155;
  overflow: hidden;
}

/* Sidebar */
.sidebar {
  width: 260px;
  background-color: #0f172a;
  color: #f8fafc;
  display: flex;
  flex-direction: column;
  transition: width 0.3s ease;
  flex-shrink: 0;
}
.sidebar-collapsed {
  width: 70px;
}
.sidebar-header {
  height: 64px;
  display: flex;
  align-items: center;
  padding: 0 1.25rem;
  border-bottom: 1px solid #1e293b;
}
.sidebar-brand {
  display: flex;
  align-items: center;
  text-decoration: none;
  color: #fff;
  font-weight: 700;
  font-size: 1.25rem;
}
.brand-icon {
  margin-right: 0.75rem;
  font-size: 1.5rem;
}
.sidebar-collapsed .brand-icon {
  margin-right: 0;
}
.sidebar-menu {
  flex: 1;
  padding: 1.5rem 0;
  overflow-y: auto;
}
.menu-label {
  padding: 0 1.5rem;
  font-size: 0.75rem;
  font-weight: 600;
  color: #64748b;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin-bottom: 0.5rem;
  margin-top: 1rem;
}
.menu-item {
  display: flex;
  align-items: center;
  padding: 0.75rem 1.5rem;
  color: #cbd5e1;
  text-decoration: none;
  transition: all 0.2s;
  background: none;
  border: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  font-size: 0.95rem;
}
.menu-item:hover, .menu-item.router-link-active {
  background-color: #1e293b;
  color: #fff;
  border-left: 4px solid #38bdf8;
}
.sidebar-collapsed .menu-item {
  justify-content: center;
  padding: 0.75rem 0;
  border-left: 4px solid transparent;
}
.menu-icon {
  font-size: 1.2rem;
  margin-right: 1rem;
}
.sidebar-collapsed .menu-icon {
  margin-right: 0;
}
.text-danger {
  color: #ef4444 !important;
}
.text-danger:hover {
  background-color: rgba(239, 68, 68, 0.1) !important;
  border-left-color: #ef4444 !important;
}
.sidebar-footer {
  padding: 1rem 0;
  border-top: 1px solid #1e293b;
}

/* Main */
.admin-main {
  flex: 1;
  display: flex;
  flex-direction: column;
  min-width: 0;
}
.admin-header {
  height: 64px;
  background-color: #fff;
  border-bottom: 1px solid #e2e8f0;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 1.5rem;
}
.toggle-btn {
  background: none;
  border: none;
  font-size: 1.5rem;
  color: #475569;
  cursor: pointer;
  padding: 0.25rem;
}
.header-right {
  display: flex;
  align-items: center;
}
.user-profile {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  font-weight: 500;
  font-size: 0.9rem;
}
.avatar {
  width: 36px;
  height: 36px;
  background-color: #38bdf8;
  color: #fff;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
}
.admin-content {
  flex: 1;
  padding: 2rem;
  overflow-y: auto;
}
</style>
