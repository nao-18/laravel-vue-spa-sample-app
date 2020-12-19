import './bootstrap'

import Vue from 'vue'
// Import the routing definition
import router from './router'
import store from './store'
// Import the root component
import App from './App.vue'

const createApp = async () => {
    await store.dispatch('auth/currentUser')

    new Vue({
        el: '#app',
        router, // Read the routing definition
        store,
        components: { App }, // Declare the use of the root component
        template: '<App />' // Draw the root component
    })
}

createApp()