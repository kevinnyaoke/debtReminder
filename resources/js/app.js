require('./bootstrap');
import Vue from 'vue'
import VueRouter from 'vue-router'

import VueAxios from 'vue-axios';
import axios from 'axios';
import Notifications from 'vue-notification'


Vue.use(VueRouter)
Vue.use(VueAxios, axios);
Vue.use(Notifications)

import App from './view/App'
import Home from './pages/Home'
import Login from './pages/Login'
import addclient from './pages/addclient'
import viewclients from './pages/viewclients'
import editclient from './pages/editclient'
import changepass from './pages/changepass'
import resetpass from './pages/resetpass'


const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'login',
            component: Login,
            meta: { hideNavigation: true }

        },
        {
            path: '/home',
            name: 'home',
            component: Home,
        },
        {
            path: '/addclient',
            name: 'addclient',
            component: addclient,
        },
        {
            path: '/viewclients',
            name: 'viewclients',
            component: viewclients,
        },
        {
            path: '/editclient',
            name: 'editclient',
            component: editclient,
        },
        {
            path: '/changepass',
            name: 'changepass',
            component: changepass,
        },
        {
            path: '/resetpass',
            name: 'resetpass',
            component: resetpass,
            meta: { hideNavigation: true }
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,

});
