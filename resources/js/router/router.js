import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Login from '../components/pages/Login';
// import DashboardLayout from '../layouts/DLayout';


const routes = [{
    path: '/',
    name: 'Login',
    component: Login,
},
// {
//     path: "/home",
//     component: DashboardLayout,
//     children: [
//         {
//             path: "/home",
//             name: "homepage",
//             component: Homepage
//         },
        
//     ]
// }
];

const router = new VueRouter({
    routes,
    mode: "history",
    linkActiveClass: "active",
    render: h => h(App)
});

export default router;