// API
//import axios from 'axios';
//import apiService from '../../apis/api-services';
//const API_GATEWAY = axios.create(apiService.gateway);

// state
const state = {

    current_item:'XXX GETTER XXX',

};

// getters
const getters = {

    getCurrentItem:  state => {
        return state.current_item;
    },

};

// actions
const actions = {

    storeCurrentItem( {commit}, request ){
        commit('setCurrentItem', request);
    },

};

// mutations
const mutations = {

    setCurrentItem( state, current_item ){
        state.current_item = current_item;
    },

};

// Export const
export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
