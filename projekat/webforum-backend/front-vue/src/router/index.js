import { createRouter, createWebHistory } from "vue-router";

import HomePage from "../views/HomePage.vue";
import Register from "../views/Register.vue";
import Login from "../views/Login.vue";
import LoginAdmin from "../views/LoginAdmin.vue";
import navBar from "../components/navBar.vue";
import Auth from "../components/Auth.vue";

import store from "../store";

const routes = [
    {
        path: '/',
        redirect: '/homePage',
        component: navBar,
        meta: { requiresAuth: true },
        children: [

            { path: '/homePage', name: 'HomePage', component: HomePage },
        ]
    },


    {
        path: '/auth',
        redirect: '/login',

        name: 'Auth',
        component: Auth,
        meta: { isGuest: true },

        children: [{
            path: '/login',
            name: 'Login',
            component: Login
        },
        {
            path: '/register',
            name: 'Register',
            component: Register
        },
        {
            path: '/loginAdmin',
            name: 'LoginAdmin',
            component: LoginAdmin
        },

        ]
    },
];


const router = createRouter({
    history: createWebHistory(),
    routes

})

export default router;