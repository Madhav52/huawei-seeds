/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');
 import Vue from 'vue';
 import Vuetify from 'vuetify';
 import 'vuetify/dist/vuetify.min.css';
 import router from './router/router';
import '@mdi/font/css/materialdesignicons.css'
 import { store } from './store/store';
 import VueSweetalert2 from 'vue-sweetalert2';

// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';
import LinkPreview from "@ashwamegh/vue-link-preview";


Vue.use(VueSweetalert2);
Vue.use(LinkPreview);
 
 Vue.use(Vuetify);
 
 /**
  * Next, we will create a fresh Vue application instance and attach it to
  * the page. Then, you may begin adding components to this application
  * or customize the JavaScript scaffolding to fit your unique needs.
  */
//   router.beforeEach((to, from, next) => {
//     //  If the next route is requires user to be Logged IN
//     if (to.matched.some(m => m.meta.requiresAuth) ) {
//         if(store.getters.loggedIn)
//             return next()

//         return AuthService.check().then(authenticated => {
//             if (!authenticated) {
//                 return next({ path: '/' })
//             }

//             return next()
//         })
//     }

//     return next()
// })

 const app = new Vue({
     el: '#app',
     vuetify: new Vuetify({
         icons: {
             iconfont: 'mdi'
         }
     }),
     router,
     store,
 });
 