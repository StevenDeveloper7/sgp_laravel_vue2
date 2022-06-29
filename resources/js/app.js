import router from './routes';
import VueRouter from 'vue-router'

import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import moment from 'moment'

import VCalendar from 'v-calendar';

import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';

//import socketio from 'socket.io-client';
//import VueSocketIO from 'vue-socket.io';

import 'es6-promise/auto'
import axios from 'axios'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import auth from './auth'

import VuePaginate from 'vue-paginate'
import Chat from 'vue-beautiful-chat'

import VTabBar from 'v-tab-bar'
import 'v-tab-bar/dist/v-tab-bar.css'
Vue.use(VTabBar)

Vue.use(Chat)
Vue.use(VuePaginate)



//import vmodal from 'vue-js-modal'

//Vue.use(vmodal , { dialog: true })

import * as VueGoogleMaps from "vue2-google-maps";



Vue.use(VueGoogleMaps, {
    load: {
      key: "AIzaSyApB5nKz_2KD4MeV_XPt5I9By7vpwhXGGQ",
      libraries: "places" // necessary for places input
    }
  });

 //Socket io
//  export const SocketInstance = socketio('https://traelo-ve.com:3000', {
//     secure: true
// });
//  Vue.use(VueSocketIO, SocketInstance)



import { ServerTable } from 'vue-tables-2';
Vue.use(ServerTable);

import Vuex from 'vuex'

Vue.use(Vuex)
Vue.config.devtools = true


// Set Vue router
Vue.router = router
Vue.use(VueRouter)

// Vue.use(require('@websanova/vue-auth'), {
//     auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
//     http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
//     router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
//     rolesVar: 'role'
// })

// Set Vue authentication
Vue.use(VueAxios, axios)
Vue.use(VueAuth, auth)

Vue.component('v-select', vSelect)

//Daterange
Vue.use(VCalendar, {componentPrefix: 'vc'});


// Moment
Vue.prototype.moment = moment

require('./bootstrap');

window.Vue = require('vue');

// Millares
Vue.filter('format-thousands', function (value) {
    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
});

Vue.component('app', require('./components/AppComponent.vue').default);

Vue.component('principal', require('./components/layouts/Principal.vue').default);
Vue.component('spinner', require('./components/Spinner.vue').default);



Vue.component('pagination', require('laravel-vue-pagination'));


Vue.component('dashboard', require('./views/Dashboard.vue').default);
Vue.component('productos', require('./views/Productos.vue').default);
Vue.component('categoria_productos', require('./views/Categoria_Productos.vue').default);
Vue.component('ventas', require('./views/Ventas.vue').default);
Vue.component('usuarios', require('./views/Usuarios.vue').default);
Vue.component('reportes', require('./views/Reportes.vue').default);
Vue.component('configuracion', require('./views/Configuracion.vue').default);
Vue.component('login', require('./views/Login.vue').default);
Vue.component('register', require('./views/Register.vue').default);
Vue.component('registro_clientes', require('./views/Registro_Clientes.vue').default);
Vue.component('registro_vendedores', require('./views/Registro_Vendedores.vue').default);
Vue.component('negocio', require('./views/Negocio.vue').default);
Vue.component('combos', require('./views/Combos.vue').default);
Vue.component('cliente_negocio', require('./views/Cliente_Negocios.vue').default);
Vue.component('pedido_negocio', require('./views/Pedido_Negocios.vue').default);
Vue.component('pedido_cliente', require('./views/Pedido_Clientes.vue').default);
Vue.component('notificaciones', require('./views/Notificaciones.vue').default);
Vue.component('donaciones', require('./views/Donaciones.vue').default);
Vue.component('admin_negocios', require('./views/Admin_Negocios.vue').default);
Vue.component('categoria_negocios', require('./views/Categoria_Negocios.vue').default);
Vue.component('admin_usuarios', require('./views/Admin_Usuarios.vue').default);

//sweet alert
Vue.use(VueSweetalert2);



const app = new Vue({
    el: '#app',
    router,
    devtool: 'source-map'

});
