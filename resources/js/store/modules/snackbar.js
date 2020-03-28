/*
* This files manages snackbar
*/

// API


// state
const state = {

    snackbar_data: []
};


// getters
const getters = {

    getSnackbarData: state => {
        return state.snackbar_data;
    },

};


// actions
const actions = {

    // default snack
    showSnack( {commit}, request ){
        let snackData = { snack : true, snackText : request };
        commit('setSnackData', snackData);
    },

    // success snack
    showSnackSuccess( {commit}, request ){
        let snackData = { snack : true, snackColor : 'success', snackText : request };
        commit('setSnackData', snackData);
    },

    // error snack
    showSnackError( {commit}, request ){
        let snackData = { snack : true, snackColor : 'error', snackText : request };
        commit('setSnackData', snackData);
    },

    // info snack
    showSnackInfo( {commit}, request ){
        let snackData = { snack : true, snackColor : 'info', snackText : request };
        commit('setSnackData', snackData);
    },

    // warning snack
    showSnackWarning( {commit}, request ){
        let snackData = { snack : true, snackColor : 'warning', snackText : request };
        commit('setSnackData', snackData);
    },

};


// mutations
const mutations = {

    setSnackData( state, snack_data ){
        state.snackbar_data = snack_data;
    },

};


// Export const
export default{
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
