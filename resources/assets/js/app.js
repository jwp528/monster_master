
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
Vue.use(VueRouter);

Vue.config.devtools = true;
Vue.config.performance = true;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import App from './components/App.vue';
import CrudsList from './components/CrudsComponent.vue';
import AboutComponent from "./components/AboutComponent.vue";

const routes = [
  {
    name: 'cruds',
    path: '/',
    component: CrudsList
  },
  {
    name: 'about',
    path: '/about',
    component: AboutComponent
  }
];//end routes

const router = new VueRouter({mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({router}, App)).$mount("#app");
// const app = new Vue({
//   el: '#app',
//   components: {
//     App,
//     AboutComponent,
//   },
//   render: h => h(App)
// });
