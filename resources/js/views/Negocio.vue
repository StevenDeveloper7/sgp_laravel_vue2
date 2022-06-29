<template>
  <div>
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12">
          <div class="media align-items-center bg-white mb-20">
            <span class="avatar bg-primary">
              <i class="fa fa-map-marker"></i>
            </span>
            <div class="media-body">
              <h3>
                <strong>Aquí actualizas la información de tu negocio ve!</strong>
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
                  <div class="col-md-6" v-show="false">
                    <button
                      type="button"
                      class="btn btn-success btn-rounded"
                      data-toggle="modal"
                      data-target="#create"
                    >
                      <i class="fa fa-plus"></i>&nbsp;Nuevo
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
                            class="btn btn-warning btn-rounded"
                            data-toggle="modal tooltip"
                            data-placement="top"
                            title="Editar"
                            v-on:click.prevent="editNegocios(negocio)"
                          >
                            <i class="fa fa-edit"></i>
                          </button> &nbsp;
                          <button
                            type="button"
                            class="btn btn-danger btn-rounded"
                            data-toggle="modal tooltip"
                            data-placement="top"
                            title="Eliminar"
                            v-on:click.prevent="deleteNegocios(negocio)"
                            v-show="false"
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

    <form method="POST" v-on:submit.prevent="createNegocios">
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
              <h5 class="modal-title">Crea Tu Negocio ve!</h5>
              <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="col s12">
                <div class="row">
                  <div
                    class="box card-inverse bg-img"
                    style="background-image: url(images/fondo-negocios.jpg); padding-top: 100px"
                  >
                    <div class="flexbox align-items-center px-20" data-overlay="4">
                      <div class="flexbox align-items-center mr-auto">
                        <a href="#">
                          <img
                            class="avatar avatar-xl avatar-bordered"
                            :src="fotoMiniatura"
                            alt="foto"
                          />
                        </a>
                        <div class="pl-10 d-none d-md-block"></div>
                      </div>

                      <ul class="flexbox flex-justified text-center py-20">
                        <li class="pl-10">
                          <label id="up" for="file-upload" class="subir">
                            Sube una foto de tu negocio o algo que lo identifique
                            <i
                              class="fa fa-camera"
                              style="width:50px;"
                            ></i>
                          </label>
                          <input
                            id="file-upload"
                            type="file"
                            @change="obtenerFoto"
                            name="foto"
                            class="form-control-file"
                            style="display: none;"
                          />
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                      <validation-provider rules="positive|required|numeric" v-slot="{ errors }">
                    <label for="nombre">Nit del Negocio</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-address-book"></i>
                        </span>
                      </div>
                      <input id="nit" type="number" class="form-control" v-model="newnit" required />
                    </div>
                    <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
                  </div>

                  <div class="col-md-4">
                      <validation-provider rules="required" v-slot="{ errors }">
                    <label for="nombre">Nombre del Negocio</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-user"></i>
                        </span>
                      </div>
                      <input id="nombre" type="text" class="form-control" v-model="newnombre" required/>
                    </div>
                    <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
                  </div>

                  <div class="col-md-5">
                      <validation-provider rules="required" v-slot="{ errors }">
                    <label for="descripcion">Descripción del Negocio</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-bars"></i>
                        </span>
                      </div>
                      <input
                        id="descripcion"
                        type="text"
                        class="form-control"
                        v-model="newdescripcion"
                        required
                      />
                    </div>
                    <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
                  </div>
                </div>
                <br />
                <div class="row">
                  <div class="col-md-4">
                      <validation-provider rules="required" v-slot="{ errors }">
                    <label for="categoria">Categoría del Negocio</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-id-card"></i>
                        </span>
                      </div>
                      <select class="custom-select" v-model="newid_categoria" required>
                        <option value="0" disabled>Seleccione</option>
                        <option
                          v-for="categoria in arraycategorias"
                          :key="categoria.id"
                          :value="categoria.id"

                        >{{categoria.nombre}}</option>
                      </select>
                    </div>
                     <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
                  </div>

                  <div class="col-md-4">
                      <validation-provider rules="required" v-slot="{ errors }">
                    <label for="categoria">Ciudad del Negocio</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-map-marker"></i>
                        </span>
                      </div>
                      <select class="custom-select" v-model="newid_ciudad" required>
                        <option value="0" disabled>Seleccione</option>
                        <option
                          v-for="ciudad in arrayciudades"
                          :key="ciudad.id"
                          :value="ciudad.id"

                        >{{ciudad.nombre}}</option>
                      </select>
                    </div>
                    <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
                  </div>
                  <div class="col-md-4">
                  <validation-provider rules="positive|required|numeric" v-slot="{ errors }">
                    <label for="telefono">Teléfono del Negocio</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-phone"></i>
                        </span>
                      </div>
                      <input
                        id="telefono1"
                        type="number"
                        class="form-control"
                        v-model="newtelefono"
                        required
                      />
                    </div>
                    <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
                  </div>

                </div>

                <br>
                <div class="row">

                    <div class="col-md-4">
                    <label for="hora_apertura">Hora de Apertura</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-clock-o"></i>
                        </span>
                      </div>
                      <vue-timepicker v-model="newhora_apertura"></vue-timepicker>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <label for="hora_cierre">Hora de Cierre</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-clock-o"></i>
                        </span>
                      </div>
                      <vue-timepicker v-model="newhora_cierre"></vue-timepicker>
                    </div>
                  </div>

                </div>

                <br>
                <div class="row">
                <div class="col-md-6">
                  <label for="direccion">Dirección del Negocio</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-map-marker"></i>
                      </span>
                    </div>
                     <input type="text" class="form-control ph-center" v-model="searchAddressInput" v-on:keyup="searchLocation()">
                  </div>
                </div>


                <div class="col-md-2 custom">
                  <button
                    type="button"
                    class="btn btn-success btn-rounded"
                    v-on:click.prevent="searchLocation()"
                    ><i class="fa fa-search">&nbsp;Buscar</i></button>
                </div>

                </div>

                <br>

                <div class="row">
                    <div class="col-md-12">

                    <gmap-map ref="mymap" id="mymap" :center="center" :zoom="17" style="width: 100%; height: 300px" v-bind:options="mapStyle">
                        <gmap-marker :position="center" :draggable="true" @drag="updateCoordinates" :icon="icono" />

                    </gmap-map>

                    </div>
                </div>



              </div>
            </div>

            <div class="modal-footer modal-footer-uniform">
              <button
                type="button"
                class="btn btn-bold btn-pure btn-secondary btn-rounded"
                data-dismiss="modal"
              >Cerrar</button>
              <button
                type="submit"
                class="btn btn-bold btn-pure btn-success float-right btn-rounded"
              >Guardar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.modal -->
    </form>

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
              <h5 class="modal-title">Actualiza Tu Negocio ve!</h5>
              <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="col s12">
                <div class="row">
                  <div
                    class="box card-inverse bg-img"
                    style="background-image: url(images/fondo-negocios.jpg; padding-top: 100px"
                  >

                    <div class="flexbox align-items-center px-20" data-overlay="4">
                      <div class="flexbox align-items-center mr-auto">
                        <a >
                          <img
                            class="avatar avatar-xl avatar-bordered"
                            :src="editfotoMiniatura"
                            alt="foto"
                          />
                        </a>
                        <div class="pl-10 d-none d-md-block"></div>
                      </div>

                      <ul class="flexbox flex-justified text-center py-20">
                        <li class="pl-10">
                          <label id="up" for="file-upload-edit-foto" class="subir">
                            Actualiza la foto de tu negocio
                            <i class="fa fa-camera" style="width:50px;"></i>
                          </label>
                          <input
                            id="file-upload-edit-foto"
                            type="file"
                            @change="obtenereditFoto"
                            name="edit-foto"
                            class="form-control-file"
                            style="display: none;"
                          />
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                      <validation-provider rules="positive|required|numeric" v-slot="{ errors }">
                    <label for="edit-nit">Nit del Negocio</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-address-book"></i>
                        </span>
                      </div>
                      <input id="edit-nit" type="number" class="form-control" v-model="fillnegocios.nit" required />
                    </div>
                    <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
                  </div>

                  <div class="col-md-4">
                      <validation-provider rules="required" v-slot="{ errors }">
                    <label for="edit-nombre">Nombre del Negocio</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-user"></i>
                        </span>
                      </div>
                      <input
                        id="edit-nombre"
                        type="text"
                        class="form-control"
                        v-model="fillnegocios.nombre"
                        required
                      />
                    </div>
                    <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
                  </div>

                  <div class="col-md-5">
                      <validation-provider rules="required" v-slot="{ errors }">
                    <label for="edit-descripcion">Descripción del Negocio</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-bars"></i>
                        </span>
                      </div>
                      <textarea
                        id="edit-descripcion"
                        type="text"
                        class="form-control"
                        rows="2"
                        v-model="fillnegocios.descripcion"
                        required
                      >
                      </textarea>
                    </div>
                    <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
                  </div>
                </div>
                <br />
                <div class="row">
                  <div class="col-md-4">
                      <validation-provider rules="required" v-slot="{ errors }">
                    <label for="edit-categoria">Categoría del Negocio</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-id-card"></i>
                        </span>
                      </div>
                      <select class="custom-select" v-model="fillnegocios.id_categoria" required>
                        <option value="0" disabled>Seleccione</option>
                        <option
                          v-for="categoria in arraycategorias"
                          :key="categoria.id"
                          :value="categoria.id"
                        >{{categoria.nombre}}</option>
                      </select>
                    </div>
                    <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
                  </div>

                  <div class="col-md-4">
                      <validation-provider rules="required" v-slot="{ errors }">
                    <label for="edit-ciudad">Ciudad del Negocio</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-map-marker"></i>
                        </span>
                      </div>
                      <select class="custom-select" v-model="fillnegocios.id_ciudad">
                        <option value="0" disabled>Seleccione</option>
                        <option
                          v-for="ciudad in arrayciudades"
                          :key="ciudad.id"
                          :value="ciudad.id"
                          required
                        >{{ciudad.nombre}}</option>
                      </select>
                    </div>
                    <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
                  </div>
                  <div class="col-md-4">
                      <validation-provider rules="positive|required|numeric" v-slot="{ errors }">
                    <label for="edit-telefono">Teléfono del Negocio</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-phone"></i>
                        </span>
                      </div>
                      <input
                        id="edit-telefono"
                        type="number"
                        class="form-control"
                        v-model="fillnegocios.telefono"
                        required
                      />
                    </div>
                    <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
                  </div>
                </div>


                <br>
                <div class="row">

                    <div class="col-md-4">
                    <label for="hora_apertura">Hora de Apertura del Negocio</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-clock-o"></i>
                        </span>
                      </div>
                      <vue-timepicker v-model="fillnegocios.hora_apertura"></vue-timepicker>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <label for="hora_cierre">Hora de Cierre del Negocio</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-clock-o"></i>
                        </span>
                      </div>
                      <vue-timepicker v-model="fillnegocios.hora_cierre"></vue-timepicker>
                    </div>
                  </div>


                </div>

                <br>

                <div class="row">

                    <div class="col-md-4">

                        <div class="checkbox custom">
                          <input type="checkbox" id="basic_checkbox_1"  @click="habilitar_pagos()" />
                          <label for="basic_checkbox_1" class="cambio-color ">Activar pagos electrónicos</label>
                        </div>

                      </div>

                    <div class="col-md-6">

                    <label for="direccion">key wompi</label>
                  <div class="input-group" v-show="this.check_key_wompi">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-key"></i>
                      </span>
                    </div>
                     <input type="text" class="form-control ph-center"  v-model="fillnegocios.key_wompi">
                  </div>
                    </div>

                </div>

                <br>
                <div class="row">
                <div class="col-md-6">
                  <label for="edit-direccion">Dirección del Negocio</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-map-marker"></i>
                      </span>
                    </div>
                     <input type="text" id="edit-direccion" class="form-control ph-center" v-model="fillnegocios.direccion" >
                  </div>
                </div>


                <div class="col-md-2 custom">
                  <button
                    type="button"
                    class="btn btn-success btn-rounded"
                    v-on:click.prevent="editsearchLocation()"
                    ><i class="fa fa-search">&nbsp;Buscar</i></button>
                </div>

                </div>

                <br>

                <div class="row">
                    <div class="col-md-12">

                    <gmap-map ref="mymap" :center="center" :zoom="17" style="width: 100%; height: 300px" v-bind:options="mapStyle">
                        <gmap-marker :position="center" :draggable="true" @drag="updateCoordinates" :icon="icono" />

                    </gmap-map>

                    </div>
                </div>


              </div>
            </div>

            <div class="modal-footer modal-footer-uniform">
              <button
                type="button"
                class="btn btn-bold btn-pure btn-secondary btn-rounded"
                data-dismiss="modal"
              >Cerrar</button>
              <button
                type="submit"
                class="btn btn-bold btn-pure btn-success float-right btn-rounded"
              >Actualizar</button>
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
    name: "GoogleMap",

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

    this.validar_negocio();
    this.getNegocios();
    this.select_categoria();
    this.select_ciudad();
    this.$emit("update:layout", LayoutDefault);
    this.geolocate();
  },

  name: "GoogleMap",

  data() {
    return {

        mapStyle: {

        styles:   [
            {
                "featureType": "poi",
                "elementType": "labels.text",
                "stylers": [
                {
                    "visibility": "off"
                }
                ]
            },
            {
                "featureType": "poi.business",
                "stylers": [
                {
                    "visibility": "off"
                }
                ]
            },
            {
                "featureType": "road",
                "elementType": "labels.icon",
                "stylers": [
                {
                    "visibility": "off"
                }
                ]
            },
            {
                "featureType": "transit",
                "stylers": [
                {
                    "visibility": "off"
                }
                ]
            }
            ]
  },
      center: { lat: 0, lng: 0 },
      fillubicacion: { lat: 0, lng: 0 },
      position: [],
      markers: [],
      places: [],
      searchAddressInput: '',
      searchAddressInput: '',
      currentPlace: null,
      fotoMiniatura: "",
      Negocios: [],
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
      newlong: "",
      newlat: "",
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
        hora_cierre:'',
        key_wompi: '',
      },
      timer: "",
      Validar_Negocio: 0,
      coordinates: null,
      icono: "images/marker2.png",
      editfotoMiniatura : '',
      editfoogo: '',
      mymap:'',
      key_wompi: '',
      check_key_wompi: false
    };
  },


  mounted() {

       /* this.$refs.mymap.$mapPromise.then((map) => {
            var mysearch = document.getElementById('mysearch');

            myboton.index = 1; // Esto es importante sino arroja error.

            map.controls[google.maps.ControlPosition.TOP_CENTER].push(mysearch);
        })*/

        this.geolocate();

    },


    computed: {


                edit_foto(){
                    return this.editfotoMiniatura;
                },



            },

  methods: {

      habilitar_pagos(){


          // Check
            if( document.getElementById("basic_checkbox_1").checked == true ){


                    this.check_key_wompi = true;
            }else{

                this.check_key_wompi = false;

            }


      },

    setPlace(place) {

                this.currentPlace = place;
                },

                addMarker() {
                if (this.currentPlace) {
                    const marker = {
                    lat: this.currentPlace.geometry.location.lat(),
                    lng: this.currentPlace.geometry.location.lng(),
                    name: this.currentPlace.formatted_address

                    };
                    this.markers = marker;
                    this.places.push(this.currentPlace);
                    this.center = marker;
                    this.currentPlace = null;
                }
                //console.log(this.markers);
            },


    geolocate: function() {
      navigator.geolocation.getCurrentPosition(position => {
        this.center = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
      });
    },

    searchLocation: function() {
      var geocoder = new google.maps.Geocoder();
      geocoder.geocode({'address': this.searchAddressInput}, (results, status) => {
        if (status === 'OK') {
          this.center.lat = results[0].geometry.location.lat();
          this.center.lng = results[0].geometry.location.lng();
          console.log(results[0].geometry.location.lat() + results[0].geometry.location.lng())
        }
      });
    },

    editsearchLocation: function() {

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

      var geocoder = new google.maps.Geocoder();
      geocoder.geocode({'address': this.fillnegocios.direccion}, (results, status) => {
        if (status === 'OK') {
          this.center.lat = results[0].geometry.location.lat();
          this.center.lng = results[0].geometry.location.lng();

          this.$swal.close();
        }
      });
    },

    updateCoordinates(location) {

      this.coordinates = {
        lat: location.latLng.lat(),
        lng: location.latLng.lng()
      };
        var geocoder = new google.maps.Geocoder();
      geocoder.geocode({'location': this.coordinates}, (results, status) => {
        if (status === 'OK') {

          this.center.lat = results[0].geometry.location.lat();
          this.center.lng = results[0].geometry.location.lng();
          this.formatted_address = results[0].formatted_address;


        }
      });

    },



    obtenerFoto(e) {
      let file = e.target.files[0];
      this.imagen = file;

      this.cargarImagen(file);
    },

    cargarImagen(file) {
      let reader = new FileReader();

      reader.onload = e => {
        this.fotoMiniatura = e.target.result;
      };
      reader.readAsDataURL(file);
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



    validar_negocio() {
      this.$http({
        url: "auth/validar-negocio",
        method: "GET"
      })
        .then(response => {
          this.Validar_Negocio = response.data;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
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
      }, 800);
    },

    getNegocios() {
      let me = this;
      this.$http({
        url: "auth/negocios",
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
      this.fillnegocios.id_categoria = negocio.id_categoria;
      this.fillnegocios.id_ciudad = negocio.id_ciudad;
      this.fillnegocios.telefono = negocio.telefono;
      this.fillnegocios.direccion = negocio.direccion;
      this.fillnegocios.hora_apertura = negocio.hora_apertura;
      this.fillnegocios.hora_cierre = negocio.hora_cierre;
      this.fillnegocios.check_key_wompi = negocio.check_key_wompi;
      this.fillnegocios.key_wompi = negocio.key_wompi;


      let id = this.fillnegocios.id;
        let me = this;
                this.$http({
                url: 'auth/position/' + id,
                method: 'GET'
                })
                .then((response) => {
                    me.position = response.data;

                    this.center.lat = me.position[0].lat,
                    this.center.lng = me.position[0].long



                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });



      $("#edit").modal("show");
    },

    updatenegocios(id) {


      var array_hora_apertura = this.fillnegocios.hora_apertura.split(':');
      var hora_apertura_formateada = array_hora_apertura[0];
      var minutos_apertura_formateada = array_hora_apertura[1];

      var array_hora_cierre = this.fillnegocios.hora_cierre.split(':');
      var hora_cierre_formateada = array_hora_cierre[0];
      var minutos_cierre_formateada = array_hora_cierre[1];


      if( hora_cierre_formateada < hora_apertura_formateada ) {

        this.$swal({
                    type: 'error',
                    title: 'Horario del negocio',
                    text: 'El horario de cierre debe ser mayor al de apertura'
                    })

      }else if( minutos_apertura_formateada == 'mm' || minutos_cierre_formateada == 'mm' ) {

        this.$swal({
                    type: 'error',
                    title: 'Horario del negocio',
                    text: 'El valor que introdujo en los minutos no corresponde, introduzca un digito entre 00 y 59'
                    })


     }else if( this.fillnegocios.hora_apertura == this.fillnegocios.hora_cierre) {

        this.$swal({
                    type: 'error',
                    title: 'Horario del negocio',
                    text: 'El horario de apertura y de cierre no deben ser iguales ni vacios'
                    })

        }else{


       var lat_real;
        var long_real;
        var direccion_real;

        if(this.coordinates === null){

            this.lat_real = this.center.lat;
            this.long_real = this.center.lng;
            this.direccion_real = this.searchAddressInput;

        }else{

            this.lat_real = this.coordinates.lat;
            this.long_real = this.coordinates.lng;
            this.direccion_real = this.formatted_address;

            }

        var foto_real;
        var foto_nombre = this.editfotoMiniatura.split('/');

                if(foto_nombre[1] == this.editfoto){
                    this.foto_real=''

                }else{
                    this.foto_real = this.editfotoMiniatura
                }

       var check_key;

       if( this.check_key_wompi == true) {

          this.check_key = 1;
       }



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
        url: "auth/negocios/" + id,
        method: "PUT",

        data: {
          foto: this.foto_real,
          id_categoria: this.fillnegocios.id_categoria,
          id_ciudad: this.fillnegocios.id_ciudad,
          nombre: this.fillnegocios.nombre,
          descripcion: this.fillnegocios.descripcion,
          nit: this.fillnegocios.nit,
          telefono: this.fillnegocios.telefono,
          direccion: this.direccion_real,
          lat : this.lat_real,
          long : this.long_real,
          check_key_wompi : this.check_key,
          key_wompi : this.fillnegocios.key_wompi,
          hora_apertura : this.fillnegocios.hora_apertura,
          hora_cierre : this.fillnegocios.hora_cierre
        }
      })
        .then(response => {
          this.getNegocios();
          this.errors = [];

          $("#edit").modal("hide");
          if ($(".modal-backdrop").is(":visible")) {
            $("body").removeClass("modal-open");
            $(".modal-backdrop").remove();
          }
          this.$swal(
            "Actualizado",
            "negocio actualizado con éxito.",
            "success"
          );
        })
        .catch(error => {
          console.log(error.response.data.code);
          //this.errors = 'error.response.data'
          /*if (error.response.data.code == 2) {
            this.$swal({
              type: "error",
              title: "El nit Ingresado ya se encuentra registrado",
              text: "Por favor verifica los datos"
            });
          }*/
          if (error.response.data.code == 3)
            this.$swal({
              type: "error",
              title: "Favor ingresar un horario de apertura y de cierre",
              text: "Por favor verifica los datos"
            });
        });
    }
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
          this.validar_negocio();

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
            url: "auth/negocios/" + negocio.id,
            method: "DELETE"
          })
            .then(response => {
              this.getNegocios();
              this.validar_negocio();
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
</style>
