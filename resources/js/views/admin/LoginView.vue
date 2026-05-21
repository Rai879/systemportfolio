<template>
  <div class="login-wrapper">
    <div class="login-card">
      <div class="login-header">
        <img :src="logoUrl" alt="Logo" class="logo" v-if="logoUrl" />
        <h2>Admin Panel</h2>
        <p>Silakan login untuk melanjutkan</p>
      </div>
      
      <form @submit.prevent="handleLogin" class="login-form">
        <div v-if="errorMessage" class="alert alert-error">
          {{ errorMessage }}
        </div>
        
        <div class="form-group">
          <label for="username">Username</label>
          <input 
            type="text" 
            id="username" 
            v-model="form.username" 
            :class="{ 'is-invalid': errors.username }"
            placeholder="Masukkan username"
            required
          />
          <span v-if="errors.username" class="error-text">{{ errors.username }}</span>
        </div>
        
        <div class="form-group">
          <label for="password">Password</label>
          <input 
            type="password" 
            id="password" 
            v-model="form.password" 
            :class="{ 'is-invalid': errors.password }"
            placeholder="Masukkan password"
            required
          />
          <span v-if="errors.password" class="error-text">{{ errors.password }}</span>
        </div>
        
        <button type="submit" class="btn-login" :disabled="loading">
          <span v-if="loading">Memproses...</span>
          <span v-else>Login</span>
        </button>
      </form>
      
      <div class="login-footer">
        <router-link to="/">&larr; Kembali ke Beranda</router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        username: '',
        password: ''
      },
      loading: false,
      errorMessage: '',
      errors: {},
      logoUrl: window.__SITE_SETTINGS__?.logo_url || null
    };
  },
  methods: {
    async handleLogin() {
      this.loading = true;
      this.errorMessage = '';
      this.errors = {};
      
      try {
        const baseUrl = window.__BASE_URL__ || '/system879/';
        const endpoint = `${baseUrl}api/admin/login`.replace('//api', '/api'); // Prevent double slashes
        
        const response = await fetch(endpoint, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify(this.form)
        });
        
        const data = await response.json();
        
        if (response.ok && data.success) {
          // Redirect to dashboard
          this.$router.push('/admin/dashboard');
        } else {
          if (response.status === 422) {
            this.errors = data.errors || {};
            this.errorMessage = data.message || 'Harap periksa kembali form Anda.';
          } else {
            this.errorMessage = data.message || 'Terjadi kesalahan saat login.';
          }
        }
      } catch (e) {
        this.errorMessage = 'Gagal terhubung ke server.';
        console.error(e);
      } finally {
        this.loading = false;
      }
    }
  }
};
</script>

<style scoped>
.login-wrapper {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
  font-family: 'Inter', sans-serif;
  padding: 1rem;
}
.login-card {
  background: #ffffff;
  border-radius: 12px;
  box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 400px;
  padding: 2.5rem;
}
.login-header {
  text-align: center;
  margin-bottom: 2rem;
}
.logo {
  height: 48px;
  margin-bottom: 1rem;
}
.login-header h2 {
  margin: 0 0 0.5rem 0;
  color: #0f172a;
  font-weight: 700;
  font-size: 1.5rem;
}
.login-header p {
  margin: 0;
  color: #64748b;
  font-size: 0.95rem;
}
.alert-error {
  background-color: #fef2f2;
  color: #ef4444;
  padding: 0.75rem 1rem;
  border-radius: 6px;
  font-size: 0.9rem;
  margin-bottom: 1.5rem;
  border: 1px solid #fecaca;
}
.form-group {
  margin-bottom: 1.25rem;
}
.form-group label {
  display: block;
  margin-bottom: 0.5rem;
  color: #334155;
  font-weight: 500;
  font-size: 0.9rem;
}
.form-group input {
  width: 100%;
  padding: 0.75rem 1rem;
  border: 1px solid #cbd5e1;
  border-radius: 6px;
  font-size: 1rem;
  font-family: inherit;
  transition: all 0.2s ease;
  outline: none;
}
.form-group input:focus {
  border-color: #3b82f6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
}
.form-group input.is-invalid {
  border-color: #ef4444;
}
.error-text {
  display: block;
  color: #ef4444;
  font-size: 0.8rem;
  margin-top: 0.35rem;
}
.btn-login {
  width: 100%;
  padding: 0.875rem;
  background-color: #0f172a;
  color: #ffffff;
  border: none;
  border-radius: 6px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.2s ease;
  margin-top: 0.5rem;
}
.btn-login:hover:not(:disabled) {
  background-color: #1e293b;
}
.btn-login:disabled {
  background-color: #94a3b8;
  cursor: not-allowed;
}
.login-footer {
  margin-top: 2rem;
  text-align: center;
}
.login-footer a {
  color: #3b82f6;
  text-decoration: none;
  font-size: 0.9rem;
  font-weight: 500;
}
.login-footer a:hover {
  text-decoration: underline;
}
</style>
