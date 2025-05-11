import { createRouter, createWebHistory } from 'vue-router'
import BookingPortal from '../Views/BookingPortal.vue'
import AdminPortal from '../Views/AdminPortal.vue'
import Login from '../Views/Login.vue'


const routes = [
    {
        path: '/',
        name: 'BookingPortal',
        component: BookingPortal
    },
    {
        path: '/admin',
        name: 'Admin-Portal',
        component: AdminPortal
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    }
]

const router = createRouter({
    history: createWebHistory(''),
    routes
})

export default router;