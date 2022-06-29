<template>
    <div>
        <div class="content-wrapper">
            <div class="row">

            <div class=" col-md-12 ">
				<div class="media align-items-center bg-white mb-20">
				  <span class="avatar  bg-primary"><i class="ti-ticket"></i></span>
				  <div class="media-body">
					<h3><strong class="fuente-movil">Aquí tienes tus pedidos Realizados ve!</strong></h3>
				  </div>
				</div>
			</div>

            </div>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <td
                        v-for="pedido in Pedidos"
                        v-bind:key="pedido.id"
                        class="col-md-3"
                    >
                        <div class="box box-solid bg-primary">
                            <div class="box-header">
                                <h4 class="box-title">
                                    <strong>{{ pedido.nombre_negocio }}</strong>
                                </h4>
                            </div>
                            <div class="box-body">
                                <center>
                                    <img
                                        :src="'fotos-negocios/' + pedido.foto"
                                        height="150"
                                        width="150"
                                    />
                                </center>

                                <label style="font-weight: 800;"
                                    >Estado: {{ pedido.nombre_estado }} -  <label>Fecha:
                                    {{ pedido.fecha }} </label>
                                </label>
                                <br />
                                 <label
                                    >Consecutivo No:
                                   <label style="font-weight: 800; font-size:16px"> {{ pedido.id }} </label>
                                </label>

                                <br />
                                <label
                                    >Tiempo de Entrega:
                                    {{ pedido.tiempo_entrega }}
                                </label>
                                <br /><br />
                                <strong>Datos del Negocio</strong><br />
                                <label
                                    >Direccion: {{ pedido.direccion_negocio }} -
                                </label>
                                <label
                                    >Telefono: {{ pedido.telefono_negocio }}
                                </label>
                                <br />
                                <button
                                    type="button"
                                    class="btn btn-success btn-rounded"
                                    data-toggle="modal tooltip"
                                    data-placement="top"
                                    title="Editar"
                                    v-on:click.prevent="editPedidos(pedido)"
                                >
                                    <i class="fa fa-eye">Ver</i>
                                </button>
                                &nbsp;
                                <button
                                    type="button"
                                    class="btn bg-ro btn-rounded parpadea"
                                    data-toggle="modalChat tooltip"
                                    data-placement="top"
                                    title="Editar"
                                    v-on:click.prevent="abrirChat(pedido)"
                                >
                                    <i class="fa fa-comment"> Chat</i>
                                </button>
                                &nbsp;
                            </div>
                        </div>
                    </td>
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
                    <div class="modal-content">
                        <div class="modal-header bg-mo">
                            <h5 class="modal-title">
                             Detalle del pedido
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
                                                            Descripcion
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
                                                            {{
                                                                combo.valor_combo | format-thousands
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
                                                            {{
                                                                detalle.valor_producto | format-thousands
                                                            }}
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
                                        {{ pedido.valor_total | format-thousands }}
                                    </h4>
                                </div>
                                <br />
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
                            <h6 class="modal-title">
                                Aqui podras chatear con el negocio,esta
                                conversacion solo se conservara hasta que el
                                pedido finalice
                            </h6>
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
"use strict";
import LayoutDefault from "../components/layouts/Principal.vue";
import messageHistory from "./messageHistory";
import chatParticipants from "./chatProfiles";
import Header from "./Header.vue";
import Footer from "./Footer.vue";
import TestArea from "./TestArea.vue";
import availableColors from "./colors";

export default {
    components: {
        Header,
        Footer,
        TestArea
    },
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

        //crear canales

        this.Pedidos.map(function(num) {
            console.log(num);
        });
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
            authorMensaje: "",

            idPedido: 0,
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
                id_usuario: this.Pedidos[0].id_usuario,
                canal: "canalPedido/" + this.id_pedido,
                mensaje: {
                    author: this.authorMensaje,
                    type: message.type,
                    id: Math.random(),
                    data: dataSend
                }
            });
            // console.log("emitir al canal: "+this.id_pedido);
            console.log(message);

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
            }, 500);
        },

        getPedidos() {
            let me = this;
            this.$http({
                url: "auth/pedido_clientes",
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


        abrirChat(pedido) {
            console.log("imprimir pedido: ");
            console.log(pedido);
            this.participants = [];
            var participante = new Object();
            participante.id = pedido.nombre_negocio;
            participante.name = pedido.nombre_negocio;
            participante.imageUrl = "fotos-negocios/" + pedido.foto;
            this.participants.push(participante);

            var participante = new Object();
            participante.id = pedido.nombre_cliente;
            participante.name = pedido.nombre_cliente;
            participante.imageUrl = "fotos/" + pedido.foto_cliente;
            this.authorMensaje = pedido.nombre_cliente;
            this.participants.push(participante);

            this.messageList = [];
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
                                this.Pedidos[0].id_usuario ==
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

            this.$http({
                url: "auth/pedido_negocios/" + id,
                method: "PUT",
                data: {
                    id_estado: this.fillpedidos.id_estado,
                    tiempo_entrega: this.fillpedidos.tiempo_entrega
                }
            })
                .then(response => {
                    this.getPedidos();
                    this.errors = [];

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
    }
};
</script>

<style scoped>


@media only screen and (min-width: 300px) and (max-width: 710px) {


    .fuente-movil{
    font-size: 10px;
    }



  }

.bg-info {
    background-color: #406984 !important;
    color: #fff;
}
@media (min-width: 992px) {
}

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
.sc-launcher {
    .sc-message {
        width: 682px !important;
        margin: auto;
        padding-bottom: 10px;
        display: -webkit-box;
        display: flex;
    }
    width: 0px !important;
    height: 0px !important;
    background-position: center;
    background-repeat: no-repeat;
    position: absolute;
    right: 0px;
    bottom: 26px;
    border-radius: 50%;
    box-shadow: none;
    -webkit-transition: box-shadow 0.2s ease-in-out;
    transition: box-shadow 0.2s ease-in-out;
    cursor: pointer;
}

.sc-chat-window{
    width: -webkit-fill-available !important;
    height: calc(100% - 159px);
    max-height: initial;
    position: fixed !important;
    right: 0px !important;
    bottom: 100px;
    box-sizing: border-box;
    box-shadow: 0px 7px 40px 2px rgba(148, 149, 150, 0.1);
    background: white;
    display: -webkit-box;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    flex-direction: column;
    -webkit-box-pack: center;
    justify-content: space-between;
    -webkit-transition: 0.3s ease-in-out;
    transition: 0.3s ease-in-out;
    border-radius: 10px;
    font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
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
#up {
}

* {
    font-family: Avenir Next, Helvetica Neue, Helvetica, sans-serif;
}

.demo-description {
    max-width: 500px;
}

.demo-description img {
    max-width: 500px;
}

.demo-test-area {
    width: 300px;
    box-sizing: border-box;
}

.demo-test-area--text {
    box-sizing: border-box;
    width: 100%;
    margin: 0px;
    padding: 0px;
    resize: none;
    font-family: Avenir Next, Helvetica Neue, Helvetica, sans-serif;
    background: #fafbfc;
    color: #8da2b5;
    border: 1px solid #dde5ed;
    font-size: 16px;
    padding: 16px 15px 14px;
    margin: 0;
    border-radius: 6px;
    outline: none;
    height: 150px;
    margin-bottom: 10px;
}

.demo-monster-img {
    width: 400px;
    display: block;
    margin: 60px auto;
}

.text-center {
    text-align: center;
}

.colors a {
    color: #fff;
    text-decoration: none;
    padding: 4px 10px;
    border-radius: 10px;
}

.toggle a {
    text-decoration: none;
}

.messageStyling {
    font-size: small;
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
