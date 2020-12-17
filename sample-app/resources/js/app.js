import Vue from 'vue'
// Import the routing definition
import router from './router'
// Import the root component
import App from './App.vue'

new Vue({
    el: '#app',
    router, // Read the routing definition
    components: { App }, // Declare the use of the root component
    template: '<App />' // Draw the root component
})