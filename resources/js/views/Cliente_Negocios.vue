<template>
  <div>
    <div class="content-wrapper">
      <div class="row" style="height:71px;">
        <div class="col-md-12">
          <div class="media align-items-center bg-white mb-20">
            <span class="avatar bg-primary">
              <i class="fa fa-home"></i>
            </span>
            <div class="media-body" style="text-align:center;">
              <h3>
                <strong class="fuente-movil"> Aquí se encuentran los negocios disponibles ve! </strong>
              </h3>
            </div>
          </div>
        </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="row">

                <div class="col-md-2">



                </div>

                    <div class="input-group col-md-4" id="mysearch">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-mo" id="basic-text1">
                                    <i class="fa fa-search text-white" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control ph-center" placeholder="¿ Donde te encuentras ve! ?" v-model="searchAddressInput" v-on:change="searchLocation()">
                    </div>

                    <div class="input-group col-md-4" >
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-ro" id="basic-text1">
                                    <i class="fa fa-search text-white" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control ph-center" placeholder="¿ Qué buscas ve! ?" v-model="producto" v-on:change="negocio_productos()">
                    </div>

            <br><br>

          <div class="col-md-12">

            <gmap-map
              :center="center"
              :zoom="15"
              style="width:100%;  height:600px; "
              id="map"
              ref="mymap"
              v-bind:options="mapStyle"
            >
              <gmap-marker
                :key="index"
                v-for="(m, index) in markers"
                :position="m.position"
                @click="toggleInfoWindow(m,index)"
                :clickable="true"
                :icon="m.icon"
                :animation="m.animation"
              ></gmap-marker>

              <gmap-info-window
                :options="infoOptions"
                :position="infoWindowPos"
                :opened="infoWinOpen"
                @closeclick="infoWinOpen=false"
              >
                <div v-html="infoContent">


                </div>

                <div v-if="this.validar == 0" >

                <center><h5 style="color:#00c767;">ABIERTO</h5></center>
                <center><router-link :to="{name: 'cliente_pedidos', params: {id: idNegocio, nombre: nombre_completo, direccion: direccion, foto: foto,
                hora_apertura: hora_apertura, hora_cierre: hora_cierre, check_key_wompi: check_key_wompi, key_wompi: key_wompi }}">
                  <button type="button" class="btn  btn-rounded bg-mo"   title="Ver Productos" >
                    Ver Productos
                  </button>
                </router-link></center>
                </div>

                <div v-else>
                  <center><h5 style="color:red">CERRADO</h5></center>

                </div>

              </gmap-info-window>
            </gmap-map>




            <!-- /.box-body -->


          </div>
        </div>
      </section>
    </div>
  </div>
</template>

<script>

import * as VueGoogleMaps from "vue2-google-maps";
import LayoutDefault from "../components/layouts/Principal.vue";
import { gmapApi } from 'vue2-google-maps';

export default {
  name: "GoogleMap",

  created: function() {

    this.addMarker();
    this.$emit("update:layout", LayoutDefault);
    this.geolocate();
  },

  data() {
    return {

         mapStyle: {

             scrollwheel: false,
             minZoom :  13 ,
             maxZoom :  15 ,

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

      center: { lat: 45.518, lng: -122.672 },
      markers: [],
      places: [],
      searchAddressInput: '',
      currentPlace: null,
      fotoMiniatura: "",
      Negocios: [],
      loading: true,
      errors: [],
      timer: "",
      infoContent: "",
      infoWindowPos: {
        lat: 0,
        lng: 0
      },
      infoWinOpen: false,
      currentMidx: null,
      //optional: offset infowindow so it visually sits nicely on top of our marker
      infoOptions: {
        pixelOffset: {
          width: 0,
          height: -35
        },
        map: null,
        marker: null,
        marker_temp: "",
        idNegocio:0,
        nombre_completo:'',
        direccion:'',
        foto:'',
        hora_apertura:'',
        hora_cierre:'',
        validar:0,
        check_key_wompi:'',
        key_wompi:'',
        producto:''
      }
    };
  },

  computed: {
    //google: gmapApi,
  },

   mounted() {

       this.geolocate();
       setTimeout(this.ubicacionNegocios, 1000);


    },

  methods: {
    setPlace(place) {
      this.currentPlace = place;
    },

    addMarker() {
      if (this.currentPlace) {
        const marker = {
          lat: this.currentPlace.geometry.location.lat(),
          lng: this.currentPlace.geometry.location.lng()
        };
        this.markers.push({ position: marker });
        this.places.push(this.currentPlace);
        this.center = marker;
        this.currentPlace = null;
      }
    },

    geolocate: function() {

      navigator.geolocation.getCurrentPosition(position => {
        this.center = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };


      });


    },

    updategeolocate(place) {


       var options = { enableHighAccuracy: true, maximumAge: 100, timeout: 60000 };
       if( navigator.geolocation) {
         var watchID = navigator.geolocation.watchPosition( gotPos, gotErr, options );
          var timeout = setTimeout( function() {
            navigator.geolocation.clearWatch( watchID );
            }, 5000 );
            } else {
               gotErr(); }
     },

     searchLocation: function() {
      var geocoder = new google.maps.Geocoder();
      geocoder.geocode({'address': this.searchAddressInput}, (results, status) => {
        if (status === 'OK') {
          this.center.lat = results[0].geometry.location.lat();
          this.center.lng = results[0].geometry.location.lng();
        }
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

    ubicacionNegocios() {

        //Hora actual del sistema
        const moment = require('moment');
        const hora_server = moment(new Date()).local().format('HH:mm');

      this.$http({
        url: "auth/cliente_negocios",
        method: "GET"
      })
        .then(response => {
          this.Negocios = response.data;

          for (var i = 0; i < this.Negocios.length; i++) {

            var img = "images/marker2.png";
            var img2 = "images/marker2-gray.png";


            if( hora_server >= this.Negocios[i].hora_cierre ){

                var marker = new google.maps.Marker({
                position: {
                    lat: parseFloat(this.Negocios[i].lat),
                    lng: parseFloat(this.Negocios[i].long)
                },
                map: this.map,
                icon: img2,
                nombre_completo: this.Negocios[i].nombre_completo,
                foto: this.Negocios[i].foto,
                id_negocio: this.Negocios[i].id,
                descripcion: this.Negocios[i].descripcion,
                direccion: this.Negocios[i].direccion,
                hora_apertura: this.Negocios[i].hora_apertura,
                hora_cierre: this.Negocios[i].hora_cierre,
                validar:1,
                check_key_wompi: this.Negocios[i].check_key_wompi,
                key_wompi: this.Negocios[i].key_wompi,
                animation: google.maps.Animation.DROP
                });

                 this.markers.push(marker);

            }else{

            var marker = new google.maps.Marker({
              position: {
                lat: parseFloat(this.Negocios[i].lat),
                lng: parseFloat(this.Negocios[i].long)
              },
              map: this.map,
              icon: 'images/' + this.Negocios[i].marcador,
              nombre_completo: this.Negocios[i].nombre_completo,
              foto: this.Negocios[i].foto,
              id_negocio: this.Negocios[i].id,
              descripcion: this.Negocios[i].descripcion,
              direccion: this.Negocios[i].direccion,
              hora_apertura: this.Negocios[i].hora_apertura,
              hora_cierre: this.Negocios[i].hora_cierre,
              check_key_wompi: this.Negocios[i].check_key_wompi,
              key_wompi: this.Negocios[i].key_wompi,
              validar:0,
              animation: google.maps.Animation.DROP
            });

            this.markers.push(marker);

            }
          }

        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },



     deleteMarkers() {
        //setMapOnAll(null);
        this.markers = [];
  },


    negocio_productos(){

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

         //Hora actual del sistema
        const moment = require('moment');
        const hora_server = moment(new Date()).local().format('HH:mm');

      this.deleteMarkers();

      this.$http({
        url: "auth/search-negocio-producto/" + this.producto,
        method: "GET"
      })
        .then(response => {
          this.Negocios = response.data;


          for (var i = 0; i < this.Negocios.length; i++) {

            var img = "images/marker2.png";
            var img2 = "images/marker2-gray.png";


            if( hora_server >= this.Negocios[i].hora_cierre ){

                var marker = new google.maps.Marker({
                position: {
                    lat: parseFloat(this.Negocios[i].lat),
                    lng: parseFloat(this.Negocios[i].long)
                },
                map: this.map,
                icon: img2,
                nombre_completo: this.Negocios[i].nombre_completo,
                foto: this.Negocios[i].foto,
                id_negocio: this.Negocios[i].id,
                descripcion: this.Negocios[i].descripcion,
                direccion: this.Negocios[i].direccion,
                hora_apertura: this.Negocios[i].hora_apertura,
                hora_cierre: this.Negocios[i].hora_cierre,
                validar:1,
                check_key_wompi: this.Negocios[i].check_key_wompi,
                key_wompi: this.Negocios[i].key_wompi,
                animation: google.maps.Animation.DROP
                });

                 this.markers.push(marker);

            }else{

            var marker = new google.maps.Marker({
              position: {
                lat: parseFloat(this.Negocios[i].lat),
                lng: parseFloat(this.Negocios[i].long)
              },
              map: this.map,
              icon: 'images/' + this.Negocios[i].marcador,
              nombre_completo: this.Negocios[i].nombre_completo,
              foto: this.Negocios[i].foto,
              id_negocio: this.Negocios[i].id,
              descripcion: this.Negocios[i].descripcion,
              direccion: this.Negocios[i].direccion,
              hora_apertura: this.Negocios[i].hora_apertura,
              hora_cierre: this.Negocios[i].hora_cierre,
              validar:0,
              check_key_wompi: this.Negocios[i].check_key_wompi,
              key_wompi: this.Negocios[i].key_wompi,
              animation: google.maps.Animation.DROP
            });

            this.markers.push(marker);

            }
          }

          this.$swal.close();

        })
        .catch(error => {
          console.log(error.response.data.code);

            if (error.response.data.code == 2)

                this.ubicacionNegocios();

                this.$swal({
                type: "error",
                title: "No se encontraron coincidencias",
                text: "Por favor verifica la información ingresada"
                });

        });




    },



    toggleInfoWindow: function(marker, idx) {

      this.idNegocio=marker.id_negocio;
      this.validar=marker.validar;
      this.nombre_completo=marker.nombre_completo;
      this.direccion=marker.direccion;
      this.foto=marker.foto;
      this.hora_apertura=marker.hora_apertura;
      this.hora_cierre=marker.hora_cierre;
      this.check_key_wompi=marker.check_key_wompi;
      this.key_wompi=marker.key_wompi;


      this.infoWindowPos = marker.position;
      this.infoContent = this.getInfoWindowContent(marker);

      //check if its the same marker that was selected if yes toggle
      if (this.currentMidx == idx) {
        this.infoWinOpen = !this.infoWinOpen;
      }
      //if different marker set infowindow to open and reset current marker index
      else {
        this.infoWinOpen = true;
        this.currentMidx = idx;
      }
    },

    getInfoWindowContent: function(marker) {
      return `<div class="card">
          <div class="card-image">
            <figure class="image is-4by3">
           <center> <img src="fotos-negocios/${marker.foto}" class="avatar avatar-xxl rounded"> </center>
            </figure>
          </div>
          <div class="card-content">

            <div class="row ">
              <div class="col-md-12">
                <h6 class="title is-4" style="text-align:center;">${marker.nombre_completo}</h6>
              </div>
            </div>
            <div class="row ">
                <div class="col-md-12">
                <h6 class="title is-4" style="text-align:center;">${marker.descripcion} </h6>
              </div>
            </div>
            <div class="row ">
                <div class="col-md-12">
                <h6 class="title is-4" style="text-align:center;">${marker.direccion} </h6>
              </div>
            </div>
            <div class="row ">
                <div class="col-md-12">
                <h6 class="title is-4" style="text-align:center;">Horario de apertura</h6>
              </div>
            </div>
            <div class="row ">
                <div class="col-md-12">
                <h6 class="title is-4" style="text-align:center;">${marker.hora_apertura} - ${marker.hora_cierre}</h6>
              </div>
            </div>

          </div>
        </div>`;
    }
  }
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


@media only screen and (min-width: 300px) and (max-width: 710px) {


    .fuente-movil{
    font-size: 10px;
    }



  }




.custom-input{

    border-radius: 0;
}

.ph-center::-webkit-input-placeholder {
  text-align: center;
  line-height: 100px;/* Centrado vertical */
}

.div-align{
    margin-bottom: 20px;

}

.content{
        background-color: #c4dff7!important;
}
</style>
