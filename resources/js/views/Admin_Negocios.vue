<template>
  <div>
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12">
          <div class="media align-items-center bg-white mb-20">
            <span class="avatar bg-primary">
              <i class="fa fa-home"></i>
            </span>
            <div class="media-body">
              <h3>
                <strong>Modulo de administracion de Negocios para Web Master</strong>
              </h3>
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

                  <div class="col-md-2"></div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                  <table class="table mb-0" id="example">
                    <thead class="bg-mo">
                      <tr>
                        <th scope="col">Foto</th>
                        <th scope="col">Nit</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="negocio in Negocios" v-bind:key="negocio.id">
                        <td>
                          <center>
                            <img
                              :src="'fotos-negocios/'+ negocio.foto"
                              class="avatar avatar-xl avatar-bordered"
                              height="70"
                              width="70"
                            />
                          </center>
                        </td>
                        <td class="td-style">{{negocio.nit}}</td>
                        <td class="td-style">{{negocio.nombre_completo}}</td>
                        <td class="td-style">{{negocio.telefono}}</td>
                        <td class="td-style">{{negocio.nombre_categoria}}</td>
                        <td class="td-style">{{negocio.nombre_ciudad}}</td>
                        <td class="td-style">{{negocio.direccion}}</td>
                        <td>
                          <button
                            type="button"
                            class="btn btn-primary btn-rounded"
                            data-toggle="modal tooltip"
                            data-placement="top"
                            title="ver"
                            v-on:click.prevent="editNegocios(negocio)"
                          >
                            <i class="fa fa-eye"></i>
                          </button> &nbsp;
                          <button
                            type="button"
                            class="btn btn-danger btn-rounded"
                            data-toggle="modal tooltip"
                            data-placement="top"
                            title="Eliminar"
                            v-on:click.prevent="deleteNegocios(negocio)"
                          >
                            <i class="fa fa-trash"></i>
                          </button >
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

 

    <form method="POST" v-on:submit.prevent="updatenegocios(fillnegocios.id)" >
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
              <h5 class="modal-title">Informacion Detallada del Negocio</h5>
              <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="col s12">

            <h3>DATOS DEL NEGOCIO</h3>
            <div class="row">

                <div class="col-md-4">
                  <label class="label"><strong>Nit: </strong>{{fillnegocios.nit}}</label><br>
                  <label class="label"><strong>Telefono: </strong>{{fillnegocios.telefono}}</label><br>
                  <label class="label"><strong>Hora de apertura: </strong>{{fillnegocios.hora_apertura}}</label><br>


                </div>

                <div class="col-md-4">
                  <label class="label"><strong>Nombre: </strong>{{fillnegocios.nombre}}</label><br>
                  <label class="label"><strong>Categoria: </strong>{{fillnegocios.categoria}}</label><br>
                </div>

                <div class="col-md-4">
                  <label class="label"><strong>Descripcion: </strong>{{fillnegocios.descripcion}}</label><br>
                  <label class="label"><strong>Ciudad: </strong>{{fillnegocios.ciudad}}</label><br>
                  <label class="label"><strong>Hora de cierre: </strong>{{fillnegocios.hora_cierre}}</label><br>

                </div>

            </div>
            <br><br><br>
                <h3>DATOS DEL PROPIETARIO</h3>
            <div class="row">

                <div class="col-md-4">
                  <label class="label"><strong>Numero Doc: </strong>{{fillnegocios.doc_usuario}}</label><br>
                  <label class="label"><strong>Email: </strong>{{fillnegocios.email_usuario}}</label><br>
                </div>

                <div class="col-md-4">
                  <label class="label"><strong>Nombre: </strong>{{fillnegocios.nombre_usuario}}</label><br>
                  <label class="label"><strong>Direccion: </strong>{{fillnegocios.direccion_usuario}}</label><br>
                </div>

                <div class="col-md-4">
                  <label class="label"><strong>Telefono: </strong>{{fillnegocios.telefono_usuario}}</label><br>
                  <label class="label"><strong>Ciudad: </strong>{{fillnegocios.ciudad}}</label><br>
                </div>

            </div>

              </div>
            </div>

            <div class="modal-footer modal-footer-uniform">
              <button
                type="button"
                class="btn btn-bold btn-pure btn-primary float-right btn-rounded"
                data-dismiss="modal"
              >Cerrar</button>

            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>

import LayoutDefault from "../components/layouts/Principal.vue";

import VueTimepicker from 'vue2-timepicker'

import 'vue2-timepicker/dist/VueTimepicker.css'

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

    this.getNegocios();
    this.select_categoria();
    this.select_ciudad();
    this.$emit("update:layout", LayoutDefault);
  },

  name: "GoogleMap",

  data() {
    return {
      fotoMiniatura: "",
      Negocios: [],
      Datos_Negocio: [],
      arraycategorias: [],
      arrayciudades: [],
      loading: true,
      newid_categoria: "",
      newid_ciudad: "",
      newid_usuario: "",
      newnit: "",
      newnombre: "",
      newdescripcion: "",
      newtelefono: "",
      newdireccion: "",
      newhora_apertura: '',
      newhora_cierre: '',
      errors: [],
      fillnegocios: {
        id: "",
        id_categoria: "",
        id_ciudad: "",
        telefono: "",
        descripcion: "",
        id_usuario: "",
        nit: "",
        nombre: "",
        direccion: "",
        long: "",
        lat: "",
        hora_apertura:'',
        hora_cierre:''
      },
      timer: "",
      icono: "images/marker2.png",
      editfotoMiniatura : '',
      editfoogo: '',
      mymap:''
    };
  },


  mounted() {



    },


    computed: {


                edit_foto(){
                    return this.editfotoMiniatura;
                },



            },

  methods: {



    obtenerFoto(e) {
      let file = e.target.files[0];
      this.imagen = file;

      this.cargarImagen(file);
    },




        obtenereditFoto(e){

            let file = e.target.files[0];
            this.edit_foto= file;

                this.cargareditFoto(file);
        },

            cargareditFoto(file){
                let reader = new FileReader();

                reader.onload = (e) => {
                    this.editfotoMiniatura = e.target.result;

                }
                reader.readAsDataURL(file);

            },




    select_categoria() {
      let me = this;
      this.$http({
        url: "auth/select_categoria_negocio",
        method: "GET"
      })
        .then(response => {
          me.arraycategorias = response.data.categorias;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },

    select_ciudad() {
      let me = this;
      this.$http({
        url: "auth/select_ciudad",
        method: "GET"
      })
        .then(response => {
          me.arrayciudades = response.data.ciudades;
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
              zeroRecords: "No se encuentran acronimos - lo sentimos",
              info: "Mostrando la p&aacute;gina _PAGE_ de _PAGES_",
              infoEmpty: "No hay registros disponibles",
              infoFiltered: "(Filtrado de _MAX_ Total de registros)",
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

    getNegocios() {
      let me = this;
      this.$http({
        url: "auth/admin_negocios",
        method: "GET"
      })
        .then(response => {
          me.Negocios = response.data;
          me.mytable();
          me.editfotoMiniatura ='fotos-negocios/'+ me.Negocios[0]['foto'];
          me.editfoto = me.Negocios[0]['foto'];
          me.loading = false;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },

    editNegocios(negocio) {

      this.fillnegocios.id = negocio.id;
      this.fillnegocios.nit = negocio.nit;
      this.fillnegocios.nombre = negocio.nombre_completo;
      this.fillnegocios.descripcion = negocio.descripcion;
      this.fillnegocios.categoria = negocio.nombre_categoria;
      this.fillnegocios.ciudad = negocio.nombre_ciudad;
      this.fillnegocios.telefono = negocio.telefono;
      this.fillnegocios.direccion = negocio.direccion;
      this.fillnegocios.hora_apertura = negocio.hora_apertura;
      this.fillnegocios.hora_cierre = negocio.hora_cierre;
      this.fillnegocios.nombre_usuario = negocio.nombre_usuario;
      this.fillnegocios.doc_usuario = negocio.doc_usuario;
      this.fillnegocios.email_usuario = negocio.email_usuario;
      this.fillnegocios.direccion_usuario = negocio.direccion_usuario;
      this.fillnegocios.telefono_usuario = negocio.telefono_usuario;



        let id = this.fillnegocios.id;
        let me = this;
                this.$http({
                url: 'auth/admin_negocios/' + id,
                method: 'GET'
                })
                .then(response => {
                    me.Datos_Pedidos = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });



      $("#edit").modal("show");
    },



    createNegocios() {

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

      this.addMarker();

        var lat_real;
        var long_real;
        //var direccion_real;

         if(this.coordinates === null){

                this.lat_real = this.center.lat;
                this.long_real = this.center.lng;

            }else{

                this.lat_real = this.coordinates.lat;
                this.long_real = this.coordinates.lng;
                //this.direccion_real = this.coordinates.name;

            }


      this.$http({
        url: "auth/negocios",
        method: "POST",
        data: {
          id_categoria: this.newid_categoria,
          id_ciudad: this.newid_ciudad,
          nombre: this.newnombre,
          descripcion: this.newdescripcion,
          nit: this.newnit,
          telefono: this.newtelefono,
          direccion: this.searchAddressInput,
          lat : this.lat_real,
          long : this.long_real,
          foto: this.fotoMiniatura,
          hora_apertura : this.newhora_apertura,
          hora_cierre: this.newhora_cierre

        }
      })
        .then(response => {
          this.getNegocios();

          this.newid_categoria = "";
          this.newid_ciudad = "";
          this.newnombre = "";
          this.newdescripcion = "";
          this.newnit = "";
          this.newtelefono = "";
          this.newdireccion = "";
          this.newlong = "";
          this.newlat = "";
          this.fotoMiniatura = "";

          this.errors = [];
          $("#create").modal("hide");
          if ($(".modal-backdrop").is(":visible")) {
            $("body").removeClass("modal-open");
            $(".modal-backdrop").remove();
          }

          this.$swal("Creado", "Negocio creado con éxito", "success");
        })
        .catch(error => {
          console.log(error.response.data.code);
          //this.errors = 'error.response.data'
          if (error.response.data.code == 2) {
            this.$swal({
              type: "error",
              title: "El nit Ingresado ya se encuentra registrado",
              text: "Por favor verifica los datos"
            });
          }
          if (error.response.data.code == 3)
            this.$swal({
              type: "error",
              title: "Favor ingresar un horario de apertura y de cierre",
              text: "Por favor verifica los datos"
            });
        });
    },

    deleteNegocios(negocio) {
      this.$swal({
        title: "Está seguro de Eliminar este Negocio?",
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
            url: "auth/admin_negocios/" + negocio.id,
            method: "DELETE"
          })
            .then(response => {
              this.getNegocios();
              this.$swal(
                "Eliminado!",
                "El Negocio ha sido Eliminado con éxito.",
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
      this.getNegocios();
    }
  },

    components: {

        VueTimepicker,
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

.pac-container {
  z-index: 1051 !important;
}

h3{
  text-align: center;
}

.label{
  color: black;
  font-size: 16px !important;
}
</style>
