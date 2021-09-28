import Vue from "vue";
import Vuex from "vuex";
Vue.use(Vuex);

import custom_axios from '../axios/custom_axios'

export const store = new Vuex.Store({
    state: {
        token: localStorage.getItem('access-token') ? localStorage.getItem('access-token') : null,
        user: null,
        
    },

    getters: {
        getToken(state) {
            return state.token;
        },
        getUser(state) {
            return state.user;
        },
        
    },

    mutations: {
        setToken(state, payload) {
            state.token = payload;
        },
        setUser(state, payload) {
            state.user = payload;
        },
        removeToken(state) {
            state.token = null;
        },
        removeUser(state) {
            state.user = null;
        },
    },

    actions: {
        login(context, data) {
            return new Promise((resolve, reject) => {
                custom_axios
                    .post("/login", {
                        email: data.email,
                        password: data.password
                    })
                    .then(response => {
                        context.commit('setUser', response.data.logged_in_user);
                        context.commit('setToken', response.data.token);
                        localStorage.setItem('access-token', response.data.token);
                        localStorage.setItem('username', response.data.logged_in_user.name);
                        localStorage.setItem('id', response.data.logged_in_user.id);
                        localStorage.setItem('email', response.data.logged_in_user.email);
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