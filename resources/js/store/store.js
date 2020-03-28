import Vue from 'vue'
import Vuex from 'vuex'

// Import modules
import snackbar from './modules/snackbar';
import users from './modules/users';

Vue.use(Vuex);

export const store = new Vuex.Store({

    modules: {
        snackbar,
        users
    },
});



