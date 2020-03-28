import axios from "axios";
import Vuex from "vuex";

axios.defaults.baseURL = 'http://rizwan.ilf-2019.com.au/api';


const state = {
        token: localStorage.getItem('access_token') || null,
    }

const getters = {

        loggedIn(state) {
            return state.token !== null
        },

    }

const actions = {

        register(context, data) {
            return new Promise((resolve, reject) => {
                axios.post('/register', data)
                    .then(response => {
                        resolve(response)
                    })
                    .catch(error => {
                        reject(error)
                    })
            })
        },

        destroyToken(context) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token;

            if (context.getters.loggedIn) {
                return new Promise((resolve, reject) => {
                    axios.post('/logout')
                        .then(response => {
                            localStorage.removeItem('access_token');
                            context.commit('destroyToken');
                            resolve(response)
                            // console.log(response);
                            // context.commit('addTodo', response.data)
                        })
                        .catch(error => {
                            localStorage.removeItem('access_token');
                            context.commit('destroyToken');
                            reject(error)
                        })
                })
            }
        },

        retrieveToken(context, credentials) {

            return new Promise((resolve, reject) => {
                axios.post('/login', {
                    username: credentials.username,
                    password: credentials.password,
                })
                    .then(response => {
                        const token = response.data.access_token;

                        localStorage.setItem('access_token', token);
                        context.commit('retrieveToken', token);
                        resolve(response)
                        // console.log(response);
                        // context.commit('addTodo', response.data)
                    })
                    .catch(error => {
                        console.log(error);
                        reject(error)
                    })
            })
        },

    }

const mutations = {

        retrieveToken(state, token) {
            state.token = token
        },

        destroyToken(state) {
            state.token = null
        },

    }



// Export const
export default{
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
