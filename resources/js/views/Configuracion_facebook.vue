<template>

    <div>

        <notificaciones></notificaciones>

        <div class="content-wrapper">

            <div class="row">

                <div class=" col-md-12 ">
                    <div class="media align-items-center bg-white mb-20">
                    <span class="avatar  bg-primary"><i class="fa fa-cog"></i></span>
                    <div class="media-body">
                        <h3><strong></strong></h3>
                    </div>
                    </div>
                </div>

            </div>

        <section class="content">

            <div class="row">

                <div class="col-md-6">
            <form  method="POST" v-on:submit.prevent="updateUsuario" >
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Completar registro</h3>
              </div>
              <div class="card-body">

                 <div class="box card-inverse bg-img" style="background-image: url(images/fondo-clientes.jpg); padding-top: 100px">

              <div class="flexbox align-items-center px-20" data-overlay="4">
                <div class="flexbox align-items-center mr-auto">
                  <a >
                    <img class="avatar avatar-xl avatar-bordered" :src="fotoMiniatura" alt="foto">
                  </a>
                  <div class="pl-10 d-none d-md-block">

                  </div>
                </div>

                <ul class="flexbox flex-justified text-center py-20">

                  <li class="pl-10" @change="obtenerFoto">
                    <label for="file-upload" class="subir">
                        Actualiza tu foto de perfil
                    <i class="fa fa-camera" style="width:50px;"></i>
                    </label>
                    <input id="file-upload" type="file" name="foto"  class="form-control-file" style='display: none;'>

                  </li>
                </ul>

              </div>
            </div>

                 <div class="form-group row">

                     <div class="col-md-4">
					  <label for="nombre">Nombre Completo</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
						  </div>
						   <input id="nombre" type="text" class="form-control" v-model="newnombre_completo" required pattern="[A-Z a-z\sáéíóú]+" title="Ingrese sólo Letras">

						</div>
						<!-- /.input group -->
				  	</div>

                    <div class="col-md-4">
                        <label for="edit-ciudad">Ciudad</label>
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="fa fa-map-marker"></i>
                                </span>
                            </div>
                            <select class="custom-select" v-model="newid_ciudad">
                                <option value="0" disabled>Seleccione</option>
                                <option
                                v-for="ciudad in arrayciudades"
                                :key="ciudad.id"
                                :value="ciudad.id"
                                required
                                >{{ciudad.nombre}}</option>
                            </select>
                            </div>
                    </div>


                     <div class="col-md-4">
					 <label for="telefono">Celular</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-phone"></i></span>
						  </div>
						   <input id="telefono" type="number" class="form-control" v-model="newtelefono" min="1" required pattern="[0-9]+" title="Ingrese sólo Números">
						</div>
						<!-- /.input group -->
				  	</div>


				</div>

          <div class="form-group row">

               <div class="col-md-4">
					   <label for="direccion">Dirección</label>
						  <div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-map-marker"></i></span>
						  </div>
						   <input id="direccion" type="text" class="form-control" v-model="newdireccion">
						</div>
						<!-- /.input group -->
				  	</div>


            <div class="col-md-4">
					   <label for="email">Email</label>
						  <div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-at"></i></span>
						  </div>
						   <input id="email" type="text" class="form-control" v-model="newemail">
						</div>
						<!-- /.input group -->
				  	</div>


            <div class="col-md-4">
                    <label for="email">Contraseña</label>
						  <div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="ti-lock"></i></span>
						  </div>
						   <input id="email" type="password" class="form-control" v-model="newpassword">
						</div>
						<!-- /.input group -->
				  	</div>


            </div>



              </div>
              <div class="card-footer clearfix">

                    <button type="submit" class="btn btn-bold btn-pure btn-success float-right btn-rounded" style="margin-top:10px; margin-right:10px; margin-bottom:10px;">Actualizar</button>
                </div>


              <!-- /.card-body -->
            </div>
            </form>
            </div>




            </div>




        </section>





        </div>



    </div>



</template>

<script>



        export default{

            created: function (){

            this.select_tipo_documento();
            this.select_ciudad();

            },

            data(){

                return{


                    newnombre_completo:this.$auth.user().nombre_completo,
                    newtelefono:this.$auth.user().telefono,
                    newid_ciudad:this.$auth.user().id_ciudad,
                    newdireccion:this.$auth.user().direccion,
                    newemail:this.$auth.user().email,
                    newrole:this.$auth.user().id_role,
                    newpassword:'',
                    fotoMiniatura : 'fotos/'+this.$auth.user().foto,
                    arraydocumentos:[],
                    arrayciudades:[],
                    Configuracions:[],
                    loading: true,
                    fillconfiguracion:{'logoMiniatura':'','nit':'','nombre':'','telefono':'','direccion':'','email':'','comision_lente': '',  'comision_montura': ''},
                    Validar_Configuracion: 0,
                    editlogo: '',
                    logoMiniatura : '',
                    editlogoMiniatura : '',
                    newnit_optica:'',
                    newnombre_optica:'',
                    newtelefono_optica:'',
                    newdireccion_optica:'',
                    newemail_optica:'',
                    newcomision_lente:'',
                    newcomision_montura:'',
                    newiva_optica:''


            }

            },

            computed: {

                mostrarlogo(){
                    return this.logoMiniatura;
                },

                edit_logo(){
                    return this.editlogoMiniatura;
                },

                mostrarfoto(){
                    return this.fotoMiniatura;
                },


            },

            methods:{

            obtenerLogo(e){
                let file = e.target.files[0];
                this.logo = file;

                this.cargarLogo(file);
            },

            cargarLogo(file){
                let reader = new FileReader();

                reader.onload = (e) => {
                    this.logoMiniatura = e.target.result;

                }
                reader.readAsDataURL(file);

            },


            obtenereditLogo(e){
                let file = e.target.files[0];
                this.edit_logo = file;

                this.cargareditLogo(file);
            },

            cargareditLogo(file){
                let reader = new FileReader();

                reader.onload = (e) => {
                    this.editlogoMiniatura = e.target.result;

                }
                reader.readAsDataURL(file);

            },

                obtenerFoto(e){
                let file = e.target.files[0];
                this.foto = file;

                this.cargarImagen(file);
            },



            cargarImagen(file){
                let reader = new FileReader();

                reader.onload = (e) => {
                    this.fotoMiniatura = e.target.result;
                }
                reader.readAsDataURL(file);
                this.foto = file.name;
                console.log(file.name);

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

          select_tipo_documento(){
                this.$http({
                url: 'auth/documentos',
                method: 'GET'
                })
                .then((response) => {
                    this.arraydocumentos = response.data.documentos;

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

            validar_configuracion(){
                this.$http({
                url: 'auth/validar-configuracion',
                method: 'GET'
                })
                .then((response) => {
                    this.Validar_Configuracion = response.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

            listar_configuracion(){
                let me = this;
                this.$http({
                url: 'auth/listar-configuracion',
                method: 'GET'
                })
                .then((response) => {
                    this.Configuracions = response.data;
                    this.editlogoMiniatura ='logos/'+ this.Configuracions[0]['logo'];
                    this.editlogo = this.Configuracions[0]['logo'];
                    //this.loading = false;


                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },


         createConfiguracion(){

            this.$swal({
                title: 'Cargando!',
                text: 'Espere un momento por favor..',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showCancelButton: false,
                showConfirmButton: false,
                imageUrl: "images/spinner.gif",
                onOpen: () => {
                    swal.showLoading()
                }
            });


                this.$http({
                url: 'auth/comisiones',
                method: 'POST',
                data: {

                logo: this.logoMiniatura,
                nit : this.newnit_optica,
                nombre : this.newnombre_optica,
                telefono : this.newtelefono_optica,
                direccion : this.newdireccion_optica,
                email : this.newemail_optica,
                comision_lente : this.newcomision_lente,
                comision_montura : this.newcomision_montura,
                iva : this.newiva_optica

                }

             }).then(response => {

                 this.$swal(
                    'Creado',
                    'Comisiones creadas con éxito.',
                    'success'
                )
                this.listar_configuracion();
                 this.Validar_Configuracion();


                 this.errors = [];


             }).catch(error =>{
                 this.errors = error.response.data
             });

        },

        editConfiguracion(configuracion){

                this.fillconfiguracion.id = configuracion.id;
                this.fillconfiguracion.nit = configuracion.nit;
                this.fillconfiguracion.nombre = configuracion.nombre;
                this.fillconfiguracion.telefono = configuracion.telefono;
                this.fillconfiguracion.direccion = configuracion.direccion;
                this.fillconfiguracion.email = configuracion.email;
                this.fillconfiguracion.comision_lente = configuracion.comision_lente;
                this.fillconfiguracion.comision_montura = configuracion.comision_montura;
                this.fillconfiguracion.iva = configuracion.iva;

                $('#edit').modal('show');
            },

        updateConfiguracion(id){

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

                var logo_real;
                var logo_nombre = this.editlogoMiniatura.split('/');

                if(logo_nombre[1] == this.editlogo){
                    this.logo_real=''

                }else{
                    this.logo_real = this.editlogoMiniatura
                }

                this.$http({
                url: 'auth/comisiones/' + id,
                method: 'PUT',
                data: {

                logo: this.logo_real,
                nit : this.fillconfiguracion.nit,
                nombre : this.fillconfiguracion.nombre,
                telefono : this.fillconfiguracion.telefono,
                direccion : this.fillconfiguracion.direccion,
                email : this.fillconfiguracion.email,
                comision_lente : this.fillconfiguracion.comision_lente,
                comision_montura : this.fillconfiguracion.comision_montura,
                iva : this.fillconfiguracion.iva,

                }
                })
                .then(response => {
                    this.listar_configuracion();
                    this.fillconfiguracion = {'logoMiniatura':'','nit':'','nombre':'','telefono':'','direccion':'','email':'','comision_lente': '',  'comision_montura': ''};
                    this.errors = [];

                    $('#edit').modal('hide');
                    if ($('.modal-backdrop').is(':visible')) {
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                };
                     this.$swal(
                    'Actualizado',
                    'Configuración actualizada con éxito.',
                    'success'
                )
                }).catch(error =>{
                    this.errors = error.response.data
                });
            },

          updateUsuario(){


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

                var foto_real;
                var foto_nombre = this.fotoMiniatura.split('/');

                if(foto_nombre[1] == this.$auth.user().foto){
                    this.foto_real=''

                }else{
                    this.foto_real = this.fotoMiniatura
                }

                this.$http({
                url: 'auth/usuarios/' + this.$auth.user().id,
                method: 'PUT',
                data: {

                    nombre_completo : this.newnombre_completo,
                    telefono : this.newtelefono,
                    direccion : this.newdireccion,
                    id_ciudad : this.newid_ciudad,
                    id_estado: 1,
                    password : this.newpassword,
                    email : this.newemail,
                    foto: this.foto_real,
                    id_role: this.newrole

                    //password : this.fillclientes.password
                }
                }).then(response => {

                    this.errors = [];

                     this.$swal(
                    'Actualizado',
                    'Información actualizada, ya puedes comenzar a realizar pedidos',
                    'success'

                )

                const redirectTo = 'cliente_negocios'
                this.$router.push({name: redirectTo})


                }).catch(error =>{
                    this.errors = errors.response.data
                });
            },

            }
        }



</script>
