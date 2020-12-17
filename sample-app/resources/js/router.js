import Vue from "vue"
import VueRouter from "vue-router"

// import page-component
import PhotoList from './pages/PhotoList'
import Login from './pages/Login'

// use  VueRouter plugin
// can use <RouterView />
Vue.use(VueRouter)

// Map paths and components
const routes = [
    {
        path: '/',
        component: PhotoList
    },
    {
        path: '/login',
        component: Login
    }
]

// Create a VueRouter instance.
const router = new VueRouter({
    mode: 'history',
    routes
})

// Export a VueRouter instance.
// To import with app.js.
export default router