import './bootstrap'
import Vue from 'vue'
import VueRouter from 'vue-router'
import RepositoryFilePage from './components/RepositoryFilePage'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    scrollBehavior () {
        return { x: 0, y: 0 }
    }
})

new Vue({
    el: '#app',
    router,
    components: { RepositoryFilePage },
    template: '<RepositoryFilePage />'
})
