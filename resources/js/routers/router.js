import { createRouter, createWebHistory } from 'vue-router'

import Home from '../pages/Home.vue'
import Login from '../pages/Login.vue'
import Create from '../pages/Create.vue'
const Edit =( ) => import('../pages/Edit.vue')

const routes = [
    {
        path: '/home',
        name: 'Home',
        component: Home,
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/create',
        name: 'Create',
        component: Create
    },
    {
        path: '/users/:id/edit',
        name: 'Edit',
        component: Edit
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})


export default router;
