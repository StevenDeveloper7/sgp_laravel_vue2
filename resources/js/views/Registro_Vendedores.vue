<template>
<div>

    <img class="wave-login" src="images/wave2.png" />
    <div class="container-login">
      <div class="img animar">

      </div>
      <div class="login-content">

 <form @submit.prevent="register" v-if="!success" method="post">

                        <br>
                  <img src="images/store.png" class="img-avatar"/>
                  <h2 class="title">Bienvenido</h2>

                  <p>¡Vende fácil y rápido!</p>

                      <br>
                   <h2 class="title">Datos de tu negocio</h2>
                    <br>


                            <div class="form-group">

                            <v-select label="nombre"  placeholder="Tipo Documento" :required="!id_tipo" :options="arraydocumentos" :reduce="nombre => nombre.id" v-model="id_tipo" ></v-select>

                            </div>

                        <div class="form-group">


                                <validation-provider rules="positive|required|numeric" v-slot="{ errors }">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-mo">
                                <i class="fa fa-id-card"></i>
                              </span>
                            </div>
                            <input
                              type="number"
                              class="form-control"
                              placeholder="Número Documento"

                              v-model="numero_documento"
                              min="1"
                              pattern="[0-9]+"
                                required
                            />
                          </div>
                          <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>

                        </div>




                        <div class="form-group">

                        <validation-provider rules="required" v-slot="{ errors }">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-mo">
                                <i class="fa fa-id-card"></i>
                              </span>
                            </div>
                            <input
                              type="text"
                              class="form-control"
                              placeholder="Razón social"
                              v-model="razon_social"
                              required
                            />
                          </div>
                          <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
                          <!-- /.input group -->

                        </div>


                        <div class="form-group">

                            <validation-provider rules="required" v-slot="{ errors }">
                                <v-select label="nombre" placeholder="Ciudad"  :options="arrayciudads" :reduce="nombre => nombre.id" v-model="id_ciudad"></v-select>
                                <span style="color:red">{{ errors[0] }}</span>
                            </validation-provider>

                        </div>

                        <div class="form-group">

                        <validation-provider rules="required" v-slot="{ errors }">
                            <v-select label="nombre" placeholder="Categoria de tu negocio" :options="arraycategorias" :reduce="nombre => nombre.id" v-model="id_categoria"></v-select>

                     <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>

                    </div>

                        <div class="form-group row">
                                &nbsp; &nbsp; &nbsp;
                        <validation-provider rules="required" v-slot="{ errors }">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-mo">
                                <i class="fa fa-map-marker"></i>
                              </span>
                            </div>
                            <input
                              type="text"
                              class="form-control"
                              placeholder="Dirección"
                              v-model="searchAddressInput"
                              required
                            />
                          </div>
                          <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>

                            &nbsp; &nbsp; &nbsp;

                            <button
                                type="button"
                                class="btn btn-success btn-rounded"
                                v-on:click.prevent="searchLocation()"
                                ><i class="fa fa-search">&nbsp;Buscar</i>
                            </button>


                        </div>

                        <div class="form-group">

                            <gmap-map ref="mymap" id="mymap" :center="center" :zoom="15" style="width: 100%; height: 300px" v-bind:options="mapStyle">

                                <gmap-marker :position="center" :draggable="true" @drag="updateCoordinates" :icon="icono" />

                            </gmap-map>

                        </div>

                    <br>
                    <h6 class="cambio-color">Horario de apertura y cierre formato 24 horas</h6>
                    <br>

                  <div class="form-group row">

                        &nbsp; &nbsp;  &nbsp;

                         <validation-provider rules="required" v-slot="{ errors }">

                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-mo">
                                <i class="fa fa-clock-o"></i>
                              </span>
                            </div>
                            <vue-timepicker  v-model="hora_apertura"></vue-timepicker>
                          </div>
                          <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>

                            &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                        <validation-provider rules="required" v-slot="{ errors }">

                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-mo">
                                <i class="fa fa-clock-o"></i>
                              </span>
                            </div>
                            <vue-timepicker  v-model="hora_cierre"></vue-timepicker>
                          </div>
                          <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
                          <!-- /.input group -->


                </div>

                <br>
                <div class="form-group">

                        <validation-provider rules="required" v-slot="{ errors }">

                                            <div class="input-group mb-3">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text bg-mo"
                                                        ><i
                                                            class="fa fa-id-card"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <textarea
                                                    name="descripcion"
                                                    id="descripcion"
                                                    class="form-control"
                                                    v-model="descripcion"
                                                    placeholder="Breve descripción de tu negocio"
                                                    required
                                                ></textarea>
                                            </div>
                                            <span style="color:red">{{ errors[0] }}</span>
                                    </validation-provider>

                </div>

                    <h2 class="title cambio-color" >¿ A quién contactamos ?</h2>

                        <br>

                        <div class="form-group">
                            <validation-provider rules="positive|required|numeric" v-slot="{ errors }">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-mo">
                                <i class="fa fa-phone"></i>
                              </span>
                            </div>
                            <input
                              type="number"
                              class="form-control"
                              placeholder="Teléfono"
                              v-model="telefono"
                              required/>
                          </div>
                          <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
                          <!-- /.input group -->
                        </div>


                        <div class="form-group">

                        <validation-provider rules="required" v-slot="{ errors }">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-mo">
                                <i class="fa fa-id-card"></i>
                              </span>
                            </div>
                            <input
                              type="text"
                              class="form-control"
                              placeholder="Nombre completo"
                              v-model="nombre_completo"
                              required
                            />
                          </div>
                          <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
                          <!-- /.input group -->

                        </div>

                        <h2 class="title cambio-color">Datos de acceso</h2>

                        <br>

                        <p class="cambio-color">Correo y contraseña para acceder a tu cuenta</p>

                        <div class="form-group">
                            <validation-provider name="email" rules="required|email" v-slot="{ errors }">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-mo">
                                <i class="ti-email"></i>
                              </span>
                            </div>
                            <input
                              type="email"
                              class="form-control"
                              placeholder="Email"
                              v-model="email"
                              required
                            />
                          </div>
                          <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
                        </div>



                        <div class="form-group">
                            <validation-provider name="email" rules="required" v-slot="{ errors }">
                          <div class="form-group">
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-mo">
                                  <i class="ti-lock"></i>
                                </span>
                              </div>
                              <input
                                type="password"
                                class="form-control"
                                placeholder="Contraseña"
                                v-model="password"
                                required
                                id="password-field"
                              />
                              <div class="input-group-addon">
                                    <a  type="password" @click="switchVisibility"><i id="pass-status" class="fa fa-eye" aria-hidden="true"></i></a>
                                </div>
                            </div>
                          </div>
                          <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
                        </div>



                        <div class="form-group">
                             <validation-provider name="password" rules="required" v-slot="{ errors }">
                          <div class="form-group">
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-mo">
                                  <i class="ti-lock"></i>
                                </span>
                              </div>
                              <input
                                type="password"
                                class="form-control"
                                placeholder="Confirmar Contraseña"
                                v-model="password_confirmation"
                                required
                                id="password-field-confirmation"
                              />
                              <div class="input-group-addon">
                                    <a  type="password" @click="switchVisibility2"><i id="pass-status2" class="fa fa-eye" aria-hidden="true"></i></a>
                                </div>
                            </div>
                          </div>
                                <span style="color:red">{{ errors[0] }}</span>
                            </validation-provider>
                        </div>

                        <div class="col-md-4"></div>



                      <div class="col-md-12">

                        <div class="checkbox">
                          <input type="checkbox" id="basic_checkbox_1"   @click="validate()" />
                          <label for="basic_checkbox_1" class="cambio-color ">Acepto</label>
                          <a href="terminos/terminosycondiciones.html" target="_blank" class="cambio-color ">Términos y condiciones</a>
                        </div>

                      </div>

                    <br><br>
                      <div class="col-md-12">
                        <router-link :to="{name: 'login'}">
                          <a class="cambio-color" href="#">¿Ya tienes una cuenta? Inicia Sesión</a>
                        </router-link>
                      </div>

                      <!-- aqui -->

                      <div class="col-md-12">
                        <input type="submit" class="btn-login" value="Crear Cuenta" />
                      </div>




                  <p class="cambio-color">
                    &copy; 2020
                    <a class="cambio-color" href="https://www.sya-tecnova.com/">Sya Tecnova S.A.S</a>. Todos los derechos reservados.
                  </p>
                </form>


    </div>
    </div>


    <!-- The Modal Loading -->
    <div class="modal fade" tabindex="-1" id="load" aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
          <!-- Modal body -->
          <div class="modal-body">
            <img src="images/spinner.gif">
            <label>Cargando...</label>
          </div>
        </div>
      </div>
    </div>


</div>
</template>


<script>


import { ValidationProvider, extend } from 'vee-validate';
import { required, email } from 'vee-validate/dist/rules';
import { numeric } from 'vee-validate/dist/rules';

import VueTimepicker from 'vue2-timepicker'

import 'vue2-timepicker/dist/VueTimepicker.css'


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


    this.select_tipo_documento();
    this.select_departamento();
    this.select_ciudad();
    this.geolocate();
    this.select_categoria();

  },

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
      searchAddressInput: '',
      numero_documento: "",
      nombre_completo: "",
      razon_social: "",
      descripcion: '',
      email: "",
      password: "",
      id_tipo: "",
      id_departamento: "",
      id_ciudad: '',
      direccion: "",
      telefono: "",
      password_confirmation: "",
      has_error: false,
      error: "",
      errors: {},
      success: false,
      arraydocumentos: [],
      arraydepartamentos: [],
      arrayciudads: [],
      loading: true,
      toggle: true,
      markers: [],
      places: [],
      terminos: false,
      icono: "images/marker2.png",
      hora_apertura: '',
      hora_cierre: '',
      arraycategorias: [],
      id_categoria: '',
      coordinates: null,
      passwordFieldType: 'password',
      formatted_address: ''

    };
  },

  mounted() {


        this.geolocate();

    },

  methods: {

       methodToRunOnSelect(payload) {
            this.object = payload;
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
      geocoder.geocode({'address': this.searchAddressInput}, (results, status) => {
        if (status === 'OK') {
          this.center.lat = results[0].geometry.location.lat();
          this.center.lng = results[0].geometry.location.lng();
          //console.log(results[0].geometry.location.lat() + results[0].geometry.location.lng())



          this.$swal.close();
        }
      });
    },

    editsearchLocation: function() {
      var geocoder = new google.maps.Geocoder();
      geocoder.geocode({'address': this.fillnegocios.direccion}, (results, status) => {
        if (status === 'OK') {
          this.center.lat = results[0].geometry.location.lat();
          this.center.lng = results[0].geometry.location.lng();
          //console.log(results[0].geometry.location.lat() + results[0].geometry.location.lng())
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

    validate() {

        var isChecked = document.getElementById('basic_checkbox_1').checked;
        if(isChecked){
            this.terminos = true;
        }


    },

    switchVisibility() {

        var passwordInput = document.getElementById('password-field');
        var passStatus = document.getElementById('pass-status');

        if (passwordInput.type == 'password'){
            passwordInput.type='text';
            passStatus.className='fa fa-eye-slash';

        }
        else{
            passwordInput.type='password';
            passStatus.className='fa fa-eye';
        }
    },

    switchVisibility2() {

        var passwordInput = document.getElementById('password-field-confirmation');
        var passStatus = document.getElementById('pass-status2');

        if (passwordInput.type == 'password_confirmation'){
            passwordInput.type='text';
            passStatus.className='fa fa-eye-slash';

        }
        else{
            passwordInput.type='password_confirmation';
            passStatus.className='fa fa-eye';
        }
    },

    select_categoria() {
      let me = this;
      this.$http({
        url: "select_categoria_negocio",
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

    select_tipo_documento() {
      let me = this;
      let url = "documentos";
      axios
        .get(url)
        .then(response => {
          me.arraydocumentos = response.data.documentos;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },

    select_departamento() {
      let me = this;
      let url = "departamentos";
      axios
        .get(url)
        .then(response => {
          me.arraydepartamentos = response.data.departamentos;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },

    select_ciudad() {
      let me = this;
      let url = "ciudads";
      axios
        .get(url)
        .then(response => {
          me.arrayciudads = response.data.ciudads;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },

    register() {

      var array_hora_apertura = this.hora_apertura.split(':');
      var hora_apertura_formateada = array_hora_apertura[0];
      var minutos_apertura_formateada = array_hora_apertura[1];

      var array_hora_cierre = this.hora_cierre.split(':');
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


     }else if( this.hora_apertura == this.hora_cierre) {

        this.$swal({
                    type: 'error',
                    title: 'Horario del negocio',
                    text: 'El horario de apertura y de cierre no deben ser iguales ni vacios'
                    })

        }else if(this.terminos == false){

            this.$swal({
                    type: 'error',
                    title: 'Términos y condiciones',
                    text: 'Para continuar con el registro debes aceptar los términos y condiciones'
                    })

        }else{


      this.addMarker();

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

      var app = this;
      this.$auth.register({

        data: {

          id_tipo_documento: app.id_tipo,
          numero_documento: app.numero_documento,
          nombre_completo: app.nombre_completo,
          razon_social: app.razon_social,
          direccion: app.direccion_real,
          id_ciudad: app.id_ciudad,
          lat : app.lat_real,
          long : app.long_real,
          telefono: app.telefono,
          hora_apertura: app.hora_apertura,
          hora_cierre: app.hora_cierre,
          id_categoria: app.id_categoria,
          descripcion: app.descripcion,
          email: app.email,
          password: app.password,
          password_confirmation: app.password_confirmation,
          id_role: 1,
        },
        success: function() {

          app.success = true;
          this.$router.push({
            name: "login",
            params: { successRegistrationRedirect: true }
          });

          this.$swal(
            "Creada",
            "Cuenta creada con éxito.",
            "success"
          );
        },
        error: function(res) {
          // console.log(res.response.data.errors)
          app.has_error = true;
          app.error = res.response.data.error;
          if(res.response.data.code == 1){
                    this.$swal({
                    type: 'error',
                    title: 'Este correo ya se encuentra registrado',
                    text: 'Por favor verifica los datos',
                    })
                }
        }
      });

        }

    }

  },

    components: {
    ValidationProvider,
    VueTimepicker,
  },


};
</script>

<style>

.v-select {
    background: white!important;
}


.inner-addon {
  position: relative;
}
.inner-addon .glyphicon {
  position: absolute;
  padding: 10px;
  pointer-events: none;
}
.left-addon .glyphicon {
  left: 0px;
}
.right-addon .glyphicon {
  right: 0px;
}
.left-addon input {
  padding-left: 30px;
}
.right-addon input {
  padding-right: 30px;
}
</style>
