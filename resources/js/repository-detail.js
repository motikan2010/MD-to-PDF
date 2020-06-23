import './bootstrap'
import Vue from 'vue'
import VueRouter from 'vue-router'
import RepositoryFile from './pages/RepositoryFile'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history'
})

new Vue({
    el: '#app',
    router,
    components: { RepositoryFile },
    template: '<RepositoryFile />'
})
