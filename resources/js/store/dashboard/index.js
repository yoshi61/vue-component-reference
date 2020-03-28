// Use Vue & Vuex
import Vue from 'vue';
import Vuex from 'vuex';

// Import modules
// import accessToken from '../modules/access-token';
// import layoutData from '../modules/layout-data';
// import dataTable from '../modules/data-table';
// import crudFunctions from '../modules/crud-functions';
// import snackbar from '../modules/snackbar';
import subModules from './sub-modules';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        subModules,
    }
})
