import routes from '../../routes'
import VueRouter from 'vue-router'
import Master from './Master'
require('../../app'); // Vue, Vuetify, 'Axios as $http', Store

// Application Store
import { store } from '../../store/store'

/** Create the router instance and pass the `routes` option
 You can pass in additional options here, but let's
 keep it simple for now.
 */
Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.getters['users/loggedIn']) {
            next({
                name: 'login',
            })
        } else {
            next()
        }
    } else if (to.matched.some(record => record.meta.requiresVisitor)) {
        if (store.getters['users/loggedIn']) {
            next({
                name: 'dashboard',
            })
        } else {
            next()
        }
    } else {
        next()
    }
})

const app = new Vue({
    store,
    router,
    vuetify: new Vuetify(Opts),
    components: { Master },
    template: '<Master/>'
}).$mount('#app');
