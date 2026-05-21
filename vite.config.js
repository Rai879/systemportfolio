const { defineConfig } = require('vite');
const vue = require('@vitejs/plugin-vue');

module.exports = defineConfig({
  base: '/system879/',
  plugins: [vue()],
  publicDir: false,
  build: {
    outDir: 'public/dist',
    emptyOutDir: true,
    assetsDir: 'assets',
    rollupOptions: {
      input: 'resources/js/app.js',
      output: {
        entryFileNames: 'assets/app.js',
        chunkFileNames: 'assets/[name].js',
        assetFileNames: 'assets/[name].[ext]'
      }
    }
  },
  server: {
    port: 5173,
    strictPort: true
  }
});
