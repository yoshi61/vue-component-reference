// 1. Define route components.
// These can be imported from other files
//import LandingPage from './components/marketing/LandingPage'
import Login from './components/auth/Login'
// import Logout from './components/auth/Logout'
import Register from './components/auth/Register'

import Dashboard from './components/Dashboard'

// 2. Define some routes
// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// `Vue.extend()`, or just a component options object.
// We'll talk about nested routes later.
export default [
    // {
    //     path: '/',
    //     name: 'home',
    //     component: LandingPage
    // },
    {
        path: '/',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            requiresVisitor: true,
        }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            requiresVisitor: true,
        }
    },
    // {
    //     path: '/logout',
    //     name: 'logout',
    //     component: Logout
    // }
]
