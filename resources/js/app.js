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
 
 Vue.use(Vuetify);
 
 /**
  * Next, we will create a fresh Vue application instance and attach it to
  * the page. Then, you may begin adding components to this application
  * or customize the JavaScript scaffolding to fit your unique needs.
  */
 
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
 