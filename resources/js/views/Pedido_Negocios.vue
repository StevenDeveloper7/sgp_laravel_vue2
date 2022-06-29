<template>
    <div>
        <div class="content-wrapper">
            <div class="row">
                <div class=" col-md-12 ">
                    <div class="media align-items-center bg-white mb-20">
                        <span class="avatar  bg-primary"
                            ><i class="fa fa-bookmark"></i
                        ></span>
                        <div class="media-body">
                            <h3><strong>Gestiona tus pedidos ve!</strong></h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table mb-0" id="example">
                                        <thead class="bg-mo">
                                            <tr>
                                                <th scope="col">Chat</th>
                                                <th scope="col">Consecutivo</th>
                                                <th scope="col">Cliente</th>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Valor</th>
                                                <th scope="col">Método de pago</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="pedido in Pedidos"
                                                v-bind:key="pedido.id"
                                            >
                                                <td>
                                                    <button
                                                        type="button"
                                                        class="btn bg-ro btn-rounded parpadea"
                                                        data-toggle="modal tooltip"
                                                        data-placement="top"
                                                        title="Abrir chat"
                                                        v-on:click.prevent="
                                                            abrirChat(pedido)
                                                        "
                                                    >
                                                        <i
                                                            class="fa fa-comment"
                                                        >
                                                            Chat</i
                                                        >
                                                    </button>
                                                    &nbsp;
                                                </td>
                                                <td class="td-style">
                                                    {{ pedido.id }}
                                                </td>
                                                <td class="td-style">
                                                    {{ pedido.nombre_cliente }}
                                                </td>
                                                <td class="td-style">
                                                    {{ pedido.fecha }}
                                                </td>
                                                <td class="td-style">
                                                    {{ pedido.valor_total | format-thousands }}

                                                </td>
                                                <td class="td-style" v-if="pedido.pago_electronico == 1">
                                                    Pagado de forma electrónica
                                                </td>
                                                <td class="td-style" v-else>
                                                    Pago en efectivo al recibir
                                                </td>
                                                <td class="td-style parpadea" style="color:#FF4961;" v-if="pedido.id_estado == 1">{{pedido.nombre_estado}}</td>
                                                <td class="td-style parpadea" style="color:#1E9FF2;" v-if="pedido.id_estado == 2">{{pedido.nombre_estado}}</td>
                                                <td class="td-style " style="color:#28D094;" v-if="pedido.id_estado == 3">{{pedido.nombre_estado}}</td>

                                                <td>
                                                    <button
                                                        type="button"
                                                        class="btn btn-success btn-rounded"
                                                        data-toggle="modal tooltip"
                                                        data-placement="top"
                                                        title="Gestionar"
                                                        v-on:click.prevent="
                                                            editPedidos(pedido)
                                                        "
                                                    >
                                                        <i
                                                            class="fa fa-check"
                                                        ></i>
                                                    </button>
                                                    &nbsp;
                                                    <button
                                                        type="button"
                                                        class="btn btn-danger btn-rounded"
                                                        data-toggle="modal tooltip"
                                                        data-placement="top"
                                                        title="Cancelar"
                                                        v-on:click.prevent="
                                                            deletePedidos(
                                                                pedido
                                                            )
                                                        "
                                                    >
                                                        <i
                                                            class="fa fa-close"
                                                        ></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <spinner v-show="loading"></spinner>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
            </section>

        </div>

        <form method="POST" v-on:submit.prevent="updatePedidos(fillpedidos.id)">
            <!-- Modal -->
            <div
                class="modal fade bs-example-modal-lg"
                tabindex="-1"
                role="dialog"
                aria-labelledby="myLargeModalLabel"
                aria-hidden="true"
                style="display: none;"
                id="edit"
            >
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" style=" height: auto !important;">
                        <div class="modal-header bg-mo">
                            <h5 class="modal-title">
                                Gestiona Tu Pedido ve!
                            </h5>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col s12">
                                <h4>Información del Combo</h4>
                                <div class="row">
                                    <div class="box-body">
                                        <div class="table-responsive">
                                            <table
                                                class="table mb-0"
                                                id="example"
                                            >
                                                <thead class="bg-mo">
                                                    <tr>
                                                        <th scope="col">
                                                            Nombre
                                                        </th>
                                                        <th scope="col">
                                                            Descripción
                                                        </th>
                                                        <th scope="col">
                                                            Valor
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr
                                                        v-for="combo in Combos"
                                                        v-bind:key="combo.id"
                                                    >
                                                        <td class="td-style">
                                                            {{
                                                                combo.nombre_combo
                                                            }}
                                                        </td>
                                                        <td class="td-style">
                                                            {{
                                                                combo.descripcion_combo
                                                            }}
                                                        </td>
                                                        <td class="td-style">
                                                            {{ combo.valor_combo | format-thousands }}

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <spinner v-show="loading"></spinner>
                                        </div>
                                    </div>
                                </div>

                                <h4>Información del Cliente</h4>
                                <div class="row">
                                    <div class="box-body">
                                        <div class="table-responsive">
                                            <table
                                                class="table mb-0"
                                                id="example"
                                            >
                                                <thead class="bg-mo">
                                                    <tr>
                                                        <th scope="col">
                                                            Nombre
                                                        </th>
                                                        <th scope="col">
                                                            Dirección
                                                        </th>
                                                        <th scope="col">
                                                            Teléfono
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr
                                                        v-for="usuario in Usuarios"
                                                        v-bind:key="usuario.id"
                                                    >
                                                        <td class="td-style">
                                                            {{
                                                                usuario.nombre_completo
                                                            }}
                                                        </td>
                                                        <td class="td-style">
                                                            {{
                                                                usuario.direccion
                                                            }}
                                                        </td>
                                                        <td class="td-style">
                                                            {{
                                                                usuario.telefono
                                                            }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <spinner v-show="loading"></spinner>
                                        </div>
                                    </div>
                                </div>

                                <h4>Información del Pedido</h4>

                                <div class="row">
                                    <div class="box-body">
                                        <div class="table-responsive">
                                            <table
                                                class="table mb-0"
                                                id="example"
                                            >
                                                <thead class="bg-mo">
                                                    <tr>
                                                        <th scope="col">
                                                            Producto
                                                        </th>
                                                        <th scope="col">
                                                            Cantidad
                                                        </th>
                                                        <th scope="col">
                                                            Valor Unitario
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr
                                                        v-for="detalle in Detalles"
                                                        v-bind:key="detalle.id"
                                                    >
                                                        <td class="td-style">
                                                            {{
                                                                detalle.nombre_producto
                                                            }}
                                                        </td>
                                                        <td class="td-style">
                                                            {{
                                                                detalle.cantidad
                                                            }}
                                                        </td>
                                                        <td class="td-style">
                                                            {{ detalle.valor_producto | format-thousands}}

                                                       </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <spinner v-show="loading"></spinner>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    align="center"
                                    v-for="pedido in Datos_Pedidos"
                                    v-bind:key="pedido.id"
                                >
                                    <h4>
                                        <strong>Valor Total: $</strong>
                                        {{ pedido.valor_total | format-thousands}}
                                    </h4>
                                </div>
                                <br />
                                <div>
                                    <h4>
                                        <strong
                                            >Para aceptar el pedido debes
                                            cambiar el estado e indicar el
                                            tiempo de entrega, de lo contrario
                                            cierra la pestaña y
                                            rechazalo</strong
                                        >
                                    </h4>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="estado">Estado</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"
                                                    ><i
                                                        class="fa fa-id-card"
                                                    ></i
                                                ></span>
                                            </div>
                                            <select
                                                class="custom-select"
                                                v-model="fillpedidos.id_estado"
                                            >
                                                <option value="0" disabled
                                                    >Seleccione</option
                                                >
                                                <option
                                                    v-for="estado in arrayestados"
                                                    :key="estado.id"
                                                    :value="estado.id"
                                                    >{{ estado.nombre }}</option
                                                >
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="tiempo_entrega">Tiempo de Entrega</label>
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                            <i class="fa fa-clock-o"></i>
                                            </span>
                                        </div>
                                        <vue-timepicker format="HH:mm:ss" v-model="fillpedidos.tiempo_entrega"></vue-timepicker>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br /><br />
                            <div class="modal-footer modal-footer-uniform">
                                <button
                                    type="button"
                                    class="btn btn-bold btn-pure btn-secondary btn-rounded"
                                    data-dismiss="modal"
                                >
                                    Cerrar
                                </button>
                                <button
                                    type="submit"
                                    class="btn btn-bold btn-pure btn-success float-right btn-rounded"
                                >
                                    Aceptar Pedido
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form method="POST" v-on:submit.prevent="">
            <!-- Modal -->
            <div
                class="modal fade bs-example-modal-md"
                tabindex="-1"
                role="dialog"
                aria-labelledby="myLargeModalLabel"
                aria-hidden="true"
                style="display: none;"
                id="modalChat"
            >
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title">
                                Aqui podras chatear con el negocio,esta
                                conversacion solo se conservara hasta que el
                                pedido finalice
                            </h5>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="">
                                <div
                                    id="contenedorChat"
                                    :style="{ background: backgroundColor }"
                                >
                                    <beautiful-chat
                                        :alwaysScrollToBottom="
                                            alwaysScrollToBottom
                                        "
                                        :close="true"
                                        :colors="colors"
                                        :isOpen="true"
                                        :messageList="messageList"
                                        :messageStyling="messageStyling"
                                        :newMessagesCount="newMessagesCount"
                                        :onMessageWasSent="onMessageWasSent"
                                        :open="openChat"
                                        :participants="participants"
                                        :showCloseButton="true"
                                        :showLauncher="true"
                                        :showEmoji="true"
                                        :showFile="false"
                                        :showTypingIndicator="
                                            showTypingIndicator
                                        "
                                        :titleImageUrl="titleImageUrl"
                                        @onType="handleOnType"
                                        @edit="editMessage"
                                        @remove="removeMessage"
                                    >
                                        <template
                                            v-slot:text-message-toolbox="
                                                scopedProps
                                            "
                                        >
                                            <button
                                                v-if="
                                                    !scopedProps.me &&
                                                        scopedProps.message
                                                            .type === 'text'
                                                "
                                                @click.prevent="
                                                    like(scopedProps.message.id)
                                                "
                                            >
                                                👍
                                            </button>
                                        </template>
                                        <template
                                            v-slot:text-message-body="
                                                scopedProps
                                            "
                                        >
                                            <p
                                                class="sc-message--text-content"
                                                v-html="scopedProps.messageText"
                                            ></p>
                                            <p
                                                v-if="
                                                    scopedProps.message.data
                                                        .meta
                                                "
                                                class="sc-message--meta"
                                                :style="{
                                                    color:
                                                        scopedProps
                                                            .messageColors.color
                                                }"
                                            >
                                                {{
                                                    scopedProps.message.data
                                                        .meta
                                                }}
                                            </p>
                                            <p
                                                v-if="
                                                    scopedProps.message
                                                        .isEdited ||
                                                        scopedProps.message
                                                            .liked
                                                "
                                                class="sc-message--edited"
                                            >
                                                <template
                                                    v-if="
                                                        scopedProps.message
                                                            .isEdited
                                                    "
                                                    >✎</template
                                                >
                                                <template
                                                    v-if="
                                                        scopedProps.message
                                                            .liked
                                                    "
                                                    >👍</template
                                                >
                                            </p>
                                        </template>
                                    </beautiful-chat>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import LayoutDefault from "../components/layouts/Principal.vue";
import messageHistory from "./messageHistory";
import chatParticipants from "./chatProfiles";
import Header from "./Header.vue";
import Footer from "./Footer.vue";
import TestArea from "./TestArea.vue";
import availableColors from "./colors";
import VueTimepicker from 'vue2-timepicker'
import 'vue2-timepicker/dist/VueTimepicker.css'

export default {
    created: function() {
        this.getPedidos();
        this.select_estado();
        this.$emit("update:layout", LayoutDefault);
        this.setColor("blue");
    },
    computed: {
        linkColor() {
            return this.chosenColor === "dark"
                ? this.colors.sentMessage.text
                : this.colors.launcher.bg;
        },
        backgroundColor() {
            return this.chosenColor === "dark"
                ? this.colors.messageList.bg
                : "#fff";
        }
    },
    mounted() {
        this.messageList.forEach(x => (x.liked = false));
    },
    sockets: {
        connect() {
            // Fired when the socket connects.
            console.log("socket connected");
        },

        disconnect() {
            console.log("socket disconnected");
        }

        // Fired when the server sends something on the "messageChannel" channel.
    },

    data() {
        return {
            participants: [],
            titleImageUrl:
                "https://a.slack-edge.com/66f9/img/avatars-teams/ava_0001-34.png",
            messageList: messageHistory,
            newMessagesCount: 0,
            isChatOpen: false,
            showTypingIndicator: "",
            colors: null,
            availableColors,
            chosenColor: null,
            alwaysScrollToBottom: true,
            messageStyling: true,
            userIsTyping: false,
            id_pedido: 0,
            authorMensaje: "",

            fotoMiniatura: "",
            Pedidos: [],
            Datos_Pedidos: [],
            Combos: [],
            Detalles: [],
            Usuarios: [],
            arrayestados: [],
            arrayciudades: [],
            loading: true,
            newid_estado: "",
            newtelefono: "",
            newdireccion: "",
            errors: [],
            fillpedidos: {
                id: "",
                id_estado: "",
                tiempo_entrega: "",
                id_usuario: ""
            },
            timer: "",
            countTemp: 0
        };
    },

    methods: {
        getCanal() {},

        sendMessage(text) {
            if (text.length > 0) {
                this.newMessagesCount = this.isChatOpen
                    ? this.newMessagesCount
                    : this.newMessagesCount + 1;
                this.onMessageWasSent({
                    author: "support",
                    type: "text",
                    id: Math.random(),
                    data: { text }
                });
            }
        },
        handleTyping(text) {
            this.showTypingIndicator =
                text.length > 0
                    ? this.participants[this.participants.length - 1].id
                    : "";
        },
        onMessageWasSent(message) {
            var date = new Date();
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var ampm = hours >= 12 ? "pm" : "am";
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? "0" + minutes : minutes;
            var strTime = hours + ":" + minutes + " " + ampm;

            var dataSend = message.data;
            dataSend.meta = strTime;

            this.$socket.emit("pedidos", {
                authorMensaje: this.authorMensaje,
                id_usuario: this.Pedidos[0].id_negocio,
                canal: "canalPedido/" + this.id_pedido,
                mensaje: {
                    author: this.authorMensaje,
                    type: message.type,
                    id: Math.random(),
                    data: dataSend
                }
            });

            this.messageList = [
                ...this.messageList,
                Object.assign({}, message, { id: Math.random() })
            ];
        },
        openChat() {
            this.isChatOpen = true;
            this.newMessagesCount = 0;
        },
        closeChat() {
            this.isChatOpen = false;
        },
        setColor(color) {
            this.colors = this.availableColors[color];
            this.chosenColor = color;
        },
        showStylingInfo() {
            this.$modal.show("dialog", {
                title: "Info",
                text:
                    "You can use *word* to <strong>boldify</strong>, /word/ to <em>emphasize</em>, _word_ to <u>underline</u>, `code` to <code>write = code;</code>, ~this~ to <del>delete</del> and ^sup^ or ¡sub¡ to write <sup>sup</sup> and <sub>sub</sub>"
            });
        },
        messageStylingToggled(e) {
            this.messageStyling = e.target.checked;
        },
        handleOnType() {
            this.$root.$emit("onType");
            this.userIsTyping = true;
        },
        editMessage(message) {
            const m = this.messageList.find(m => m.id === message.id);
            m.isEdited = true;
            m.data.text = message.data.text;
        },
        removeMessage(message) {
            if (confirm("Delete?")) {
                const m = this.messageList.find(m => m.id === message.id);
                m.type = "system";
                m.data.text = "This message has been removed";
            }
        },
        like(id) {
            const m = this.messageList.findIndex(m => m.id === id);
            var msg = this.messageList[m];
            msg.liked = !msg.liked;
            this.$set(this.messageList, m, msg);
        },
        abrirChat(pedido) {
            this.messageList = [];
            //setiar participantes chat
            this.participants = [];
            var participante = new Object();
            participante.id = pedido.nombre_cliente;
            participante.name = pedido.nombre_cliente;
            participante.imageUrl = "fotos/" + pedido.foto_cliente;

            this.participants.push(participante);

            var participante = new Object();
            participante.id = pedido.nombre_negocio;
            participante.name = pedido.nombre_negocio;
            participante.imageUrl = "fotos-negocios/" + pedido.foto_negocio;
            this.authorMensaje = pedido.nombre_negocio;
            this.participants.push(participante);
            //

            let me = this;
            this.$http({
                url: "https://traelo-ve.com:3000/api/chatsCanal",
                method: "POST",
                data: {
                    canal: "canalPedido/" + pedido.id
                }
            })
                .then(response => {
                    console.log("CHATS");
                    console.log(response.data);

                    var arrayChats = response.data.chats;
                    if (arrayChats.length == 0) {
                        this.messageList = [];
                    } else {
                        for (var i = 0; i < arrayChats.length; i += 1) {
                            if (
                                this.Pedidos[0].id_negocio ==
                                arrayChats[i].id_dueno_mensaje
                            ) {
                                //es mi mensaje
                                //crear objecto mensaje
                                var mensaje = new Object();
                                mensaje.author = "me";
                                mensaje.type = arrayChats[i].mensaje.type;
                                mensaje.id = arrayChats[i].mensaje.id;
                                mensaje.data = arrayChats[i].mensaje.data;
                                this.messageList = [
                                    ...this.messageList,
                                    Object.assign({}, mensaje, {
                                        id: Math.random()
                                    })
                                ];
                            } else {
                                this.messageList = [
                                    ...this.messageList,
                                    Object.assign({}, arrayChats[i].mensaje, {
                                        id: Math.random()
                                    })
                                ];
                            }
                        }
                    }
                })
                .catch(error => {
                    console.log(error.response.data.code);
                    //this.errors = 'error.response.data'
                });

            //setiar chat

            // this.$socket.emit('unsubscribe',{canal:"canalPedido/"+this.id_pedido} )

            this.id_pedido = pedido.id;
            //  this.getCanal();

            if (this.countTemp == 0) {
                for (var i = 0; i < this.Pedidos.length; i += 1) {
                    console.log("id_pedido: " + this.Pedidos[i].id);
                    this.$socket.on(
                        "canalPedido/" + this.Pedidos[i].id,
                        function(data) {
                            console.log(data);
                            if (data.canal == "canalPedido/" + this.id_pedido) {
                                this.messageList = [
                                    ...this.messageList,
                                    Object.assign({}, data.mensaje, {
                                        id: Math.random()
                                    })
                                ];
                            }
                        }.bind(this)
                    );
                }

                this.countTemp = 1;
            }

            $("#modalChat").modal("show");

            //cargar Chat
        },

        select_estado() {
            let me = this;
            this.$http({
                url: "select_estado_pedido",
                method: "GET"
            })
                .then(response => {
                    me.arrayestados = response.data.estados;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },

        mytable() {
            setTimeout(function() {
                if (!$.fn.DataTable.isDataTable("#example")) {
                    $("#example").DataTable({
                        bFilter: true,
                        bInfo: false,
                        scrollX: false,
                        scrollCollapse: false,
                        paging: true,
                        pageLength: 10,
                        fixedColumns: true,
                        language: {
                            lengthMenu: "Mostrar _MENU_ Registros por pagina",
                            zeroRecords:
                                "No se encuentran acronimos - lo sentimos",
                            info:
                                "Mostrando la p&aacute;gina _PAGE_ de _PAGES_",
                            infoEmpty: "No hay registros disponibles",
                            infoFiltered:
                                "(Filtrado de _MAX_ Total de registros)",
                            search: "Búscar",
                            paginate: {
                                first: "Primero",
                                last: "Ãšltimo",
                                next: "Siguiente",
                                previous: "Anterior"
                            }
                        }
                    });
                }
            }, 800);
        },

        getPedidos() {
            let me = this;
            this.$http({
                url: "auth/pedido_negocios",
                method: "GET"
            })
                .then(response => {
                    me.Pedidos = response.data;
                    me.mytable();
                    me.loading = false;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },

        editPedidos(pedido) {
            this.fillpedidos.id = pedido.id;
            this.fillpedidos.id_estado = pedido.id_estado;
            this.fillpedidos.tiempo_entrega = pedido.tiempo_entrega;
            this.fillpedidos.valor_total = pedido.valor_total;
            this.fillpedidos.id_usuario = pedido.id_usuario;

            let id = this.fillpedidos.id;
            let id_usuario = this.fillpedidos.id_usuario;
            let me = this;
            this.$http({
                url: "auth/search_detalle_pedido/" + id,
                method: "GET"
            })
                .then(response => {
                    me.Detalles = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });

            this.$http({
                url: "auth/datos_cliente/" + id_usuario,
                method: "GET"
            })
                .then(response => {
                    me.Usuarios = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });

            this.$http({
                url: "auth/datos_pedido/" + id,
                method: "GET"
            })
                .then(response => {
                    me.Datos_Pedidos = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });

            this.$http({
                url: "auth/datos_combo/" + id,
                method: "GET"
            })
                .then(response => {
                    me.Combos = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });

            $("#edit").modal("show");
        },

        updatePedidos(id) {
            this.$swal({
                title: "Cargando!",
                text: "Espere un momento por favor..",
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showCancelButton: false,
                showConfirmButton: false,
                imageUrl: "img/spinner.gif",
                onOpen: () => {
                    swal.showLoading();
                }
            });

            var tiempoEntrega ="";
            if (this.fillpedidos.tiempo_entrega){
            var tiempoEntrega = parseInt(this.fillpedidos.tiempo_entrega.HH)+" Horas "+this.fillpedidos.tiempo_entrega.mm+" Minutos";
            }


            if (this.fillpedidos.id_estado=="3"&& tiempoEntrega==""){

                     this.$swal({
                    type: 'error',
                    title: 'Debes escoger un tiempo de entrega del pedido.',
                    text: 'Por favor verifica los datos',
                    });
            }

            else{
           this.$http({
                url: "auth/pedido_negocios/" + id,
                method: "PUT",
                data: {
                    id_estado: this.fillpedidos.id_estado,
                    tiempo_entrega:tiempoEntrega
                }
            })
                .then(response => {
                    this.getPedidos();
                    this.errors = [];
                    this.fillpedidos.tiempo_entrega = '';

                    console.log(response.data);
                    $("#edit").modal("hide");
                    if ($(".modal-backdrop").is(":visible")) {
                        $("body").removeClass("modal-open");
                        $(".modal-backdrop").remove();
                    }
                    this.$swal(
                        "Actualizado",
                        "Estado de Pedido actualizado con éxito.",
                        "success"
                    );
                })
                .catch(function(error) {
                    console.log(error);
                });

        }


        },

        deletePedidos(pedido) {
            this.$swal({
                title: "Está seguro de Rechazar este pedido?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#00BFF3",
                cancelButtonColor: "#d33",
                confirmButtonText: "Aceptar!",
                cancelButtonText: "Cancelar",
                confirmButtonClass: "btn btn-info",
                cancelButtonClass: "btn btn-danger",
                buttonsStyling: false,
                reverseButtons: true
            }).then(result => {
                if (result.value) {
                    this.$swal({
                        title: "Cargando!",
                        text: "Espere un momento por favor..",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                        showCancelButton: false,
                        showConfirmButton: false,
                        imageUrl: "img/spinner.gif",
                        onOpen: () => {
                            swal.showLoading();
                        }
                    });

                    this.$http({
                        url: "auth/pedido_negocios/" + pedido.id,
                        method: "DELETE"
                    })
                        .then(response => {
                            this.getPedidos();
                            this.$swal(
                                "Eliminado!",
                                "El Pedido Ha sido rechazado, se notidficara al cliente.",
                                "success"
                            );
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                }
            });
        },

        changePage: function() {
            this.getPedidos();
        }
    },

    components: {

        VueTimepicker

        },
};
</script>

<style scoped>
@media (min-width: 1200px) {
    .sc-message {
        width: 682px !important;
        margin: auto;
        padding-bottom: 10px;
        display: -webkit-box;
        display: flex;
    }
}

sc-message--meta {
    font-size: xx-small;
    margin-bottom: 0px;
    text-align: center;
    color: #bebebe !important;
}


.modal-content {
    height: 500px;
}

th,
td {
    text-align: center;
}

.btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
}

#scrol {
    overflow: scroll;
    height: 30px !important;
}
.parpadea {

  animation-name: parpadeo;
  animation-duration: 3s;
  animation-timing-function: linear;
  animation-iteration-count: infinite;

  -webkit-animation-name:parpadeo;
  -webkit-animation-duration: 3s;
  -webkit-animation-timing-function: linear;
  -webkit-animation-iteration-count: infinite;
}

@-moz-keyframes parpadeo{
  0% { opacity: 1.0; }
  50% { opacity: 0.0; }
  100% { opacity: 1.0; }
}

@-webkit-keyframes parpadeo {
  0% { opacity: 1.0; }
  50% { opacity: 0.0; }
   100% { opacity: 1.0; }
}

@keyframes parpadeo {
  0% { opacity: 1.0; }
   50% { opacity: 0.0; }
  100% { opacity: 1.0; }
}

</style>
