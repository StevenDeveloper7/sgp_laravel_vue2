<template>
    <div>
        <div class="content-wrapper">
            <div class="row">
                <div class=" col-md-12 ">
                    <div class="media align-items-center bg-white mb-20">
                        <span class="avatar  bg-primary"
                            ><i class="fa fa-id-card"></i
                        ></span>
                        <div class="media-body">
                            <h3><strong>Modulo de Gestion de Categoria de Negocios</strong></h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button
                                            type="button"
                                            class="btn btn-success btn-rounded"
                                            data-toggle="modal"
                                            data-target="#create"
                                        >
                                            <i class="fa fa-plus"></i
                                            >&nbsp;Nuevo
                                        </button>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table mb-0" id="example">
                                        <thead class="bg-mo">
                                            <tr>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Descripción</th>
                                                <th scope="col">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="categoria in Categorias"
                                                v-bind:key="categoria.id"
                                            >
                                                <td class="td-style">
                                                    {{ categoria.nombre }}
                                                </td>
                                                <td class="td-style">
                                                    {{ categoria.descripcion }}
                                                </td>
                                                <td>
                                                    <button
                                                        type="button"
                                                        class="btn btn-warning btn-rounded"
                                                        data-toggle="modal tooltip"
                                                        data-placement="top"
                                                        title="Editar"
                                                        v-on:click.prevent="
                                                            editCategorias(
                                                                categoria
                                                            )
                                                        "
                                                    >
                                                        <i
                                                            class="fa fa-edit"
                                                        ></i>
                                                    </button>
                                                    &nbsp;
                                                    <button
                                                        type="button"
                                                        class="btn btn-danger btn-rounded"
                                                        data-toggle="modal tooltip"
                                                        data-placement="top"
                                                        title="Eliminar"
                                                        v-on:click.prevent="
                                                            deleteCategorias(
                                                                categoria
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

        <form method="POST" v-on:submit.prevent="createCategorias">
            <!-- Modal -->
            <div
                class="modal fade bs-example-modal-lg"
                tabindex="-1"
                role="dialog"
                aria-labelledby="myLargeModalLabel"
                aria-hidden="true"
                style="display: none;"
                id="create"
            >
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-mo">
                            <h5 class="modal-title">Crear Categoría  </h5>
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

                            <div class="col s12">


            <div class="form-group row">

                                <div class="col-md-4">
                                    <validation-provider rules="required" v-slot="{ errors }">
                                            <label for="nombre">Nombre de la Categoría</label>
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-user"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    id="nombre"
                                                    type="text"
                                                    class="form-control"
                                                    v-model="newnombre"
                                                    required
                                                />
                                            </div>
                                             <span style="color:red">{{ errors[0] }}</span>
                                    </validation-provider>
                                            <!-- /.input group -->
                                        </div>

                                        
                                <div class="col-md-4">
                                    <validation-provider rules="required" v-slot="{ errors }">
                                            <label for="nombre">Nombre del Marcador</label>
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-ticket"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    id="nombre"
                                                    type="text"
                                                    class="form-control"
                                                    v-model="newmarcador"
                                                    required
                                                />
                                            </div>
                                             <span style="color:red">{{ errors[0] }}</span>
                                    </validation-provider>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="col-md-4">
                                            <validation-provider rules="required" v-slot="{ errors }">
                                            <label for="documento"
                                                >Descripción de la Categoría</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-id-card"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <textarea
                                                    name="descripcion"
                                                    id="descripcion"
                                                    rows="3"
                                                    v-model="newdescripcion"
                                                    required
                                                ></textarea>
                                            </div>
                                            <span style="color:red">{{ errors[0] }}</span>
                                    </validation-provider>
                                            <!-- /.input group -->
                                        </div>

            </div>

                                <div class="row">
                                <div class="col s12">
                                    <div class="form-group row">


                                    </div>
                                </div>
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
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal -->
        </form>

        <form
            method="POST"
            v-on:submit.prevent="updateCategorias(fillCategorias.id)"
        >
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
                            <h5 class="modal-title">Editor de Categoria de Negocios</h5>
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
                                <div class="col s12">




                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <validation-provider rules="required" v-slot="{ errors }">
                                            <label for="nombre2">Nombre de la Categoría</label>
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-id-card"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    id="nombre2"
                                                    type="text"
                                                    class="form-control"
                                                    required
                                                    v-model="
                                                        fillCategorias.nombre
                                                    "
                                                />
                                            </div>
                                            <span style="color:red">{{ errors[0] }}</span>
                                    </validation-provider>
                                            <!-- /.input group -->
                                        </div>
                                    <div class="col-md-4">
                                    <validation-provider rules="required" v-slot="{ errors }">
                                            <label for="nombre">Nombre del Marcador</label>
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-ticket"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    id="nombre"
                                                    type="text"
                                                    class="form-control"
                                                    v-model="fillCategorias.marcador"
                                                    required
                                                />
                                            </div>
                                             <span style="color:red">{{ errors[0] }}</span>
                                    </validation-provider>
                                            <!-- /.input group -->
                                    </div>
                                        <div class="col-md-4">
                                            <validation-provider rules="required" v-slot="{ errors }">
                                            <label for="documento"
                                                >Descripción de la Categoría</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-id-card"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <textarea
                                                    name="descripcion"
                                                    id="descripcion"
                                                    rows="3"
                                                    required
                                                    v-model="
                                                        fillCategorias.descripcion
                                                    "
                                                ></textarea>
                                            </div>
                                            <span style="color:red">{{ errors[0] }}</span>
                                    </validation-provider>
                                            <!-- /.input group -->
                                        </div>
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
                                Actualizar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal -->
        </form>
    </div>
</template>

<script>
import LayoutDefault from "../components/layouts/Principal.vue";

import { ValidationProvider, extend } from 'vee-validate';
import { required, email } from 'vee-validate/dist/rules';
import { numeric } from 'vee-validate/dist/rules';

export default {
    created: function() {

        extend('positive', value => {
        return value >= 0;

        });

       extend('numeric', {
        ...required,
        message: 'Ingrese solo numeros'
        });

        extend('required', {
        ...required,
        message: 'Este campo es obligatorio'
        });

       extend('email', {
        ...required,
        message: 'Ingrese un email válido'
        });

        this.getCategorias();
        this.$emit("update:layout", LayoutDefault);
    },

    data() {
        return {
            Categorias: [],
            loading: true,
            newnombre: "",
            newdescripcion: "",
            newmarcador: "",
            errors: [],
            fillCategorias: { nombre: "", descripcion: "", marcador: "" },
            timer: ""
        };
    },

    methods: {
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

        getCategorias() {
            let me = this;
            this.$http({
                url: "auth/categoria_negocios",
                method: "GET"
            })
                .then(response => {
                    me.Categorias = response.data;
                    me.mytable();
                    me.loading = false;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },


        editCategorias(categoria) {
            this.fillCategorias.id = categoria.id;
            this.fillCategorias.nombre = categoria.nombre;
            this.fillCategorias.descripcion = categoria.descripcion;
            this.fillCategorias.marcador = categoria.marcador;

            $("#edit").modal("show");
        },

        updateCategorias(id) {
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
                url: "auth/categoria_negocios/" + id,
                method: "PUT",
                data: {
                    nombre: this.fillCategorias.nombre,
                    descripcion: this.fillCategorias.descripcion,
                    marcador: this.fillCategorias.marcador
                }
            })
                .then(response => {
                    this.getCategorias();
                    this.errors = [];

                    $("#edit").modal("hide");
                    if ($(".modal-backdrop").is(":visible")) {
                        $("body").removeClass("modal-open");
                        $(".modal-backdrop").remove();
                    }
                    this.$swal(
                        "Actualizado",
                        "Categoria actualizada con éxito.",
                        "success"
                    );
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        createCategorias() {
            this.$swal({
                title: "Cargando!",
                text: "Espere un momento por favor..",
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showCancelButton: false,
                showConfirmButton: false,
                imageUrl: "images/spinner.gif",
                onOpen: () => {
                    swal.showLoading();
                }
            });

            this.$http({
                url: "auth/categoria_negocios",
                method: "POST",
                data: {
                    nombre: this.newnombre,
                    descripcion: this.newdescripcion,
                    marcador:this.newmarcador
                }
            })
                .then(response => {
                    this.getCategorias();

                    this.newnombre = "";
                    this.newdescripcion = "";
                    this.newmarcador = "";

                    this.errors = [];
                    $("#create").modal("hide");
                    if ($(".modal-backdrop").is(":visible")) {
                        $("body").removeClass("modal-open");
                        $(".modal-backdrop").remove();
                    }

                    this.$swal(
                        "Creado",
                        "Categoria creada con éxito.",
                        "success"
                    );
                })
                .catch(error => {
                    console.log(error.response.data.code);
                    //this.errors = 'error.response.data'
                    if (error.response.data.code == 1) {
                        this.$swal({
                            type: "error",
                            title:
                                "El correo ingresado ya se encuentra registrado",
                            text: "Por favor verifica los datos"
                        });
                    }
                    if (error.response.data.code == 3)
                        this.$swal({
                            type: "error",
                            title: "El documento ya se encuentra registrado",
                            text: "Por favor verifica los datos"
                        });
                });
        },

        deleteCategorias(categoria) {
            this.$swal({
                title: "Está seguro de Eliminar esta Categoria?",
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
                        url: "auth/categoria_negocios/" + categoria.id,
                        method: "DELETE"
                    })
                        .then(response => {
                            this.getCategorias();
                            this.$swal(
                                "Eliminado!",
                                "La Categoria ha sido Eliminada con éxito.",
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
            this.getCategorias();
        }
    },
    components: {

        ValidationProvider

        },
};
</script>

<style>
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
</style>
