import {createRouter, createWebHistory} from 'vue-router';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component: () => import('./pages/property.vue')
        },
        {
            path: '/wishlist',
            component: () => import('./pages/wishlist.vue')
        }
    ],
})

export default router;