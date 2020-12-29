import Vue from "vue"
import VueRouter from "vue-router"

// import page-component
import PhotoList from './pages/PhotoList'
import Login from './pages/Login'

import store from './store'
import SystemError from './pages/errors/System.vue'
import PhotoDetail from './pages/PhotoDetail.vue'

// use  VueRouter plugin
// can use <RouterView />
Vue.use(VueRouter)

// Map paths and components
const routes = [
    {
        path: '/',
        component: PhotoList,
        props: route => {
            const page = route.query.page
            return { page: /^[1-9][0-9]*$/.test(page) ? page : 1 }
        }
    },
    {
        path: '/photos/:id',
        component: PhotoDetail,
        props: true
    },
    {
        path: '/photos/:id',
        component: PhotoDetail,
        props: true
    },
    {
        path: '/login',
        component: Login,
        beforeEnter(to, from, next) {
            if (store.getters['auth/check']) {
                next('/')
            } else {
                next()
            }
        }
    },
    {
        path: '/500',
        component: SystemError
    }
]

// Create a VueRouter instance.
const router = new VueRouter({
    mode: 'history',
    scrollBehavior () {
        return { x: 0, y: 0 }
    },
    routes
})

// Export a VueRouter instance.
// To import with app.js.
export default router