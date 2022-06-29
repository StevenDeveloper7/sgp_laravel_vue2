<template>

    <div>

         <header class="main-header color-degradado ">
    <!-- Logo -->
    <a href="#" class="logo bg-info-gradient-animet">
      <!-- mini logo -->
	  <b class="logo-mini">
		  <span class="light-logo"><img src="images/logo-traelo-ve-mini.png" alt="logo"></span>
		  <span class="dark-logo"><img src="images/logo-traelo-ve-mini.png" alt="logo"></span>
	  </b>
      <!-- logo-->
     <!-- <span class="logo-lg">
		  <img src="images/logo-nombre-sya.png" alt="logo" class="light-logo">
	  	  <img src="images/logo-nombre-sya.png" alt="logo" class="dark-logo">
	  </span> -->
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top color-degradado">

      <!-- Sidebar toggle button-->




          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" v-if="this.$auth.user().id_role == 1" v-show="mostrar_menu" >
			<span class="sr-only">Toggle navigation</span>
		  </a>

      <div class="navbar-custom-menu ">


          <ul class="nav navbar-nav ">





            <!-- Messages -->
          <li class="dropdown messages-menu" v-if="this.$auth.user().id_role == 1 || this.$auth.user().id_role == 3">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="mdi mdi-email faa-horizontal animated" v-if="socket_notificaciones.length>=1" v-text="socket_notificaciones.length">
              <span class="badge bg-mo navbar-badge parpadea" ></span></i>

              <i class="mdi mdi-email faa-horizontal" v-else v-text="socket_notificaciones.length">
              <span class="badge bg-mo navbar-badge "  ></span></i>
            </a>
            <ul class="dropdown-menu scale-up">
              <li class="header">Tienes {{socket_notificaciones.length}} pedidos pendientes</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu inner-content-div">
                  <li v-for="socket_notificacion of socket_notificaciones" v-bind:key="socket_notificacion.id"><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img :src="'fotos/'+ socket_notificacion.foto" class="rounded-circle" alt="User Image">
                      </div>
                      <div class="mail-contnet">
                         <h4>
                          {{ socket_notificacion.nombre_completo }}
                          <small><i class="fa fa-clock-o"></i> {{ moment(socket_notificacion.created_at).format('h:mm') }}</small>
                         </h4>
                         <span>{{ socket_notificacion.direccion }}</span>
                      </div>
                    </a>
                  </li>
                  <!-- end message -->

                </ul>
              </li>
              <center><router-link :to="{name: 'pedido_negocios'}" ><li class="footer"><a href="#">Ver todos los pedidos</a></li></router-link></center>
            </ul>
          </li>

            <!-- Ayuda clientes -->
          <li class="dropdown notifications-menu" v-if="this.$auth.user().id_role == 2" v-show="false">
            <a href="#lightbox" data-toggle="modal" data-slide-to="1"  class="dropdown-toggle" >
              <i class="fa fa-question-circle-o"></i>
            </a>
          </li>



          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" @click.prevent="Logout()">Salir&nbsp;<i class="fa fa-sign-out"></i></a>
          </li>

        </ul>

      </div>




    </nav>
  </header>

     <!-- The Modal Loading -->
                <div class="modal fade" tabindex="-1" id="load" aria-hidden="true">
                    <div class="modal-dialog  modal-md modal-dialog-centered" >
                        <div class="modal-content">

                        <!-- Modal body -->
                        <div class="modal-body">
                            <img src="images/spinner.gif" >
                            <label>Cargando...</label>
                        </div>

                        </div>
                    </div>
                </div>

<!-- Modal ayuda cliente -->
         <div class="modal fade" tabindex="-1" id="lightbox" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">

          <!-- Carousel Slider Only Slide -->



				<div id="carousel-example-generic-captions" data-interval="false"  class="carousel slide" data-ride="carousel">
			  		<!-- Indicators -->
					  <ol class="carousel-indicators" >
						<li data-target="#carousel-example-generic-captions" data-slide-to="0" class="active"></li>
						<li data-target="#carousel-example-generic-captions" data-slide-to="1"></li>
						<li data-target="#carousel-example-generic-captions" data-slide-to="2"></li>
					  </ol>
				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" role="listbox">
					<div class="carousel-item active">
					  <img src="images/ayuda1.jpg" class="img-fluid" alt="slide-1">

					</div>
					<div class="carousel-item">
					  <img src="images/ayuda2.jpg" class="img-fluid" alt="slide-2">

					</div>
					<div class="carousel-item">
					  <iframe width="900" height="505" src="https://www.youtube.com/embed/TiXL1v4PP6s" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
				  </div>
				  <!-- Controls -->
				  <a class="carousel-control-prev" href="#carousel-example-generic-captions" role="button"  data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				  </a>
				  <a class="carousel-control-next" href="#carousel-example-generic-captions" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				  </a>
				</div>


        </div><!-- /.modal-body -->
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  </div>

  </template>

  <script>

    export default{

        created: function(){

            this.getCanal();
            this.movil();
            this.movil_menu();

        },

        data(){

            return{
                loading: true,
                socket_notificaciones: [],
                Canal:'',
                mostrar:true,
                mostrar_menu:true,

            }
        },

        sockets: {
            connect() {
            // Fired when the socket connects.
            console.log('socket connected')
            },

            disconnect() {
            console.log('socket disconnected')
            },

            // Fired when the server sends something on the "messageChannel" channel.

        },

        methods:{

            getCanal(){

                this.$http({
                url: 'auth/canal-negocio',
                method: 'GET'
                })
                .then((response) => {

                    this.Canal = response.data;


                    this.$socket.on('server/'+this.Canal[0].canal, function(num){

                    this.socket_notificaciones = num;

                   //console.log(this.socket_notificaciones);
                }.bind(this));
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });


        },

        movil(){

          if (screen.width < 300 || screen.width < 710 ) {

             this.mostrar = false;

          }
      },


      movil_menu(){

          if ( (screen.width < 300 || screen.width < 710)  ) {

             this.mostrar_menu = true;

          }
      },

      onLogout() {
      this.isConnected = false;
    },

             Logout(){

            $("#load").modal("show");

            var redirect = this.$auth.redirect()
            var app = this

            this.onLogout();

            this.$auth.logout({
                makeRequest: true,
                params: {}, // data: {} in axios
                success: function () {

                    $("#load").modal("hide");
                    app.success = true
                    //const redirectTo = 'login'
                    //this.$router.push({name: redirectTo})
                    window.location = '/login';
                },
                error: function () {

                    app.has_error = true
                    app.error = res.response.data.error

                },

            });

        },

        }
    }


</script>

<style>

.modal.and.carousel {
  position: fixed;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {

}

.carousel-control-next-icon:after
{
  content: '>';
  font-size: 55px;
  color: #c35d89;
}

.carousel-control-prev-icon:after {
  content: '<';
  font-size: 55px;
  color: #c35d89;
}

.parpadea {

  animation-name: parpadeo;
  animation-duration: 1s;
  animation-timing-function: linear;
  animation-iteration-count: infinite;

  -webkit-animation-name:parpadeo;
  -webkit-animation-duration: 1s;
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
