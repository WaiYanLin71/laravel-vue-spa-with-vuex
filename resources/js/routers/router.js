import { createRouter, createWebHistory } from 'vue-router'


import Home from '../pages/Home.vue'
import Login from '../pages/Login.vue'
import Create from '../pages/Create.vue'
import Edit from '../pages/Edit.vue'
import Search from '../pages/Search.vue'

const routes = [
    {
        path: '/users',
        name: 'home',
        component: Home,
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/create',
        name: 'Create',
        component: Create
    },
    {
        path: '/users/:id(\\d+)/edit',
        name: 'Edit',
        component: Edit,
    },
    {
        path: '/users/:search',
        name: 'search',
        component: Search,
    },
    {
        name: '/',
        redirect: { name: 'home' }
    },
    ,
    {
        path: '/:pathMatch(.*)*',
        name: '404',
        component: Login
    }

]

const router = createRouter({
    history: createWebHistory(),
    routes,
})


export default router;
