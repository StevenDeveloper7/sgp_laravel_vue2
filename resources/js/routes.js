import Vue from 'vue/dist/vue.min.js'
import Router from 'vue-router';

window.Vue = require('vue');
Vue.use(Router)

import dashboard from './views/Dashboard'
import ventas from './views/Ventas'
import usuarios from './views/Usuarios'
import reportes from './views/Reportes'
import configuracion from './views/Configuracion'
import configuracion_facebook from './views/Configuracion_facebook'
import login from './views/Login'
import register from './views/Register'
import registro_clientes from './views/Registro_Clientes'
import registro_vendedores from './views/Registro_Vendedores'
import productos from './views/Productos'
import categoria_productos from './views/Categoria_Productos'
import negocios from './views/Negocio'
import combos from './views/Combos'
import cliente_negocios from './views/Cliente_Negocios'
import cliente_pedidos from './views/cliente_pedidos'
import pedido_negocios from './views/Pedido_Negocios'
import pedido_clientes from './views/Pedido_Clientes'
import donaciones from './views/Donaciones'
import admin_negocios from './views/Admin_Negocios'
import categoria_negocios from './views/Categoria_Negocios'
import admin_usuarios from './views/Admin_Usuarios'


export default  new Router({
    routes:[

        {
            path: '/registro_clientes',
            name: 'registro_clientes',
            component: registro_clientes,
            meta: {
              auth: false
            }
        },

        {
            path: '/registro_vendedores',
            name: 'registro_vendedores',
            component: registro_vendedores,
            meta: {
              auth: false
            }
        },

        {
            path: '/bienvenido_comprador_vendedor',
            name: 'register',
            component: register,
            meta: {
              auth: false
            }
        },

        {
            path: '/login',
            name: 'login',
            component: login,
            meta: {
              auth: false
            }
        },

        {
            path: '/',
            name: 'dashboard',
            component: dashboard,
            meta: {
                auth: true
              },
              beforeEnter: (to, from, next) => {
                const authUser = JSON.parse(window.localStorage.getItem('lbUser'))
                 if (authUser.data.id_role === 1 ) {
                   next();
                 } else {
                   next('/cliente_negocios');
                 }
             },

        },


        {
            path: '/venta',
            name: 'ventas',
            component: ventas,
            meta: {
                auth: true
              }

        },



     /*   {
            path: '/reporte',
            name: 'reportes',
            component: reportes,
            meta: {
                auth: true
              },
              beforeEnter: (to, from, next) => {
                const authUser = JSON.parse(window.localStorage.getItem('lbUser'))
                 if (authUser.data.id_role === 1 ) {
                   next();
                 } else {
                   next('/cliente_negocios');
                 }
             },

        },*/

        {
            path: '/configuracion',
            name: 'configuracion',
            component: configuracion,
            meta: {
                auth: true
              }

        },

        {
            path: '/configuracion_facebook',
            name: 'configuracion_facebook',
            component: configuracion_facebook,
            meta: {
                auth: true
              }

        },

        {
          path: '/productos',
          name: 'productos',
          component: productos,
          meta: {
              auth: true,
            },
            beforeEnter: (to, from, next) => {
                const authUser = JSON.parse(window.localStorage.getItem('lbUser'))
                 if (authUser.data.id_role === 1 ) {
                   next();
                 } else {
                   next('/cliente_negocios');
                 }
             },
          },
          {
            path: '/categoria_productos',
            name: 'categoria_productos',
            component: categoria_productos,
            meta: {
                auth: true,
              },
              beforeEnter: (to, from, next) => {
                const authUser = JSON.parse(window.localStorage.getItem('lbUser'))
                 if (authUser.data.id_role === 1 ) {
                   next();
                 } else {
                   next('/cliente_negocios');
                 }
             },
            },
            {
              path: '/negocios',
              name: 'negocios',
              component: negocios,
              meta: {
                  auth: true,
                },
                beforeEnter: (to, from, next) => {
                    const authUser = JSON.parse(window.localStorage.getItem('lbUser'))
                     if (authUser.data.id_role === 1 ) {
                       next();
                     } else {
                       next('/cliente_negocios');
                     }
                 },
              },
              {
                path: '/admin_negocios',
                name: 'admin_negocios',
                component: admin_negocios,
                meta: {
                    auth: true,
                  },
                  beforeEnter: (to, from, next) => {
                      const authUser = JSON.parse(window.localStorage.getItem('lbUser'))
                       if (authUser.data.id_role === 4 ) {
                         next();
                       } else {
                         next('cliente_negocios');
                       }
                   },
                },

                {
                  path: '/categoria_negocios',
                  name: 'categoria_negocios',
                  component: categoria_negocios,
                  meta: {
                      auth: true,
                    },
                    beforeEnter: (to, from, next) => {
                        const authUser = JSON.parse(window.localStorage.getItem('lbUser'))
                         if (authUser.data.id_role === 4 ) {
                           next();
                         } else {
                           next('cliente_negocios');
                         }
                     },
                  },

              {
                path: '/combos',
                name: 'combos',
                component: combos,
                meta: {
                    auth: true,
                  },
                  beforeEnter: (to, from, next) => {
                    const authUser = JSON.parse(window.localStorage.getItem('lbUser'))
                     if (authUser.data.id_role === 1 ) {
                       next();
                     } else {
                       next('/cliente_negocios');
                     }
                 },
              },

              {
                path: '/pedido_negocios',
                name: 'pedido_negocios',
                component: pedido_negocios,
                meta: {
                    auth: true,
                  },
                  beforeEnter: (to, from, next) => {
                   const authUser = JSON.parse(window.localStorage.getItem('lbUser'))
                    if (authUser.data.id_role === 1 || authUser.data.id_role === 3) {
                      next();
                    } else {
                      next('/cliente_negocios');
                    }
                  },
              },

              {
                path: '/pedido_clientes',
                name: 'pedido_clientes',
                component: pedido_clientes,
                meta: {
                    auth: true,
                  },
                  beforeEnter: (to, from, next) => {
                   const authUser = JSON.parse(window.localStorage.getItem('lbUser'))
                    if (authUser.data.id_role === 2) {
                      next();
                    } else {
                      next('/pedido_negocios');
                    }
                  },
              },

              {
                path: '/usuario',
                name: 'usuarios',
                component: usuarios,
                meta: {
                    auth: true
                  },
                  beforeEnter: (to, from, next) => {
                    const authUser = JSON.parse(window.localStorage.getItem('lbUser'))
                     if (authUser.data.id_role === 1) {
                       next();
                     } else {
                       next('/cliente_negocios');
                     }
                 },

            },

              {
                path: '/admin_usuarios',
                name: 'admin_usuarios',
                component: admin_usuarios,
                meta: {
                    auth: true
                  },
                  beforeEnter: (to, from, next) => {
                    const authUser = JSON.parse(window.localStorage.getItem('lbUser'))
                    if (authUser.data.id_role === 4) {
                      next();
                    } else {
                      next('/admin_usuarios');
                    }
                },

            },

            {
                path: '/donacion',
                name: 'donaciones',
                component: donaciones,
                meta: {
                    auth: true
                  },
                  beforeEnter: (to, from, next) => {
                    const authUser = JSON.parse(window.localStorage.getItem('lbUser'))
                     if (authUser.data.id_role === 1) {
                       next();
                     }  else {
                       next('/configuracion');
                     }
                 },

            },

               {

                path: '/cliente_negocios',
                name: 'cliente_negocios',
                component: cliente_negocios,
                meta: {
                    auth: true
                  },
                  beforeEnter: (to, from, next) => {
                    const authUser = JSON.parse(window.localStorage.getItem('lbUser'))
                     if (authUser.data.id_role === 2) {
                       next();
                     } else {
                       next('/pedido_negocios');
                     }
                 },

                },


                {

                    path: ':id',
                    name: 'cliente_pedidos',
                    component: cliente_pedidos,
                    props: true,
                    meta: {
                        auth: true
                      }

                    }


    ],
    mode: 'history'

})
