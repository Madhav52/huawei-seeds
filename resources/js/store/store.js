import Vue from "vue";
import Vuex from "vuex";
Vue.use(Vuex);

import custom_axios from '../axios/custom_axios'

export const store = new Vuex.Store({
    // state: {
    //     token: localStorage.getItem('access-token') ? localStorage.getItem('access-token') : null,
    //     user: null,
        
    // },

    // getters: {
    //     getToken(state) {
    //         return state.token;
    //     },
    //     getUser(state) {
    //         return state.user;
    //     },
        
    // },

    // mutations: {
    //     setToken(state, payload) {
    //         state.token = payload;
    //     },
    //     setUser(state, payload) {
    //         state.user = payload;
    //     },
    //     removeToken(state) {
    //         state.token = null;
    //     },
    //     removeUser(state) {
    //         state.user = null;
    //     },
    // },

    actions: {
        login(context, data) {
            return new Promise((resolve, reject) => {
                custom_axios
                    .post("/login", {
                        email: data.email,
                        password: data.password
                    })
                    .then(response => {
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        register(context, data) {
            return new Promise((resolve, reject) => {
                custom_axios
                    .post("/register", {
                        name: data.name,
                        email: data.email,
                        password: data.password
                    })
                    .then(response => {
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },

        logout(context) {
            custom_axios.defaults.headers.common["Authorization"] = "Bearer " + context.state.token;
            if (context.getters.getToken) {
                return new Promise((resolve, reject) => {
                    custom_axios
                        .get("/logout")
                        .then(response => {
                            context.commit('removeToken');
                            context.commit('removeUser');
                            localStorage.removeItem('access-token');
                            resolve(response);
                        })
                        .catch(error => {
                            reject(error);
                        });
                });
            }
        },
    }

});