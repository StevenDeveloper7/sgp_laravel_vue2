<template>

    <div>

        <div class="content-wrapper">

            <div class="row">

            <div class=" col-md-12 ">
				<div class="media align-items-center bg-white mb-20">
				  <span class="avatar  bg-primary"><i class="fa fa-users"></i></span>
				  <div class="media-body">
					<h3><strong>Productos</strong></h3>
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
					  <thead class="bg-info">
						<tr>
						  <th scope="col">Codigo</th>
              <th scope="col">Nombre</th>
              <th scope="col">Descripcion</th>
              <th scope="col">Categoria</th>
              <th scope="col">valor_compra</th>
              <th scope="col">valor_venta</th>
              <th scope="col">cantidad</th>
              <th scope="col">Acción</th>
						</tr>
					  </thead>
					  <tbody >

						<tr v-for="producto in Productos" v-bind:key="producto.id">
                            <td class="td-style">{{producto.codigo}}</td>
                            <td class="td-style">{{producto.nombre}}</td>
                            <td class="td-style">{{producto.descripcion}}</td>
                            <td class="td-style">{{producto.nombre_categoria}}</td>
                            <td class="td-style">{{producto.valor_compra}}</td>
                            <td class="td-style">{{producto.valor_venta}}</td>
                            <td class="td-style">{{producto.cantidad}}</td>
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

					  <div class="modal-header bg-info">
						<h5 class="modal-title">Nuevo Producto</h5>
						<button type="button" class="close" data-dismiss="modal">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
			<div class="modal-body">
				<div class="row">

          <div class="col-md-3">
					  <label for="nombre">Codigo</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
						  </div>
						   <input id="codigo" type="number" class="form-control" v-model="newcodigo">
						</div>
          </div>

					<div class="col-md-4">
                      <label for="nombre">Nombre</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
						  </div>
						   <input id="nombre" type="text" class="form-control" v-model="newnombre">
						</div>
					<div class="col-md-5">
             <label for="descripcion">Descripcion</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-id-card"></i></span>
						  </div>
						   <input id="nombre" type="text" class="form-control" v-model="newdescripcion">
						</div>

				</div>

        <div class="form-group row">

        	<div class="col-md-3">

              <label for="categoria">Categoria</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-id-card"></i></span>
						  </div>
						   <select class="custom-select" v-model="newid_categoria" required>
                <option value="0" disabled>Seleccione</option>
                <option v-for="categoria in arraycategorias" :key="categoria.id" :value="categoria.id" >{{categoria.nombre}}</option>
              </select>
					</div>

          <div class="col-md-3">
					  <label for="valor_compra">Valor de Compra</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
						  </div>
						   <input id="codigo" type="number" class="form-control" v-model="newvalor_compra">
						</div>
          </div>

          <div class="col-md-3">
					  <label for="valor_venta">Valor de Venta</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
						  </div>
						   <input id="codigo" type="number" class="form-control" v-model="newvalor_venta">
						</div>
          </div>

          <div class="col-md-3">
					  <label for="cantidad">Cantidad</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
						  </div>
						   <input id="codigo" type="number" class="form-control" v-model="newcantidad">
						</div>
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

    <form  method="POST" v-on:submit.prevent="updateProductos(fillproductos.id)">
        <!-- Modal -->
				<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" id="edit">
				  <div class="modal-dialog modal-lg">
					<div class="modal-content">

					  <div class="modal-header bg-info">
						<h5 class="modal-title">Editar Producto</h5>
						<button type="button" class="close" data-dismiss="modal">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
				<div class="row">

          <div class="col-md-3">
					  <label for="nombre">Codigo</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
						  </div>
						   <input id="codigo" type="number" class="form-control" v-model="fillproductos.codigo">
						</div>
          </div>

					<div class="col-md-4">
                      <label for="nombre">Nombre</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
						  </div>
						   <input id="nombre" type="text" class="form-control" v-model="fillproductos.nombre">
						</div>
					<div class="col-md-5">
             <label for="descripcion">Descripcion</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-id-card"></i></span>
						  </div>
						   <input id="nombre" type="text" class="form-control" v-model="fillproductos.descripcion">
						</div>

				</div>
            </div>
        <div class="form-group row">

        	<div class="col-md-3">

              <label for="categoria">Categoria</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-id-card"></i></span>
						  </div>
						   <select class="custom-select" v-model="fillproductos.id_categoria" required>
                <option value="0" disabled>Seleccione</option>
                <option v-for="categoria in arraycategorias" :key="categoria.id" :value="categoria.id" >{{categoria.nombre}}</option>
              </select>
					</div>
                    </div>

          <div class="col-md-3">
					  <label for="valor_compra">Valor de Compra</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
						  </div>
						   <input id="codigo" type="number" class="form-control" v-model="fillproductos.valor_compra">
						</div>
          </div>

          <div class="col-md-3">
					  <label for="valor_venta">Valor de Venta</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
						  </div>
						   <input id="codigo" type="number" class="form-control" v-model="fillproductos.valor_venta">
						</div>
          </div>

          <div class="col-md-3">
					  <label for="cantidad">Cantidad</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
						  </div>
						   <input id="codigo" type="number" class="form-control" v-model="fillproductos.cantidad">
						</div>
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
            this.getProductos();
            this.select_categoria();
            this.$emit('update:layout', LayoutDefault);
        },

        data(){

            return{

            Productos: [],
            arraycategorias: [],
            loading: true,
            newid_categoria:'',
            newcodigo:'',
            newnombre:'',
            newdescripcion:'',
            newvalor_compra:'',
            newvalor_venta:'',
            newcantidad:'',
            errors: [],
            fillproductos:{'id': '','codigo': '', 'nombre': '', 'nombres_completo': '', 'valor_compra': '', 'valor_venta': '','cantidad': '','id_categoria':''},
            timer: ''

            }
        },



        methods:{

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

                },500);
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
                this.fillproductos.valor_compra = producto.valor_compra;
                this.fillproductos.valor_venta = producto.valor_venta;
                this.fillproductos.cantidad = producto.cantidad;

                $('#edit').modal('show');
            },

             updateProductos(id){

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
                    valor_compra : this.fillproductos.valor_compra,
                    valor_venta : this.fillproductos.valor_venta,
                    cantidad : this.fillproductos.cantidad,

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

                 id_categoria_documento : this.newid_categoria,
                 nombre : this.newnombre,
                 codigo : this.newcodigo,
                 descripcion : this.newdescripcion,
                 valor_compra : this.newvalor_compra,
                 valor_venta : this.newvalor_venta,
                 cantidad : this.newcantidad,


                }

             }).then(response => {

                 this.getProductos();

                 this.newid_categoria = '';
                 this.newnombre = '';
                 this.newcodigo = '';
                 this.newdescripcion = '';
                 this.newvalor_compra = '';
                 this.newvalor_venta = '';
                 this.newcantidad = '';

                 this.errors = [];
                $('#create').modal('hide');
                if ($('.modal-backdrop').is(':visible')) {
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                };

                this.$swal(
                    'Creado',
                    'Cliente creado con éxito.',
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

#scrol{
  overflow:scroll;
  height: 30px !important;
}

</style>