<template>
    <div>
        <div class="content-wrapper">

             <div class="row">

            <div class=" col-md-12 ">
				<div class="media align-items-center bg-white mb-20">
				  <span class="avatar  bg-primary"><i class="fa fa-home"></i></span>
				  <div class="media-body">
					<h3><strong class="fuente-movil">Pide lo que quieras ve!</strong></h3>
				  </div>
				</div>
			</div>

            </div>

            <!-- Main content -->
            <section class="content">
                <div class="row">



          <div class="col-md-6 col-lg-4 centrar" >
            <div class="box">
              <div class="text-white box-body bg-img text-center py-30" style="background-image: url(images/fondo-negocios-cliente.png);">
                <div class="flexbox">
                  <a href="#">
                    <img class="avatar avatar-xxl avatar-bordered" :src="'fotos-negocios/' + this.foto" alt="">
                  </a>
                  <div class="flex-grow pl-20">
                    <h4><a class="text-white" href="#">{{this.nombre}} </a></h4>
                    <div><i class="fa fa-fw fa-map-marker w-20px"></i> {{this.direccion}}</div>
                    <div><i class="fa fa-fw fa-clock-o w-20px"></i> {{ this.hora_apertura }} - {{ this.hora_cierre }}</div>
                    <br>
                    <router-link :to="{name: 'cliente_negocios'}" >
                        <button

                                type="button"
                                class="btn btn-danger btn-rounded"

                            >
                                <i class=" ti-arrow-left"></i>&nbsp;&nbsp;Atrás


                        </button>
                    </router-link>
                    &nbsp;
                    <button
                            type="button"
                            class="btn btn-success btn-rounded"
                            data-toggle="modal"
                            data-target="#modalCarrito"
                        >
                            <i class="fa fa-cart-plus"></i>&nbsp;&nbsp;{{
                                numPedidos
                            }}
                    </button>

                  </div>
                </div>
              </div>

            </div>
          </div>


                </div>

                <div class="row">

		<div class="col-12 col-lg-12">
          <div class="box">

            <div class="box-header with-border bg-mo">
              <div class="row">
                    <div class="col-md-6 ">


                    </div>

                    <div class="col-md-2">
                        <h4>Combos</h4>
                    </div>

                    <div class="col-md-2">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Buscar Combos"
                            v-model="textSearch2"
                        />
                    </div>

              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <div class="row">
                <div  class="horizontal-scroll-contenedorProductos">

                            <div class="col-xl-3 col-md-6 col" v-for="combo in combosFilter" v-bind:key="combo.id">
                                <div class="info-box">

                                     <a
                                        data-toggle="modal"
                                        data-target="#modalCombo"
                                        v-on:click="
                                            abrirPanelCombo(
                                                {
                                                    nombre: combo.nombre,
                                                    id: combo.id,
                                                    foto: combo.foto,
                                                    valor: combo.valor,
                                                    descripcion: combo.descripcion,
                                                },
                                                $event
                                            )
                                        "
                                    >

                                    <img class="info-box-icon bg-ro rounded-circle" :src="'fotos-productos/' + combo.foto" alt="">

                                    <div class="info-box-content ocultar">
                                    <span class="info-box-number">${{ combo.valor | format-thousands}}</span>
                                    <span class="info-box-text">{{ combo.nombre}}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                    </a>
                                </div>
                                     <span class="info-box-number mostrar">${{ combo.valor | format-thousands}}</span>
                                    <span class=" mostrar">{{ combo.nombre}}</span>
                                <!-- /.info-box -->
                                </div>
                </div>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

	  </div>


        <div class="row">


            <div class="col-12 col-lg-12">
          <div class="box">

            <div class="box-header with-border bg-mo">
              <div class="row">
                    <div class="col-md-6 ">


                    </div>

                    <div class="col-md-2">
                        <h4>Productos</h4>
                    </div>

                    <div class="col-md-2">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Buscar Productos"
                            v-model="textSearch"
                        />
                    </div>

                    <div class="col-md-2">
                        <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"
                                        ><i class="fa fa-shopping-basket"></i
                                    ></span>
                                </div>
                                <select
                                    class="custom-select"
                                    v-model="id_categoriaSelect"
                                    v-on:click.prevent="getProductos()"
                                >
                                    <option value="0">Todas</option>
                                    <option
                                        v-for="categoria in arrayCategoriasNegocio"
                                        :key="categoria.id"
                                        :value="categoria.id"
                                        >{{ categoria.nombre }}</option
                                    >
                                </select>
                            </div>
                    </div>

              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <div class="row">
                <div  class="horizontal-scroll-contenedorProductos">

                            <div class="col-xl-3 col-md-6 col" v-for="producto in productosFilter" v-bind:key="producto.id">
                                <div class="info-box">

                                     <a
                                        data-toggle="modal"
                                        data-target="#modalProducto"
                                        v-on:click="
                                            abrirPanelProducto(
                                                {
                                                    nombre: producto.nombre,
                                                    id: producto.id,
                                                    foto: producto.foto,
                                                    valor: producto.valor,
                                                    descripcion: producto.descripcion
                                                },
                                                $event
                                            )
                                        "
                                    >

                                    <img class="info-box-icon bg-ro rounded-circle" :src="'fotos-productos/' + producto.foto" alt="">

                                    <div class="info-box-content ocultar">
                                    <span class="info-box-number">${{ producto.valor | format-thousands}}</span>
                                    <span class="info-box-text">{{ producto.nombre}}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                    </a>
                                </div>
                                <span class="info-box-number mostrar">${{ producto.valor | format-thousands}}</span>
                                    <span class=" mostrar">{{ producto.nombre}}</span>
                                <!-- /.info-box -->
                                </div>

                    </div>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>



        </div>


            </section>



        </div>

        <form method="POST" v-on:submit.prevent="agregarCombosCarro">
            <!-- Modal agregar combo al carrito -->
            <div
                class="modal fade bs-example-modal-md"
                tabindex="-1"
                role="dialog"
                aria-labelledby="myLargeModalLabel"
                aria-hidden="true"
                style="display: none;"
                id="modalCombo"
            >
                <div
                    id="cuerpoModalAgregarProducto"
                    class="modal-dialog modal-md"
                >
                    <div class="modal-content" style="margin-top: 184px;">
                        <div class="modal-header bg-mo">
                            <h5 id="tituloCombo" class="modal-title">
                                {{ tituloCombo }}
                            </h5>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div  class="modal-body">

                            <div class="row">
                                <div class="col-md-6 centrar">
                                    <div class="card">
                                        <img class="card-img-top img-responsive" :src="'fotos-productos/' + fotoCombo" alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title" style="text-align:center;">${{ valorCombo | format-thousands}}</h4>
                                            <p class="card-text" style="text-align:center;">{{ descripcionCombo}}</p>

                                        </div>
                                        <!-- /.card-body -->
                                    </div>

                                </div>
                            </div>

                        </div>

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
                                Anadir al carrito
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal -->
        </form>

        <form method="POST" v-on:submit.prevent="agregarProductoCarro">
            <!-- Modal agregar productos al carrito -->
            <div
                class="modal fade bs-example-modal-md"
                tabindex="-1"
                role="dialog"
                aria-labelledby="myLargeModalLabel"
                aria-hidden="true"
                style="display: none;"
                id="modalProducto"
            >
                <div
                    id="cuerpoModalAgregarProducto"
                    class="modal-dialog modal-md"
                >
                    <div class="modal-content" style="margin-top: 141px;">
                        <div class="modal-header bg-mo">
                            <h5 id="tituloProducto" class="modal-title">
                                {{ tituloProducto }}
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

                            <div class="row">
                                <div class="col-md-6 centrar">
                                    <div class="card">
                                        <img class="card-img-top img-responsive" :src="'fotos-productos/' + fotoProducto" alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title" style="text-align:center;">${{ valorProductoTemporal | format-thousands}}</h4>
                                            <p class="card-text" style="text-align:center;">{{ descripcionProducto}}</p>

                                                <label for="nombre">Cantidad</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"
                                                            ><i class=""></i
                                                        ></span>
                                                    </div>
                                                    <input
                                                        id="nombre"
                                                        type="text"
                                                        class="form-control"
                                                        v-model="cantidadProductoTemporal"
                                                    />
                                                </div>

                                        </div>
                                        <!-- /.card-body -->
                                    </div>

                                </div>
                            </div>

                        </div>

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
                                Anadir al carrito
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal -->
        </form>


            <!-- Modal Carrito de compras -->
            <div
                class="modal fade bs-example-modal-lg"
                tabindex="-1"
                role="dialog"
                aria-labelledby="myLargeModalLabel"
                aria-hidden="true"
                style="display: none;"
                id="modalCarrito"
            >
                <div
                    id="cuerpoModalAgregarProducto"
                    class="modal-dialog modal-lg"
                >
                    <div class="modal-content" style="margin-top: 141px;">
                        <div class="modal-header bg-mo">
                            <h5 id="tituloProducto" class="modal-title">
                                Carrito de compras
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
                            <div class="row">
                                <div class="margincenter">
                                    <h4>Total</h4>
                                    <br />
                                    <h5>${{ TotalPedido | format-thousands }}</h5>
                                </div>
                            </div>

                            <div class="row centrar">
                                <!--Tabla productos y combos -->
                                <div
                                    id="contenedorTablaCarrito"
                                    class="box-body"
                                    style="
                                        margin-left: -37px;
                                        overflow-x: auto;
                                    "
                                >
                                    <div class="table-responsive" ref="table" >
                                        <table class="table mb-0 " id="example">
                                            <thead class="bg-mo">
                                                <tr>
                                                    <th scope="col">Foto</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Precio</th>
                                                    <th scope="col">
                                                        Cantidad
                                                    </th>
                                                    <th scope="col">Valor total del pedido</th>
                                                    <th scope="col">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr
                                                    v-for="producto in ArrayCarrito"
                                                    v-bind:key="producto[0].id"
                                                >
                                                    <td>
                                                        <center>
                                                            <img
                                                                :src="
                                                                    'fotos-productos/' +
                                                                    producto[0]
                                                                        .foto
                                                                "
                                                                class = "avatar avatar-xl avatar-bordered"
                                                            />
                                                        </center>
                                                    </td>
                                                    <td class="td-style">
                                                        {{ producto[0].nombre }}
                                                    </td>
                                                    <td class="td-style">
                                                        {{ producto[0].valor | format-thousands }}
                                                    </td>
                                                    <td class="td-style">
                                                        {{
                                                            producto[0].cantidad
                                                        }}
                                                    </td>
                                                    <td class="td-style">
                                                        {{ producto[0].total | format-thousands}}
                                                    </td>
                                                    <td>
                                                        <button
                                                            type="button"
                                                            class="btn btn-danger btn-rounded"
                                                            data-toggle="modal tooltip"
                                                            data-placement="top"
                                                            title="Eliminar"
                                                            v-on:click.prevent="
                                                                deleteProductos(
                                                                    producto
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="fa fa-trash"
                                                            ></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <hr class="my-15">

                                    <div class="row margincenter">

                                        <div class="col-md-12">
                                            <h5>Elige el método de pago</h5>

                                        </div>

                                    </div>
                                    <br>

                                    <div class="row margincenter">
                                        <div class="col-md-1"></div>

                                        <div class="col-md-4">
                                            <div class="checkbox">
                                                <input type="checkbox" id="basic_checkbox_1" :value="1" v-model="check_pago_efectivo" @click="deshabilitar_pago_electronico()" />
                                                <label for="basic_checkbox_1" class="cambio-color" >Pago en efectivo</label>

                                                <img src="images/medios-pago2.png" class="img-pagos2">
                                                </div>

                                        </div>

                                        <div class="col-md-3"></div>

                                        <div class="col-md-4" v-show="this.ValidarpagoElectronico">
                                            <div class="checkbox">
                                                <input type="checkbox" id="basic_checkbox_2"  :value="1" v-model="check_pago_electronico" @click="deshabilitar_pago_efectivo()" />
                                                <label for="basic_checkbox_2" class="cambio-color" >Pago electrónico</label>
                                                    <img src="images/medios-pago.png" class="img-pagos">
                                                </div>

                                        </div>
                                    </div>

                                <div class="row margincenter">
                                    <p>Nota: El valor del pedido no incluye el costo del domicilio, este debe ser acordado con el vendedor luego de realizar el pedido</p>
                                </div>




                                </div>
                            </div>
                        </div>

                        <!--botones -->
                        <div class="modal-footer modal-footer-uniform">
                            <button
                                type="button"
                                class="btn btn-bold btn-pure btn-secondary btn-rounded"
                                data-dismiss="modal"
                            >
                                Cerrar
                            </button>

                            <button
                            @click.prevent="generarPedido()"
                                type="submit"
                                class="btn btn-bold btn-pure btn-success float-right btn-rounded"
                            >
                                Generar Pedido
                            </button>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal -->

    </div>
</template>




<script>
"use strict";
import LayoutDefault from "../components/layouts/Principal.vue";
import carousel from "vue-owl-carousel";

export default {
    created: function () {

        this.$emit("update:layout", LayoutDefault);

        this.ValidarpagoElectronico();

    },

    props:['id', 'nombre', 'direccion', 'foto', 'hora_apertura', 'hora_cierre', 'check_key_wompi', 'key_wompi'],

    computed: {
        edit_foto() {
            return this.editfotoMiniatura;
        },

        productosFilter: function () {
            var textSearch = this.textSearch;
            return this.ArrayProductos.filter(function (el) {
                return (
                    el.nombre
                        .toLowerCase()
                        .indexOf(textSearch.toLowerCase()) !== -1
                );
            });
        },

        combosFilter: function () {
            var textSearch2 = this.textSearch2;
            return this.ArrayCombos.filter(function (el) {
                return (
                    el.nombre
                        .toLowerCase()
                        .indexOf(textSearch2.toLowerCase()) !== -1
                );
            });
        },


    },
    mounted: function () {

        this.getProductos();
        this.getCombos();
        this.getCategoriasNegocio();
    },
    components: { carousel },
    data() {
        return {
            id_categoriaSelect: 0,
            textSearch: "",
            textSearch2: "",
            ArrayCarrito: [],
            ArrayProductos: [],
            ArrayCombos: [],
            Categorias: [],
            Negocios: [],
            loading: true,
            newnombre: "",
            newdescripcion: "",
            newid_negocio: "",
            errors: [],
            fillCategorias: { nombre: "", descripcion: "" },
            timer: "",
            tituloCombo: "",
            descripcionCombo : "",
            idComboTemporal: "",
            fotoCombo: "",
            valorCombo: "",
            inputValorCombo: 0,
            TotalPedido: 0,
            tituloProducto: "",
            descripcionProducto: "",
            idProductoTemporal: "",
            fotoProducto: "",
            valorProductoTemporal: "",
            cantidadProductoTemporal: 1,
            numPedidos: 0,
            arrayCategoriasNegocio: [],
            validar_pago_electronico: false,
            check_pago_electronico: false,
            check_pago_efectivo: false,
            res_id_pedido: '',
            Transaction: ''


        };
    },

    methods: {

        deshabilitar_pago_electronico(){

            this.check_pago_electronico = false;


      },

      deshabilitar_pago_efectivo(){

        this.check_pago_efectivo = false;

      },

        getCategoriasNegocio() {
            let me = this;
            this.$http({
                url: "auth/getCategoriasNegocios",
                method: "POST",
                data: {
                    id_: 0,
                    id_negocio: this.id
                },
            })
                .then((response) => {
                    me.arrayCategoriasNegocio = response.data;
                })
                .catch((error) => {
                    console.log(error.response.data.code);
                    //this.errors = 'error.response.data'
                });
        },

        ValidarpagoElectronico(){

            if( this.check_key_wompi == 1){

                this.validar_pago_electronico = true;
            }

        },




        generarPedido() {

            var me = this;


            if (this.TotalPedido == 0) {
                        this.$swal({
                            type: "error",
                            title: "Debes agregar al menos 1 producto al carrito",

                        });
            }


            else if( (this.check_pago_efectivo == false) && (this.check_pago_electronico == false) ) {

                this.$swal({
                    type: 'error',
                    title: 'Tipo de pago',
                    text: 'Debes seleccionar un método de pago'
                    })

            }

             var x = new Date();
            var y = x.getFullYear().toString();
            var m = (x.getMonth() + 1).toString();
            var d = x.getDate().toString();
            (d.length == 1) && (d = '0' + d);
            (m.length == 1) && (m = '0' + m);
            var yyyymmdd = y +"-"+ m +"-" + d;


            if( this.check_pago_efectivo == true){

                this.$swal({
                title: 'Cargando!',
                text: 'Espere un momento por favor..',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showCancelButton: false,
                showConfirmButton: false,
                imageUrl: "img/spinner.gif",
                onOpen: () => {
                    swal.showLoading()
                }
                });


                this.$http({
                url: "auth/generarPedido",
                method: "POST",
                data: {
                    arrayCarrito: JSON.stringify(this.ArrayCarrito),
                    valor: this.TotalPedido,
                    id_negocio:this.id,
                    pago_electronico:0,
                    fecha: yyyymmdd

                },
            })
                .then((response) => {

                    $("#modalCarrito").modal("hide");
                    if ($(".modal-backdrop").is(":visible")) {
                        $("body").removeClass("modal-open");
                        $(".modal-backdrop").remove();
                    }

                    this.$swal(
                        "Creado",
                        "Pedido creado con éxito,revisa el panel de pedidos para ver el estado del pedido",
                        "success"
                    );
                    this.ArrayCarrito = [];
                    this.TotalPedido = 0;
                    this.numPedidos = 0;
                    this.check_pago_efectivo = false;
                })
                .catch((error) => {

                    if (error.response.data.code == 3)
                        this.$swal({
                            type: "error",
                            title: "error intentando guardar el pedido",

                        });
                });


            }else if( this.check_pago_electronico == true ){



                this.$http({
                url: "auth/generarPedido",
                method: "POST",
                data: {
                    //id_pago: transaction.id,
                    //object_pago: JSON.stringify(transaction),
                    arrayCarrito: JSON.stringify(this.ArrayCarrito),
                    valor: this.TotalPedido,
                    id_negocio:this.id,
                    fecha: yyyymmdd,
                    pago_electronico: 1

                },
                })
                .then((response) => {

                    this.check_pago_electronico = false;

                    this.res_id_pedido = response.data.id_pedido;


                    var amount = this.TotalPedido.toString() + '00';
                    var reference = this.res_id_pedido.toString();
                    var publicKey = this.key_wompi.toString();

                    var checkout = new WidgetCheckout({
                    currency: 'COP',
                    amountInCents: amount,
                    reference: reference,
                    publicKey: publicKey,
                    redirectUrl: 'https://traelo-ve.com/pedido_clientes' // Opcional
                    })

                    checkout.open(function ( result ) {


                        var transaction = result.transaction

                        console.log('Transaction ID: ', transaction.id)
                        console.log('Transaction object: ', transaction)

                        let url = 'pago-electronico-tarjeta'

                        me.$axios.post(url,{

                                data:{

                                    status: transaction.status,
                                    reference: transaction.reference,
                                    id: transaction.id,
                                }


                        })
                            .then((response) => {


                            })
                            .catch((error) => {

                            })

                        if( transaction.status == 'APPROVED'){

                                this.$swal(
                                    "Creado",
                                    "Pedido creado con éxito,revisa el panel de pedidos para ver el estado del pedido",
                                    "success"
                                );

                                const redirectTo = 'pedido_clientes'
                                this.$router.push({name: redirectTo})


                        }




                        })


            })
            .catch((error) => {

            });


            }





        },




        agregarProductoCarro() {
            var existe = "";
            this.ArrayCarrito.forEach((element) => {
                element.forEach((element) => {
                    if (element.nombre == this.tituloProducto) {
                        existe = "si";
                    }
                });
            });

            if (existe == "si") {
                $("#modalProducto").modal("hide");
                if ($(".modal-backdrop").is(":visible")) {
                    $("body").removeClass("modal-open");
                    $(".modal-backdrop").remove();
                }

                this.$swal("error", "Existe producto en la canasta", "success");
            } else {
                var arrayTemp = [];
                var producto = new Object();
                producto.id = this.idProductoTemporal;
                producto.nombre = this.tituloProducto;
                producto.foto = this.fotoProducto;
                producto.id_combo = "null";
                producto.valor = this.valorProductoTemporal;
                producto.cantidad = this.cantidadProductoTemporal;
                producto.total = this.cantidadProductoTemporal * this.valorProductoTemporal;

                arrayTemp.push(producto);
                this.ArrayCarrito.push(arrayTemp);
                console.log(this.ArrayCarrito);
                this.TotalPedido = this.TotalPedido + producto.total;
                this.numPedidos = this.ArrayCarrito.length;
                $("#modalProducto").modal("hide");
                if ($(".modal-backdrop").is(":visible")) {
                    $("body").removeClass("modal-open");
                    $(".modal-backdrop").remove();
                }
                // this.mytable();
            }
        },
        agregarCombosCarro() {
            var existe = "";
            this.ArrayCarrito.forEach((element) => {
                element.forEach((element) => {
                    if (element.nombre == this.tituloCombo) {
                        existe = "si";
                    }
                });
            });

            if (existe == "si") {
                $("#modalProducto").modal("hide");
                if ($(".modal-backdrop").is(":visible")) {
                    $("body").removeClass("modal-open");
                    $(".modal-backdrop").remove();
                }

                this.$swal("error", "Existe Combo en la canasta", "success");
            } else {
                var arrayTemp = [];
                var combo = new Object();
                combo.id = this.idComboTemporal;
                combo.nombre = this.tituloCombo;
                combo.foto = this.fotoCombo;
                combo.id_combo = this.idComboTemporal;
                combo.valor = this.valorCombo;
                combo.cantidad = 1;
                combo.total = this.valorCombo;
                arrayTemp.push(combo);
                this.ArrayCarrito.push(arrayTemp);
                console.log(this.ArrayCarrito);
                this.TotalPedido = this.TotalPedido + this.valorCombo;
                this.numPedidos = this.ArrayCarrito.length;

                $("#modalCombo").modal("hide");
                if ($(".modal-backdrop").is(":visible")) {
                    $("body").removeClass("modal-open");
                    $(".modal-backdrop").remove();
                }
                //  this.mytable();
            }
        },

        abrirPanelProducto: function (objProducto, event) {
            // ahora tenemos acceso al evento nativo.
            if (event) event.preventDefault();
            //alert(message)
            this.tituloProducto = objProducto.nombre;
            this.idProductoTemporal = objProducto.id;
            this.fotoProducto = objProducto.foto;
            this.valorProductoTemporal = objProducto.valor;
            this.descripcionProducto = objProducto.descripcion;
        },
        abrirPanelCombo: function (objcombo, event) {
            // ahora tenemos acceso al evento nativo.
            if (event) event.preventDefault();
            //alert(message)
            this.tituloCombo = objcombo.nombre;
            this.idComboTemporal = objcombo.id;
            this.fotoCombo = objcombo.foto;
            this.valorCombo = objcombo.valor;
            this.descripcionCombo = objcombo.descripcion;
        },
        getProductos() {



            let me = this;
            this.$http({
                url: "auth/obtenerProductosNegocio",
                method: "POST",
                data: {
                    id_categoriaSelect: this.id_categoriaSelect,
                    id_negocio: this.id
                },
            })
                .then((response) => {
                    me.ArrayProductos = response.data;
                    cosole.log("listado productos");
                    console.log(response.data);

                })
                .catch((error) => {
                    console.log(error.response.data.code);
                });
        },
        getCombos() {
            let me = this;
            this.$http({
                url: "auth/obtenerCombosNegocio",
                method: "POST",
                data: {
                    //id_categoria: this.newid_categoria,
                    //id_ciudad: this.newid_ciudad,
                    id_negocio: this.id

                },
            })
                .then((response) => {
                    me.ArrayCombos = response.data;
                })
                .catch((error) => {
                    console.log(error.response.data.code);
                    //this.errors = 'error.response.data'
                });
        },
        deleteProductos(producto) {
            var existe = "";
            var cont = 0;
            var indexEncontrado = 0;
            this.ArrayCarrito.forEach((element) => {
                element.forEach((element) => {
                    if (element.nombre == producto[0].nombre) {
                        existe = "si";
                        indexEncontrado = cont;
                    }
                    cont = cont + 1;
                });
            });

            if (existe == "si") {
                this.ArrayCarrito.splice(indexEncontrado, 1);
                this.TotalPedido = this.TotalPedido - producto[0].total;
                this.numPedidos = this.ArrayCarrito.length;
            }
        },

        setParamProducto() {
            console.log("prueba");
        },
        mytable() {
            setTimeout(function () {
                if (!$.fn.DataTable.isDataTable("#example")) {
                    $("#example").DataTable({
                        bFilter: true,
                        bInfo: false,
                        scrollX: false,
                        scrollCollapse: false,
                        paging: true,
                        pageLength: 4,
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
                                previous: "Anterior",
                            },
                        },
                    });
                }
            }, 500);
        },

        changePage: function () {
            this.getCategorias();
        },
    },
};
</script>

<style>

@media only screen and (min-width: 300px) and (max-width: 710px) {


    .fuente-movil{
    font-size: 10px;
    }



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
#h2Negocio {
    text-align: center;
    font-size: 20px;
    font-weight: 400;
}

.centrar {
    margin: auto;
}





@media screen and (min-device-width: 768px) and (max-device-width: 8000px) {
    #contenedorTablaCarrito {
        margin-left: 0px !important;
    }
    .modal-content {
        margin-top: 0px !important;
    }
    #modalBodyCombos {
        margin: auto;
    }
    #divContenedorimgCombos {
        width: 144px;
    }
    #divContenedorimgCombos > img {
        width: 200px;
    }
    #contImagProductoModal {
        width: 204px;
    }
    #contImagProductoModal > img {
        width: 140px;
    }
    #contenedorTitulo {
        width: 800px;
    }
    .horizontal-scroll-contenedor {
        width: 900px;
        height: 180px;
        overflow-y: hidden;
        overflow-x: auto;
        padding: 10px;
        background: #ffffff;
        white-space: nowrap;
    }
    .horizontal-scroll-contenedor > div {
        width: 66px;
        height: 170px;
        margin: 0px 54px 0 0;
        padding: 0;
        display: inline-block;
        text-align: center;
    }

    .horizontal-scroll-contenedorProductos {
        width: 3000px;
        height: 150px;
        overflow-y: hidden;
        overflow-x: auto;
        padding: 10px;
        background: #ffffff;
        white-space: nowrap;
    }
    .horizontal-scroll-contenedorProductos > div {

        margin: 0 10px 0 0;
        padding: 0;
        display: inline-block;
        text-align: center;
    }
    .horizontal-scroll-contenedorProductos > div > button > img {

    }


}

@media screen and (max-width: 600px) {
.ocultar{
    display:none;
    }

.mostrar{
    display:true;
    }


}

@media screen and (max-device-width: 480px) {
    .content {
        overflow-y: auto;
        height: 610px;
    }

    .horizontal-scroll-contenedor {
        width: 345px;
        height: 167px;
        overflow-y: hidden;
        overflow-x: auto;
        padding: 10px;
        background: #f0f0f0;
        white-space: nowrap;
    }
    .horizontal-scroll-contenedor > div {
        width: 85px;
        height: 109px;
        margin: 0 10px 0 0;
        padding: 0;
        display: inline-block;
        text-align: center;
    }
    .horizontal-scroll-contenedor > div > button > img {
        width: 102px;
        height: 102px;
        border-radius: 20px;
    }
    .horizontal-scroll-contenedorProductos {
        width: 345px;
        height: 200px;
        overflow-y: hidden;
        overflow-x: auto;
        padding: 10px;
        background: #f0f0f0;
        white-space: nowrap;
    }
    .horizontal-scroll-contenedorProductos > div {
        width: 102px;
        height: 70px;
        margin: 0 10px 0 0;
        padding: 0;
        display: inline-block;
        text-align: center;
    }
    .horizontal-scroll-contenedorProductos > div > button > img {
        width: 102px;
        height: 102px;
        border-radius: 20px;
    }

    #cuerpoModalCarrito {
        margin-top: 190px;
    }
}

h3,
h4 {
    font-weight: 800;
}
.margincenter {
    margin: auto;
    text-align: center;
}

body{
    overflow-y:scroll;
}


.img-pagos{

    width: 700px !important;
    height: 70px !important;
}

.img-pagos2{

    width: 400px !important;
    height: 70px !important;
}



</style>
