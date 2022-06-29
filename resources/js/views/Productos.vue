<template>

    <div>

        <div class="content-wrapper">

            <div class="row">

            <div class=" col-md-12 ">
				<div class="media align-items-center bg-white mb-20">
				  <span class="avatar  bg-primary"><i class="fa fa-cart-plus"></i></span>
				  <div class="media-body">
					<h3><strong>Aquí gestionas tus productos ve!</strong></h3>
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
						  <th scope="col">Foto</th>
                          <th scope="col">Negocio</th>
						  <th scope="col">Código</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Valor</th>
                        <th scope="col">En Stock</th>
                        <th scope="col">Acción</th>
						</tr>
					  </thead>
					  <tbody >

						<tr v-for="producto in Productos" v-bind:key="producto.id">
                            <td><center><img :src="'fotos-productos/'+ producto.foto" class="avatar avatar-xl avatar-bordered" height="70" width="70"></center></td>
                            <td class="td-style">{{producto.nombre_negocio}}</td>
                            <td class="td-style">{{producto.codigo}}</td>
                            <td class="td-style">{{producto.nombre}}</td>
                            <td class="td-style">{{producto.descripcion}}</td>
                            <td class="td-style">{{producto.nombre_categoria}}</td>
                            <td class="td-style">{{producto.valor | format-thousands}}</td>
                            <td class="td-style">{{producto.stock}}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-rounded" data-toggle="modal tooltip" data-placement="top" title="Editar" v-on:click.prevent="editProductos(producto)">
                                    <i class="fa fa-edit"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-rounded" data-toggle="modal tooltip" data-placement="top" title="Eliminar" v-on:click.prevent="deleteProductos(producto)">
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

    <form  method="POST" v-on:submit.prevent="createProductos">
        <!-- Modal -->
				<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" id="create">
				  <div class="modal-dialog modal-lg">
					<div class="modal-content">

					  <div class="modal-header bg-mo">
						<h5 class="modal-title">Crea un Nuevo Producto ve!</h5>
						<button type="button" class="close" data-dismiss="modal">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
<div class="col s12" >
        <div class="row">

            <div class="box card-inverse bg-img" style="background-image: url(images/fondo-productos.jpg); padding-top: 100px">

              <div class="flexbox align-items-center px-20" data-overlay="4">
                <div class="flexbox align-items-center mr-auto">
                  <a >
                    <img class="avatar avatar-xl avatar-bordered" :src="fotoMiniatura" alt="foto">
                  </a>
                  <div class="pl-10 d-none d-md-block">

                  </div>
                </div>

                <ul class="flexbox flex-justified text-center py-20">

                  <li class="pl-10">
                    <label for="file-upload" class="subir">
                        Sube una foto del Producto
                    <i class="fa fa-camera" style="width:50px;"></i>
                    </label>
                    <input id="file-upload" type="file"  @change="obtenerFoto" name="foto" class="form-control-file" style='display: none;'>
                  </li>
                </ul>

              </div>
            </div>

          <div class="col-md-3">
					  <label for="nombre">Código del Producto</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-key"></i></span>
						  </div>
						   <input id="codigo" type="text" class="form-control" v-model="newcodigo" >
						</div>

          </div>

					<div class="col-md-4">
                        <validation-provider rules="required" v-slot="{ errors }">
                      <label for="nombre">Nombre del Producto</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
						  </div>
						   <input id="descripcion" type="text" class="form-control" v-model="newnombre" required>
						</div>
                        <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
						</div>


					<div class="col-md-5">
                        <validation-provider rules="required" v-slot="{ errors }">
             <label for="descripcion">Descripción del Producto</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-bars"></i></span>
						  </div>
						   <textarea id="descripcion1" rows="2" type="text" class="form-control" v-model="newdescripcion" required></textarea>
						</div>
                        <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>

				</div>
</div>
<br>
        <div class="row">
            <div class="col-md-3">

					  <label for="cantidad">Stock del Producto</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-mail-forward"></i></span>
						  </div>
						   <input id="stock" type="number" class="form-control" v-model="newstock">
						</div>
                 <span style="color:red">{{ errors[0] }}</span>

          </div>

 <div class="col-md-4">
     <validation-provider rules="required" v-slot="{ errors }">
					  <label for="valor">Valor del Producto</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-dollar"></i></span>
						  </div>
						   <input id="valor" type="number" class="form-control" v-model="newvalor" required>
						</div>
                        <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
          </div>

          <div class="col-md-5">
              <validation-provider rules="required" v-slot="{ errors }">
            <label for="categoria">Categoría del Producto</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-shopping-basket"></i></span>
						  </div>
						   <select class="custom-select" v-model="newid_categoria" required>
                <option value="0" disabled>Seleccione</option>
                <option v-for="categoria in arraycategorias" :key="categoria.id" :value="categoria.id" >{{categoria.nombre}}</option>
              </select>
					</div>
                    <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
        </div>


        </div>

        <br>



        <br>


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

    <form  method="POST" v-on:submit.prevent="updateproductos(fillproductos.id)">
        <!-- Modal -->
								<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" id="edit">
				  <div class="modal-dialog modal-lg">
					<div class="modal-content">

					  <div class="modal-header bg-mo">
						<h5 class="modal-title">Actualiza Tu Producto ve!</h5>
						<button type="button" class="close" data-dismiss="modal">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
<div class="col s12" >
<div class="row">

        <div class="box card-inverse bg-img" style="background-image: url(images/fondo-productos.jpg); padding-top: 100px">

              <div class="flexbox align-items-center px-20" data-overlay="4">
                <div class="flexbox align-items-center mr-auto">
                  <a  >
                    <img class="avatar avatar-xl avatar-bordered" :src="fotoMiniatura" alt="foto">
                  </a>
                  <div class="pl-10 d-none d-md-block">

                  </div>
                </div>



              </div>
            </div>

          <div class="col-md-3">
              <validation-provider rules="required" v-slot="{ errors }">
					  <label for="codigo2">Código del Producto</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-key"></i></span>
						  </div>
						   <input id="codigo2" type="text" class="form-control" v-model="fillproductos.codigo" required>
						</div>
                <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
          </div>

					<div class="col-md-4">
                        <validation-provider rules="required" v-slot="{ errors }">
                      <label for="nombre2">Nombre del Producto</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
						  </div>
						   <input id="nombre2" type="text" class="form-control" v-model="fillproductos.nombre" required>
						</div>
                        <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
						</div>


					<div class="col-md-5">
                        <validation-provider rules="required" v-slot="{ errors }">
             <label for="descripcion2">Descripción del Producto</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-bars"></i></span>
						  </div>
						   <textarea id="descripcion2" rows="2" type="text" class="form-control" v-model="fillproductos.descripcion" required></textarea>
						</div>
                    <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
				</div>
</div>
<br>

        <div class="row">

          <div class="col-md-4">
              <validation-provider rules="required" v-slot="{ errors }">
            <label for="categoria2">Categoría del Producto</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-shopping-basket"></i></span>
						  </div>
						   <select class="custom-select" v-model="fillproductos.id_categoria" required>
                <option value="0" disabled>Seleccione</option>
                <option v-for="categoria in arraycategorias" :key="categoria.id" :value="categoria.id"  >{{categoria.nombre}}</option>
              </select>
					</div>
                <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
        </div>
 <div class="col-md-3">
        <validation-provider rules="required" v-slot="{ errors }">
					  <label for="valor">Valor del Producto</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-dollar"></i></span>
						  </div>
						   <input id="valor" type="number" class="form-control" v-model="fillproductos.valor" required>
						</div>
                   <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
          </div>



          <div class="col-md-3">

					  <label for="cantidad">Stock del Producto</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-mail-forward"></i></span>
						  </div>
						   <input id="stock" type="number" class="form-control" v-model="fillproductos.stock">
						</div>
          </div>
        </div>
        <br>


                  </div>

					  </div>


					  <div class="modal-footer modal-footer-uniform">
						<button type="button" class="btn btn-bold btn-pure btn-secondary btn-rounded" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-bold btn-pure btn-success float-right btn-rounded">Actualizar</button>
					  </div>
					</div>
				  </div>
				</div>
    </form>

    </div>

</template>

<script>

    import { ValidationProvider, extend } from 'vee-validate';
    import { required, email } from 'vee-validate/dist/rules';
    import { numeric } from 'vee-validate/dist/rules';

    import LayoutDefault from '../components/layouts/Principal.vue';


    export default{

        created: function(){

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

            this.getProductos();
            this.select_categoria();
            this.select_negocios();
            this.$emit('update:layout', LayoutDefault);
        },

        data(){

            return{
            fotoMiniatura:'',
            Productos: [],
            arraycategorias: [],
            arrayproveedores: [],
            arraynegocios: [],
            loading: true,
            newid_categoria:'',
            newid_negocio:'',
            newcodigo:'',
            newnombre:'',
            newdescripcion:'',
            newvalor:'',
            newstock:'',
            errors: [],
            fillproductos:{'id': '','id_categoria': '','codigo': '', 'nombre': '', 'descripcion':'', 'valor': '', 'stock': ''},
            timer: ''

            }
        },



        methods:{

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

            select_categoria(){

                let me = this;
                this.$http({
                url: 'auth/select_categoria',
                method: 'GET'
                })
                .then((response) => {
                    me.arraycategorias = response.data.categorias;

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
             select_negocios(){

               let me = this;
            this.$http({
                url: "auth/negocios",
                method: "GET"
            })
                .then(response => {
                    me.arraynegocios = response.data;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
            },

            select_proveedor(){

                let me = this;
                this.$http({
                url: 'auth/select_proveedor',
                method: 'GET'
                })
                .then((response) => {
                    me.arrayproveedores = response.data.proveedores;

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
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


            getProductos(){

                let me = this;
                this.$http({
                url: 'auth/productos',
                method: 'GET',
                })
                .then((response) => {
                    me.Productos = response.data;
                    me.mytable();
                    me.loading = false

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },



            editProductos(producto){

                this.fillproductos.id = producto.id;
                this.fillproductos.codigo = producto.codigo;
                this.fillproductos.nombre = producto.nombre;
                this.fillproductos.id_categoria = producto.id_categoria;
                this.fillproductos.descripcion = producto.descripcion;
                this.fillproductos.valor = producto.valor;
                this.fillproductos.stock = producto.stock;
                this.fillproductos.fotoMiniatura = producto.foto;


                $('#edit').modal('show');
            },

             updateproductos(id){

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
                url: 'auth/productos/' + id,
                method: 'PUT',
                data: {
                    id_categoria : this.fillproductos.id_categoria,
                    nombre : this.fillproductos.nombre,
                    codigo : this.fillproductos.codigo,
                    descripcion : this.fillproductos.descripcion,
                    valor : this.fillproductos.valor,
                    stock : this.fillproductos.stock,

                }

                }).then(response => {
                    this.getProductos();
                    this.errors = [];

                    $('#edit').modal('hide');
                    if ($('.modal-backdrop').is(':visible')) {
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                };
                     this.$swal(
                    'Actualizado',
                    'Producto actualizado con éxito.',
                    'success'
                )
                 }).catch(function (error) {
                    console.log(error);
                });
            },


            createProductos(){

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
                url: 'auth/productos',
                method: 'POST',
                data: {

                 id_categoria : this.newid_categoria,
                 nombre : this.newnombre,
                 codigo : this.newcodigo,
                 descripcion : this.newdescripcion,
                 valor : this.newvalor,
                 stock : this.newstock,
                 foto: this.fotoMiniatura,
                 newid_negocio: this.newid_negocio,



                }

             }).then(response => {

                 this.getProductos();

                 this.newid_categoria = '';
                 this.newnombre = '';
                 this.newcodigo = '';
                 this.newdescripcion = '';
                 this.newvalor = '';
                 this.newstock= '';
                 this.fotoMiniatura = '';


                 this.errors = [];
                $('#create').modal('hide');
                if ($('.modal-backdrop').is(':visible')) {
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                };

                this.$swal(
                    'Creado',
                    'Producto creado con éxito.',
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

        deleteProductos(producto){

                this.$swal({
                title: 'Está seguro de Eliminar este Producto?',
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
                url: 'auth/productos/' + producto.id,
                method: 'DELETE',
                })
                .then(response => {
                    this.getProductos();
                    this.$swal(
                        'Eliminado!',
                        'El Producto ha sido Eliminado con éxito.',
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

            changePage: function() {

			this.getProductos();
		},


        },

        components: {
        ValidationProvider
    },



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

#scrol{
  overflow:scroll;
  height: 30px !important;
}



</style>
