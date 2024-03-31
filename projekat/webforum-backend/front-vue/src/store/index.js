

import { createStore } from "vuex";
import axios from "axios";
// import axiosClient from "../axios";
import axiosClient from "../axios";
import { useRouter } from 'vue-router';


import { UserAddIcon } from "@heroicons/vue/solid";
import router from "../router";




const store = createStore({
    state: {
        users: {
            data: {},
            tokenAdmin: sessionStorage.getItem("TOKEN_ADMIN"),
        },



        user: {
            data: {},
            token: sessionStorage.getItem("TOKEN"),
            id: sessionStorage.getItem("idUser"),
        },
        post: {

            data: {
                //  info: {}
            },

        },
        categorie: {
            data: {
                //  info: {}
            },

        },


    },
    getters: {},

    actions: {
        // admin
        getAllUsers({ commit }) {
            return axiosClient.get('/users')
                .then(response => {
                    // response.data.forEach(obj => {
                    //     Object.entries(obj).forEach(([key, value]) => {
                    //         console.log(`${key} ${value}`);
                    //         if()

                    //     }); });                    
                    commit("setUsers", response.data);
                    // console.log(response.data.posts);
                    return response.data
                });

        },
        // delete user
        deleteUser({ commit }, id) {
            return axiosClient.delete('/user/'+id)
                .then(response => {
                    // response.data.forEach(obj => {
                    //     Object.entries(obj).forEach(([key, value]) => {
                    //         console.log(`${key} ${value}`);
                    //         if()

                    //     }); });                    
                    // console.log(response.data.posts);
                    return response.data
                });

        },

        // login admin
        loginAdmin({ commit }, admin) {
            return axiosClient.post('/loginAdmin' ,admin)
                .then(response => {
                    // response.data.forEach(obj => {
                    //     Object.entries(obj).forEach(([key, value]) => {
                    //         console.log(`${key} ${value}`);
                    //         if()

                    //     }); });    
                    if (response.data.message == "success") {
                    commit("setTokenAdmin", response.data.token);

                    }        

                    // console.log(response.data.posts);
                    return response.data
                });

        },

        // end admin



        register({ commit }, user) {

            return axiosClient.post('/register', user)
                .then(response => {
                    commit("setUser", response);
                    return response
                });
        },
        login({ commit }, user) {

            return axiosClient.post('/login', user)
                .then(response => {
                    if (response.data.message == "success") {
                        commit('setUser', response.data.utilisateur);
                        commit('setToken', response.data.token)
                    }

                    return response
                });
        },
    },
    modules: {},


})
export default store;
