import { createRouter, createWebHistory } from 'vue-router';
import PublicLayout from './layouts/PublicLayout.vue';
import AdminLayout from './layouts/AdminLayout.vue';

// Public Views
import HomeView from './views/public/HomeView.vue';
import LegacyPageView from './views/LegacyPageView.vue';
import NotFoundView from './views/NotFoundView.vue';

// Admin Views removed, now handled by legacy CodeIgniter

const routes = [
  // --- PUBLIC ROUTES ---
  {
    path: '/',
    component: PublicLayout,
    children: [
      { path: '', name: 'home', component: HomeView },
      { path: 'about', name: 'about', component: LegacyPageView },
      { path: 'services', name: 'services', component: LegacyPageView },
      { path: 'clients', name: 'clients', component: LegacyPageView },
      { path: 'team', name: 'team', component: LegacyPageView },
      { path: 'blog', name: 'blog', component: LegacyPageView },
      { path: 'blog/:slug', name: 'blog-detail', component: LegacyPageView, props: true },
      { path: 'blog/category/:slug', name: 'blog-category', component: LegacyPageView, props: true },
      { path: 'faq', name: 'faq', component: LegacyPageView },
      { path: 'contact', name: 'contact', component: LegacyPageView },
      { path: 'products', name: 'products', component: LegacyPageView },
      { path: 'products/:id', name: 'product-detail', component: LegacyPageView, props: true },
      { path: 'privacy-policy', name: 'privacy-policy', component: LegacyPageView },
      { path: 'terms-of-service', name: 'terms-of-service', component: LegacyPageView },
    ]
  },
  
  // --- ADMIN ROUTES REMOVED ---
  // Admin routes are now handled by CodeIgniter backend native views
  
  // --- CATCH ALL ---
  { path: '/:pathMatch(.*)*', name: 'not-found', component: NotFoundView }
];

const router = createRouter({
  history: createWebHistory('/system879/'),
  routes,
  scrollBehavior() {
    return { top: 0, behavior: 'smooth' };
  }
});

export default router;
