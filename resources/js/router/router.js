import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Login from '../components/pages/Login';
import Register from '../components/pages/Register';
import Homepage from '../components/pages/Homepage';
import Details from '../components/pages/Details';
import FAQ from '../components/pages/FAQ';
import Users from '../components/admin/Users';

const routes = [{
    path: '/',
    name: 'Homepage',
    component: Homepage,
    children: [
        {
            path: "/",
            name: "Login",
            component: Login
        },
        {
            path: '/register',
            name: 'Register',
            component: Register,
        },
        {
            path: "/user-details",
            name: "Details",
            component: Details
        },
        {
            path: "/faq",
            name: "FAQ",
            component: FAQ
        },
        {
            path: "/admin/user-lists",
            name: "Users",
            component: Users
        },
    ]
},

];

const router = new VueRouter({
    routes,
    mode: "history",
    linkActiveClass: "active",
    render: h => h(App)
});

export default router;