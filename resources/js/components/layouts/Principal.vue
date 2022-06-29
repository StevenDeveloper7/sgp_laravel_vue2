<template>
    <div>
        <notificaciones></notificaciones>

        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar bg-pale-secondary">
            <!-- sidebar-->
            <h2
                style="
                    ine-height: 36px;
                    font-size: 24px;
                    text-align: center;
                    font-weight: 700;
                    font-family: inherit;
                "
            >
                Traelo Ve!
            </h2>
            <section class="sidebar">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="user-profile treeview">
                        <a href="#">
                            <img
                                :src="'fotos/' + this.$auth.user().foto"
                                alt="user"
                            />
                            <span
                                v-text="this.$auth.user().nombre_completo"
                            ></span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="#"
                                    ><i class="fa fa-power-off mr-5"></i>Cerrar
                                    Sesión</a
                                >
                            </li>
                        </ul>
                    </li>

                    <li class="header nav-small-cap">PERSONAL</li>

                    <li
                        class="li_hover_menu"
                        v-if="this.$auth.user().id_role == 1"
                    >
                        <router-link :to="{ name: 'dashboard' }">
                            <i class="fa fa-home"></i> <span>Inicio</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </router-link>
                    </li>

                    <li
                        class="li_hover_menu"
                        v-if="this.$auth.user().id_role == 1"
                    >
                        <router-link :to="{ name: 'categoria_productos' }">
                            <i class="fa fa-shopping-basket"></i>
                            <span>Categoría Producto</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </router-link>
                    </li>

                    <li
                        class="li_hover_menu"
                        v-if="this.$auth.user().id_role == 1"
                    >
                        <router-link :to="{ name: 'productos' }">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Productos</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </router-link>
                    </li>

                    <li
                        class="li_hover_menu"
                        v-if="this.$auth.user().id_role == 2"
                    >
                        <router-link :to="{ name: 'cliente_negocios' }">
                            <i class="fa fa-home"></i>
                            <span>Negocios Disponibles</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </router-link>
                    </li>

                    <li
                        class="li_hover_menu"
                        v-if="this.$auth.user().id_role == 1"
                    >
                        <router-link :to="{ name: 'combos' }">
                            <i class="fa fa-archive"></i>
                            <span>Combos</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </router-link>
                    </li>

                    <li
                        class="li_hover_menu"
                        v-if="
                            this.$auth.user().id_role == 1 ||
                            this.$auth.user().id_role == 3
                        "
                    >
                        <router-link :to="{ name: 'pedido_negocios' }">
                            <i class="fa fa-bookmark"></i>
                            <span>Pedidos</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </router-link>
                    </li>

                    <!-- Pedidos cliente -->
                    <li
                        class="li_hover_menu"
                        v-if="this.$auth.user().id_role == 2"
                    >
                        <router-link :to="{ name: 'pedido_clientes' }">
                            <i class="fa fa-bookmark"></i>
                            <span>Pedidos</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </router-link>
                    </li>

                    <li
                        class="li_hover_menu"
                        v-if="this.$auth.user().id_role == 1"
                    >
                        <router-link :to="{ name: 'usuarios' }">
                            <i class="fa fa-users"></i>
                            <span>Colaboradores</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </router-link>
                    </li>

                    <li
                        class="li_hover_menu"
                        v-if="this.$auth.user().id_role == 4"
                    >
                        <router-link :to="{ name: 'admin_usuarios' }">
                            <i class="fa fa-users"></i>
                            <span>Admin. Usuarios</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </router-link>
                    </li>

                    <li
                        class="li_hover_menu"
                        v-if="this.$auth.user().id_role == 4"
                    >
                        <router-link :to="{ name: 'admin_negocios' }">
                            <i class="fa fa-home"></i>
                            <span>Admin. Negocios</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </router-link>
                    </li>

                    <li
                        class="li_hover_menu"
                        v-if="this.$auth.user().id_role == 4"
                    >
                        <router-link :to="{ name: 'categoria_negocios' }">
                            <i class="fa fa-home"></i>
                            <span>Cat. Negocios</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </router-link>
                    </li>

                    <li class="li_hover_menu" v-show="false">
                        <router-link :to="{ name: 'reportes' }">
                            <i class="fa fa-table"></i>
                            <span>Reportes</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </router-link>
                    </li>

                    <li class="li_hover_menu">
                        <router-link :to="{ name: 'configuracion' }">
                            <i class="fa fa-cog"></i>
                            <span>Perfil</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </router-link>
                    </li>

                    <li
                        class="li_hover_menu"
                        v-if="this.$auth.user().id_role == 1"
                    >
                        <router-link :to="{ name: 'negocios' }">
                            <i class="fa fa-map-marker"></i>
                            <span>Mi Negocio</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </router-link>
                    </li>

                    <!-- <li class="li_hover_menu" v-if="this.$auth.user().id_role == 1 ">
          <router-link :to="{name: 'donaciones'}" >
            <i class="fa fa-credit-card"></i>
            <span>Donaciones</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </router-link>
        </li> -->
                </ul>
            </section>
        </aside>

        <v-tab-bar v-if="this.$auth.user().id_role == 2" v-show="mostrar">
            <v-tab-bar-item to="/cliente_negocios" label="Home">
                <i class="fa fa-home"></i>
            </v-tab-bar-item>
            <v-tab-bar-item to="/pedido_clientes" label="Pedidos">
                <i class="fa fa-list"></i>
            </v-tab-bar-item>
            <v-tab-bar-item to="/configuracion" label="configuración">
                <i class="fa fa-cog"></i>
            </v-tab-bar-item>
        </v-tab-bar>

        <router-view></router-view>
    </div>
</template>

<script>
export default {
    created: function () {
        this.movil();
    },

    data() {
        return {
            mostrar: false,
        };
    },

    computed: {},

    methods: {
        movil() {
            if (screen.width < 300 || screen.width < 710) {
                this.mostrar = true;
            }
        },
    },
};
</script>

<style>
@media only screen and (min-width: 300px) and (max-width: 710px) {
    .ocultar {
        display: none;
    }

    .mostrar {
        display: true;
    }
}

.li_hover_menu:hover {
    background-color: #7f82eb;
    border: 2px solid #7f82eb;
    border-radius: 10px;
}

.li_hover_menu span:hover {
    color: white;
}

.color-degradado {
    background: #c35d89;
    background-image: linear-gradient(to bottom, #c35d89, #a56681) !important;
    background-repeat: repeat-x;
}

.sidebar-menu > li.user-profile > a {
    color: #615e5e !important;
}

.sidebar-menu .user-profile > a img {
    width: 68px;
    border-radius: 100%;
    margin-right: 10px;
    height: 68px;
}
</style>
