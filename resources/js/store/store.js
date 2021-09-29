import Vue from "vue";
import Vuex from "vuex";
Vue.use(Vuex);

import custom_axios from '../axios/custom_axios'

export const store = new Vuex.Store({
    state: {
        token: localStorage.getItem('access-token') ? localStorage.getItem('access-token') : null,
        user: null,
        user_profile: [],
        
    },

    getters: {
        getToken(state) {
            return state.token;
        },
        getUser(state) {
            return state.user;
        },
        user_profile(state) {
            return state.user_profile
        },
        
    },

    mutations: {
        setToken(state, payload) {
            state.token = payload;
        },
        setUser(state, payload) {
            state.user = payload;
        },
        userProfile(state, value) {
            state.user_profile = value
        },
        // removeToken(state) {
        //     state.token = null;
        // },
        // removeUser(state) {
        //     state.user = null;
        // },
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
                        resolve(response);
                        context.commit('setUser', response.data.logged_in_user);
                        context.commit('setToken', response.data.token);
                        localStorage.setItem('access-token', response.data.token);
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

        storeUserProfile(context, data) {
                return new Promise((resolve, reject) => {
                    axios_custom.post('/user_profile', {
                        namne: data.name,
                        phone: data.phone,
                        email: data.email,
                        gender: data.gender,
                        address: data.address,
                        university: data.university,
                        institution: data.institution,
                        files: data.files,
                        statement: data.statement,
                    })
                        .then(response => {
                            resolve(response)
                            context.commit('userProfile', response.data.data)
                        })
                        .catch(error => {
                            reject(error)
                        })
                })
        },
    }

});