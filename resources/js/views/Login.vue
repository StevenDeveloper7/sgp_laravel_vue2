<template>

    <div>

    <img class="wave-login" src="images/wave2.png">
	<div class="container-login">
		<div class="img animar">
			<img src="images/new_logo.png">
		</div>
		<div class="login-content">

			<div class="form-signin" >
				<img src="images/avatar.png" class="img-avatar">
				<h2 class="title">Bienvenido</h2>

           		        <div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend" >
									<span class="input-group-text bg-mo "><i class="ti-user"></i></span>
								</div>
								<input type="text" class="form-control" placeholder="Email" v-model="email">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text bg-mo "><i class="ti-lock"></i></span>
								</div>
								<input type="password" id="password-field" class="form-control" placeholder="Contraseña" v-model="password">

                                <div class="input-group-addon">
                                    <a  type="password" @click="switchVisibility"><i id="pass-status" class="fa fa-eye" aria-hidden="true"></i></a>
                                </div>
							</div>
						</div>




                <div class="row">
                    <div class="col-4">
                    <hr class="my-4">
                    </div>

                    <div class="col-4" style="margin-top: 10px;">
                    <span class="cambio-color">O</span>
                    </div>

                    <div class="col-4">
                    <hr class="my-4">
                    </div>
                </div>



                    <div class="form-group"  style="width:400px;">
                        <facebook-login class="button"
                            appId="383038672634589"
                            @login="onLogin"
                            @logout="onLogout"
                            @sdk-loaded="sdkLoaded"
                            loginLabel="Iniciar sesión con Facebook"
                            >
                        </facebook-login>
                    </div>
                    <p>Solo disponible para clientes</p>


                <br><br>
            	<router-link :to="{name: 'register'}"><a class="cambio-color" href="#">¿No tienes una cuenta? Regístrate</a></router-link>
            	<input type="submit" class="btn-login" value="Iniciar Sesión" @click.prevent="login()">
               <p class="cambio-color"> &copy; 2020 <a class="cambio-color" href="https://www.sya-tecnova.com/"> Sya Tecnova S.A.S</a>. Todos los derechos reservados.</p>
            </div>

        </div>

    </div>


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


    </div>

</template>
<script>

import facebookLogin from 'facebook-login-vuejs';

  export default {
    data() {
      return {

        email: null,
        password: null,
        success: false,
        has_error: false,
        error: '',
        loading: true,
        passwordFieldType: 'password'
      }
    },
    mounted() {
      //
    },
    methods: {

    info_cliente(){

       this.$swal.mixin({

        confirmButtonText: 'Siguiente',
        confirmButtonColor: '#7f82eb',
        showCancelButton: true,
        cancelButtonColor: '#c35d89',
        progressstepsColor: '#7f82eb',
        progressSteps: ['1', '2', '3', '4']
        }).queue([
        {
             title: 'Bienvenido a Traelo Ve!',
             imageUrl: "images/bienvenido.png",
             imageWidth: 300,
             imageHeight: 300,
             imageAlt: 'Custom image',
             text: 'Una aplicación web que te acerca a los negocios sin salir de casa'
        },
        {
            title: 'Pide lo que quieras ve!',
            imageUrl: "images/maps.png",
            imageWidth: 400,
            imageHeight: 238,
            imageAlt: 'Custom image',
            text: 'Pide los productos de tus locales favoritos'
        },
        {
            title: 'De forma segura',
            imageUrl: "images/online.png",
            imageWidth: 400,
            imageHeight: 265,
            imageAlt: 'Custom image',
            text: 'Evitando aglomeraciones innecesarias'
        },
        {

            imageUrl: "images/logo-sya.png",
            imageWidth: 400,
            imageHeight: 192,
            imageAlt: 'Custom image',
            text: 'Apoyando a los negocios y familias del país'
        },
        ]).then((result) => {
        if (result.value) {
            const answers = JSON.stringify(result.value)
            Swal.fire({
            title: 'All done!',
            html: `
                Your answers:
                <pre><code>${answers}</code></pre>
            `,
            confirmButtonText: 'Lovely!'
            })
        }
        })


        },


        completar_registro(){

       this.$swal.mixin({

        confirmButtonText: 'Siguiente',
        confirmButtonColor: '#7f82eb',
        showCancelButton: true,
        cancelButtonColor: '#c35d89',
        progressstepsColor: '#7f82eb',
        progressSteps: ['1', '2', '3', '4']
        }).queue([
        {
             title: 'Bienvenido a Traelo Ve!',
             imageUrl: "images/config_facebook1.jpg",
             imageWidth: 244,
             imageHeight: 68,
             imageAlt: 'Custom image',
             text: ' Agrega tu número de celular para que te podamos confirmar via sms, cuando un pedido ha sido despachado.'
        },
        {

            imageUrl: "images/config_facebook2.jpg",
            imageWidth: 244,
            imageHeight: 68,
            imageAlt: 'Custom image',
            text: 'Debes agregar la dirección en la cual vas a recibir tus pedidos.'
        },
        {

            imageUrl: "images/config_facebook3.jpg",
            imageWidth: 244,
            imageHeight: 68,
            imageAlt: 'Custom image',
            text: 'Debes agregar tu ciudad de residencia.'
        },
        {

            imageUrl: "images/config_facebook4.jpg",
            imageWidth: 244,
            imageHeight: 68,
            imageAlt: 'Custom image',
            text: 'Para terminar debes hacer click en actualizar información'
        },
        ]).then((result) => {
        if (result.value) {
            const answers = JSON.stringify(result.value)
            Swal.fire({
            title: 'All done!',
            html: `
                Your answers:
                <pre><code>${answers}</code></pre>
            `,
            confirmButtonText: 'Lovely!'
            })
        }
        })


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

      login() {

         $("#load").modal("show");
         const authUser = {}

        var redirect = this.$auth.redirect()
        var app = this

        this.$auth.login({
          data: {
            email: app.email,
            password: app.password
          },
          success: function(res) {


            authUser.data = this.$auth.user();

            console.log(authUser);

            $("#load").modal("hide");

            app.success = true

            window.localStorage.setItem('lbUser',JSON.stringify(authUser));

            if(this.$auth.user().id_role === 1 ){

                const redirectTo = 'dashboard'
                this.$router.push({name: redirectTo})

            }if(this.$auth.user().id_role === 2){

                this.info_cliente();

                const redirectTo = 'cliente_negocios'
                this.$router.push({name: redirectTo})

            }if(this.$auth.user().id_role === 3){

                const redirectTo = 'pedido_negocios'
                this.$router.push({name: redirectTo})

            }if(this.$auth.user().id_role === 4){

                const redirectTo = 'admin_usuarios'
                this.$router.push({name: redirectTo})
            }


          },

          error: function(res) {
            app.has_error = true
            app.error = res.response.data.error

            $("#load").modal("hide");

            if(res.response.data.code == 1){
                    this.$swal({
                    type: 'error',
                    title: 'El correo ingresado no se encuentra registrado',
                    text: 'Por favor verifica los datos',
                    })
                }

            if(res.response.data.code == 2){
                    this.$swal({
                    type: 'error',
                    title: 'Email o contraseña incorrectos',
                    text: 'Por favor verifica los datos',
                    })
                }




          },
          rememberMe: true,
          fetchUser: true
        })


      },


//login Facebook
  getUserData() {

      $("#load").modal("show");

      var me = this;

      const authUser = {}

      this.FB.api('/me', 'GET', { fields: 'id,name,email' },
        userInformation => {
          console.warn("la información de fb",userInformation)

          me.personalID = userInformation.id;
          me.email_fb = userInformation.email;
          me.name = userInformation.name;


          axios.post('auth/login-facebook',{

          email: me.email_fb,
          password: me.personalID,
          name: me.name

      })

    .then(response => {


      authUser.data = response.data.user

      window.localStorage.setItem('lbUser',JSON.stringify(authUser));

      me.$auth.login({
          data: {
            email: me.email_fb,
            password: me.personalID
          },
        success: function(res) {

            $("#load").modal("hide");

            if(response.data.redirect == 'home'){

            const redirectTo = 'cliente_negocios'
            me.$router.push({name: redirectTo})

        }else{

            me.completar_registro()

            const redirectTo = 'configuracion_facebook'
            me.$router.push({name: redirectTo})


      }

        },

        })





    }).catch((error) => {



                });



        }
      )
    },
    sdkLoaded(payload) {

      this.isConnected = payload.isConnected
      this.FB = payload.FB
      if (this.isConnected) this.getUserData()

    },

    onLogin() {
      this.isConnected = true
      this.getUserData()
    },

    onLogout() {
      this.isConnected = false;
    }

    },

    components: {
              facebookLogin,
              //GoogleLogin
        }



  }
</script>

<style>

body{
    background-color:#F4F6F9;
}

</style>
