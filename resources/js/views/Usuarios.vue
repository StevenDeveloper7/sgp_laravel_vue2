<template>

    <div>

        <div class="content-wrapper">

            <div class="row">

            <div class=" col-md-12 ">
				<div class="media align-items-center bg-white mb-20">
				  <span class="avatar  bg-primary"><i class="fa fa-users"></i></span>
				  <div class="media-body">
					<h3><strong>Aquí gestionas tus colaboradores ve!</strong></h3>
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
              <button type="button" class="btn btn-success btn-rounded" data-toggle="modal" data-target="#create">
                <i class="fa fa-plus"></i>&nbsp;Nuevo
              </button>
                </div>
        <div class="col-md-2">


      </div>


              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive">
				  <table class="table mb-0" id="example">
					  <thead class="bg-mo">
						<tr>
                          <th></th>
						  <th scope="col">Tipo Documento</th>
                          <th scope="col">Número Documento</th>
                          <th scope="col">Nombre Completo</th>
                          <th scope="col">Teléfono</th>
                          <th scope="col">Dirección</th>
                          <th scope="col">Email</th>
                          <th scope="col">Cargo</th>
                          <th scope="col">Acción</th>
						</tr>
					  </thead>
					  <tbody>
						<tr v-for="usuario in Usuarios" v-bind:key="usuario.id">
                            <td><center><img :src="'fotos/'+ usuario.foto" class="avatar avatar-xl avatar-bordered" height="70" width="70"></center></td>
                            <td class="td-style">{{usuario.tipo_documento}}</td>
                            <td class="td-style">{{usuario.numero_documento}}</td>
                            <td class="td-style">{{usuario.nombre_completo}}</td>
                            <td class="td-style" v-if="usuario.telefono == null">N/A</td>
                            <td class="td-style" v-else>{{usuario.telefono}}</td>
                            <td class="td-style" v-if="usuario.direccion == null">N/A</td>
                            <td class="td-style" v-else>{{usuario.direccion}}</td>
                            <td class="td-style">{{usuario.email}}</td>
                            <td class="td-style">{{usuario.nombre_role}}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-rounded" data-toggle="modal tooltip" data-placement="top" title="Editar" v-on:click.prevent="editUsuarios(usuario)">
                                    <i class="fa fa-edit"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-rounded" data-toggle="modal tooltip" data-placement="top" title="Eliminar" v-on:click.prevent="deleteUsuarios(usuario)">
                                    <i class="fa fa-trash"></i>
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

    <form  method="POST" v-on:submit.prevent="createUsuarios">
        <!-- Modal -->
				<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" id="create">
				  <div class="modal-dialog modal-lg">
					<div class="modal-content">

					  <div class="modal-header bg-mo">
						<h5 class="modal-title">Crea un Nuevo Usuario ve!</h5>
						<button type="button" class="close" data-dismiss="modal">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
				<div class="row">

            <div class="col s12">


                <div class="box card-inverse bg-img" style="background-image: url(images/fondo-vendedores.jpg); padding-top: 100px">

              <div class="flexbox align-items-center px-20" data-overlay="4">
                <div class="flexbox align-items-center mr-auto">
                  <a  >
                    <img class="avatar avatar-xl avatar-bordered" :src="fotoMiniatura" alt="foto">
                  </a>
                  <div class="pl-10 d-none d-md-block">

                  </div>
                </div>

                <ul class="flexbox flex-justified text-center py-20">

                  <li class="pl-10">
                    <label for="file-upload" class="subir">
                        Sube una foto del Usuario
                    <i class="fa fa-camera" style="width:50px;"></i>
                    </label>
                    <input id="file-upload" type="file" @change="obtenerFoto" name="foto" class="form-control-file" style='display: none;'>
                  </li>
                </ul>

              </div>
            </div>

                <div class="form-group row">
        			<div class="col-md-4">

                        <label for="tipo_documento">Tipo Documento</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-id-card"></i></span>
						  </div>
						   <select class="custom-select" v-model="newid_tipo" required>
                            <option value="0" disabled>Seleccione</option>
                            <option v-for="documento in arraydocumentos" :key="documento.id" :value="documento.id" >{{documento.nombre}}</option>
                            </select>
						</div>
						<!-- /.input group -->

					</div>
					<div class="col-md-4">
                      <label for="documento">Número Documento</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-id-card"></i></span>
						  </div>
						   <input id="documento" type="number" class="form-control" v-model="newnumero_documento" min="1" required pattern="[0-9]+" title="Ingrese sólo Números">
						</div>
						<!-- /.input group -->
				  	</div>
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
				</div>

          <div class="form-group row">

            <div class="col-md-4">
					 <label for="telefono">Teléfono</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-phone"></i></span>
						  </div>
						   <input id="telefono" type="number" class="form-control" v-model="newtelefono" min="1" required pattern="[0-9]+" title="Ingrese sólo Números">
						</div>
						<!-- /.input group -->
				  	</div>

            <div class="col-md-4">
					  <label for="direccion">Dirección</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-map-marker"></i></span>
						  </div>
						   <input id="direccion" type="text" class="form-control" v-model="newdireccion" required>
						</div>
						<!-- /.input group -->
				  	</div>

            <div class="col-md-4">
					   <label for="email">Email</label>
						  <div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-at"></i></span>
						  </div>
						   <input id="email" type="text" class="form-control" v-model="newemail" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}">
						</div>
						<!-- /.input group -->
				  	</div>
            </div>

        <div class="form-group row">
        		<div class="col-md-4">
              <label for="tipo_documento">Cargo</label>
						  <div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
						  </div>
						   <select class="custom-select" v-model="newrole" required>
                  <option value="0" disabled>Seleccione</option>
                  <option v-for="role in arrayroles" :key="role.id" :value="role.id" >{{role.nombre}}</option>
              </select>
						</div>
						<!-- /.input group -->
			    	</div>
             <div class="col-md-4">
					   <label for="password">Contraseña</label>
						  <div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-key"></i></span>
						  </div>
						   <input id="password1" type="password" class="form-control" v-model="newpassword" required>
						</div>
						<!-- /.input group -->
				  	</div>

            </div>
              </div>
              </div>

					  </div>

					  <div class="modal-footer modal-footer-uniform">
						<button type="button" class="btn btn-bold btn-pure btn-secondary btn-rounded" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-bold btn-pure btn-success float-right btn-rounded">Guardar</button>
					  </div>
					</div>
				  </div>
				</div>
			  <!-- /.modal -->
    </form>

    <form  method="POST" v-on:submit.prevent="updateUsuarios(fillusuarios.id)">
        <!-- Modal -->
				<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" id="edit">
				  <div class="modal-dialog modal-lg">
					<div class="modal-content">

					  <div class="modal-header bg-mo">
						<h5 class="modal-title">Actualiza Tu Usuario ve!</h5>
						<button type="button" class="close" data-dismiss="modal">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
				<div class="row">

            <div class="col s12" >

                 <div class="box card-inverse bg-img" style="background-image: url(images/fondo-vendedores.jpg); padding-top: 100px">

              <div class="flexbox align-items-center px-20" data-overlay="4">
                <div class="flexbox align-items-center mr-auto">
                  <a  >
                    <img class="avatar avatar-xl avatar-bordered" :src="'fotos/'+ fillusuarios.fotoMiniatura" alt="foto">
                  </a>
                  <div class="pl-10 d-none d-md-block">

                  </div>
                </div>

              </div>
            </div>


                <div class="form-group row">
        			<div class="col-md-4">

                        <label for="tipo_documento">Tipo Documento</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-id-card"></i></span>
						  </div>
						   <select class="custom-select" v-model="fillusuarios.id_tipo_documento" required>
                            <option value="0" disabled>Seleccione</option>
                            <option v-for="documento in arraydocumentos" :key="documento.id" :value="documento.id" >{{documento.nombre}}</option>
                            </select>
						</div>
						<!-- /.input group -->

					</div>
					<div class="col-md-4">
                      <label for="documento">Número Documento</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-id-card"></i></span>
						  </div>
						   <input  type="number" class="form-control" v-model="fillusuarios.numero_documento" min="1" required pattern="[0-9]+" title="Ingrese sólo Números">
						</div>
						<!-- /.input group -->
				  	</div>
                     <div class="col-md-4">
					  <label for="nombre">Nombre Completo</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
						  </div>
						   <input  type="text" class="form-control" v-model="fillusuarios.nombre_completo" required pattern="[A-Z a-z\sáéíóú]+" title="Ingrese sólo Letras">

						</div>
						<!-- /.input group -->
				  	</div>
				</div>

        <div class="form-group row">
          <div class="col-md-4">
					 <label for="telefono">Teléfono</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-phone"></i></span>
						  </div>
						   <input  type="number" class="form-control" v-model="fillusuarios.telefono" min="1" required pattern="[0-9]+" title="Ingrese sólo Números">
						</div>
						<!-- /.input group -->
				  	</div>

            <div class="col-md-4">
					  <label for="direccion">Dirección</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-map-marker"></i></span>
						  </div>
						   <input  type="text" class="form-control" v-model="fillusuarios.direccion" required>
						</div>
						<!-- /.input group -->
				  	</div>

                     <div class="col-md-4">
					  <label for="email">Email</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-at"></i></span>
						  </div>
						   <input  type="text" class="form-control" v-model="fillusuarios.email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}">
						</div>
						<!-- /.input group -->
				  	</div>
            </div>

        <div class="form-group row">
        		<div class="col-md-4">
              <label for="tipo_documento">Cargo</label>
						  <div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
						  </div>
						   <select class="custom-select" v-model="fillusuarios.id_role" required>
                            <option value="0" disabled>Seleccione</option>
                            <option v-for="role in arrayroles" :key="role.id" :value="role.id" >{{role.nombre}}</option>
                            </select>
						</div>
						<!-- /.input group -->

				</div>
            <div class="col-md-4">
					   <label for="password">Contraseña</label>
						  <div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-key"></i></span>
						  </div>
						   <input id="password" type="password" class="form-control" v-model="fillusuarios.password" >
						</div>
						<!-- /.input group -->
				  	</div>

            </div>

              </div>
              </div>

					  </div>

					  <div class="modal-footer modal-footer-uniform">
						<button type="button" class="btn btn-bold btn-pure btn-secondary btn-rounded" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-bold btn-pure btn-success float-right btn-rounded">Actualizar</button>
					  </div>
					</div>
				  </div>
				</div>
			  <!-- /.modal -->
    </form>

    </div>

</template>

<script>

    import LayoutDefault from '../components/layouts/Principal.vue';

    export default{

        created: function(){

        this.getUsuarios();
        this.select_tipo_documento();
        this.select_role();

        this.$emit('update:layout', LayoutDefault);

    },

        data(){

            return{
            fotoMiniatura:'',
            imagen:'',
            Usuarios: [],
            arraydocumentos: [],
            arrayroles: [],
            loading: true,
            newid_tipo:'',
            newrole:'',
            newnumero_documento:'',
            newnombre_completo:'',
            newtelefono:'',
            newdireccion:'',
            newemail:'',
            newusername:'',
            newpassword:'',
            errors: [],
            fillusuarios:{'id': '', 'numero_documento': '', 'nombres_completo': '', 'telefono': '', 'direccion': '','email': '','id_tipo_documento':'','id_role':'','password':''},

            }
        },



        methods:{

            select_tipo_documento(){

                let me = this;
                this.$http({
                url: 'auth/documentos',
                method: 'GET'
                })
                .then((response) => {
                    me.arraydocumentos = response.data.documentos;

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },


            select_role(){

                let me = this;
                this.$http({
                url: 'auth/roles',
                method: 'GET'
                }).then(function (response) {
                    me.arrayroles = response.data.roles;

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

            obtenerFoto(e){
                let file = e.target.files[0];
                this.imagen = file;

                this.cargarImagen(file);
            },

            cargarImagen(file){
                let reader = new FileReader();

                reader.onload = (e) => {
                    this.fotoMiniatura = e.target.result;

                }
                reader.readAsDataURL(file);

            },

            mytable(){
                setTimeout(function(){
                    if(!$.fn.DataTable.isDataTable('#example')){
                        $('#example').DataTable({
                        bFilter: true,
                        bInfo: false,
                        scrollX: false,
                        scrollCollapse: false,
                        paging: true,
                        pageLength: 10,
                        fixedColumns: true,
                        language: {
                            "lengthMenu": "Mostrar _MENU_ Registros por pagina",
                            "zeroRecords": "No se encuentran acronimos - lo sentimos",
                            "info": "Mostrando la p&aacute;gina _PAGE_ de _PAGES_",
                            "infoEmpty": "No hay registros disponibles",
                            "infoFiltered": "(Filtrado de _MAX_ Total de registros)",
                            "search": "Búscar",
                            "paginate": {
                                "first": "Primero",
                                "last": "Ãšltimo",
                                "next": "Siguiente",
                                "previous": "Anterior"
                            }
                        }
                    });
                    }

                },800);
            },

            getUsuarios(){

                let me = this;
                this.$http({
                url: 'auth/usuarios',
                method: 'GET'
                }).then(function (response) {
                    me.Usuarios = response.data,
                    me.mytable();
                    me.loading = false
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

            editUsuarios(usuario){

                this.fillusuarios.id = usuario.id;
                this.fillusuarios.numero_documento = usuario.numero_documento;
                this.fillusuarios.id_tipo_documento = usuario.id_tipo_documento;
                this.fillusuarios.nombre_completo = usuario.nombre_completo;
                this.fillusuarios.telefono = usuario.telefono;
                this.fillusuarios.direccion = usuario.direccion;
                this.fillusuarios.email = usuario.email;
                this.fillusuarios.id_role = usuario.id_role;
                this.fillusuarios.id_estado = usuario.id_estado;
                this.fillusuarios.fotoMiniatura = usuario.foto;
                this.fillusuarios.password = '';
               // this.fillusuarios.estado = usuario.estado;

                $('#edit').modal('show');
            },

             updateUsuarios(id){

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


                let me = this;
                this.$http({
                url: 'auth/usuarios/' + id,
                method: 'PUT',
                data: {

                    id_tipo_documento : this.fillusuarios.id_tipo_documento,
                    numero_documento : this.fillusuarios.numero_documento,
                    nombre_completo : this.fillusuarios.nombre_completo,
                    telefono : this.fillusuarios.telefono,
                    direccion : this.fillusuarios.direccion,
                    email : this.fillusuarios.email,
                    id_role: this.fillusuarios.id_role,
                    id_estado: this.fillusuarios.id_estado,
                    password: this.fillusuarios.password,
                    //foto: this.fillusuarios.fotoMiniatura,
                }

                }).then(response => {
                    this.getUsuarios();
                    this.errors = [];

                    $('#edit').modal('hide');
                    if ($('.modal-backdrop').is(':visible')) {
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                };
                     this.$swal(
                    'Actualizado',
                    'usuario actualizado con éxito.',
                    'success'
                )
                }).catch(error =>{
                    this.errors = errors.response.data
                });
            },


            createUsuarios(){

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
                url: 'auth/usuarios',
                method: 'POST',
                data: {

                 id_tipo_documento : this.newid_tipo,
                 numero_documento : this.newnumero_documento,
                 nombre_completo : this.newnombre_completo,
                 telefono : this.newtelefono,
                 direccion : this.newdireccion,
                 email : this.newemail,
                 id_role : this.newrole,
                 password : this.newpassword,
                 id_estado: 1,
                 foto: this.fotoMiniatura,

                 }

             }).then(response => {

                 console.log(response);
                 this.getUsuarios();

                 this.newid_tipo = '';
                 this.newnumero_documento = '';
                 this.newapellidos = '';
                 this.newnombre_completo = '';
                 this.newtelefono = '';
                 this.newbarrio = '';
                 this.newdireccion = '';
                 this.newemail = '';
                 this.newrole = '';
                 this.newpassword = '';
                 this.fotoMiniatura = '';

                 this.errors = [];
                $('#create').modal('hide');
                if ($('.modal-backdrop').is(':visible')) {
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                };

                this.$swal(
                    'Creado',
                    'usuario creado con éxito.',
                    'success'
                )
             }).catch(error =>{
                 console.log(error.response.data.code);
                 //this.errors = 'error.response.data'
                if(error.response.data.code == 1){
                    this.$swal({
                    type: 'error',
                    title: 'El correo ingresado ya se encuentra registrado',
                    text: 'Por favor verifica los datos',
                    })
                }if(error.response.data.code == 3)
                    this.$swal({
                    type: 'error',
                    title: 'El documento ya se encuentra registrado',
                    text: 'Por favor verifica los datos',
                    })
             });

        },

        deleteUsuarios(usuario){

                this.$swal({
                title: 'Está seguro de Eliminar este Usuario?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#00BFF3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-info',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {


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
                url: 'auth/usuarios/' + usuario.id,
                method: 'DELETE',
                }).then(response => {
                    this.getUsuarios();
                    this.$swal(
                        'Eliminado!',
                        'El Usuario ha sido Eliminado con éxito.',
                        'success'
                        )
                })
                .catch(function (error) {
                    console.log(error);
                });
              } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {

                }
            })
        },



        }

    }


</script>


<style>

th,td{

    text-align: center;
}

.btn-warning{
    background-color: #ffc107;
    border-color: #ffc107;
}



</style>
