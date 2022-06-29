<template>

<div>


 <div class="content-wrapper">

            <div class="row">

            <div class=" col-md-12 ">
				<div class="media align-items-center bg-white mb-20">
				  <span class="avatar  bg-primary"><i class="fa fa-archive"></i></span>
				  <div class="media-body">
					<h3><strong>Aquí gestionas tus combos ve!</strong></h3>
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
                          <th scope="col">Nombre Del Combo</th>
                          <th scope="col">Nombre Del Negocio</th>
                          <th scope="col">Valor</th>
                          <th>Acción</th>
						</tr>
					  </thead>
					  <tbody>
						<tr v-for="combos in Combos" v-bind:key="combos.id" >
                            <td><center><img :src="'fotos-productos/'+ combos.foto" class="avatar avatar-xl avatar-bordered" height="70" width="70"></center></td>
                            <td class="td-style">{{ combos.nombre }}</td>
                            <td class="td-style">{{ combos.nombre_negocio }}</td>
                            <td class="td-style">{{ combos.valor | format-thousands }}</td>

                            <td>
                                <button type="button" class="btn btn-success btn-rounded" data-toggle="modal tooltip" data-placement="top" title="Ver" v-on:click.prevent="verCombos(combos)">
                                    <i class="fa fa-eye"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-warning btn-rounded" data-toggle="modal tooltip" data-placement="top" title="Editar" v-on:click.prevent="editCombos(combos)">
                                    <i class="fa fa-edit"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-rounded" data-toggle="modal tooltip" data-placement="top" title="Eliminar" v-on:click.prevent="deleteCombos(combos)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
					  </tbody>
					</table>

				</div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

	  </div>

    </section>
 </div>



        <form  method="POST" v-on:submit.prevent="createCombo">
        <!-- Modal -->
				<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" id="create">
				  <div class="modal-dialog modal-lg">
					<div class="modal-content">

					  <div class="modal-header bg-mo">
						<h5 class="modal-title">Crea un Nuevo Combo ve!</h5>
						<button type="button" class="close" data-dismiss="modal">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
				<div class="row">

            <div class="col s12">


                <div class="box card-inverse bg-img" style="background-image: url(images/fondo-combos.jpg); padding-top: 100px">

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
                        Sube una foto del Combo
                    <i class="fa fa-camera" style="width:50px;"></i>
                    </label>
                    <input id="file-upload" type="file"  @change="obtenerFoto" name="foto" class="form-control-file" style='display: none;'>
                  </li>
                </ul>

              </div>
            </div>



    <div class="form-group row">

            <div class="col-md-4">

                <validation-provider rules="required" v-slot="{ errors }">

                <label for="nombre">Nombre del Combo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-archive"></i></span>
                        </div>
                            <input id="nombre" type="text" class="form-control" v-model="nombre" required>
                        </div>
                      <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
                            <!-- /.input group -->
            </div>

            <div class="col-md-4">

                <validation-provider rules="required" v-slot="{ errors }">
				<label for="valor">Valor del Combo</label>
					<div class="input-group">
					   <div class="input-group-prepend">
						    <span class="input-group-text"><i class="fa fa-dollar"></i></span>
						</div>
						   <input id="valor" type="number" class="form-control" v-model="valor" min="1" required pattern="[0-9]+" title="Ingrese sólo Números">
						</div>
                   <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
						<!-- /.input group -->
			</div>

            <div class="col-md-4">
                <validation-provider rules="required" v-slot="{ errors }">
				<label for="descripcion">Descripción del Combo</label>
					<div class="input-group">
					   <div class="input-group-prepend">
						    <span class="input-group-text"><i class="fa fa-archive"></i></span>
						</div>
						   <textarea id="descripcion" type="text" class="form-control" rows="2" v-model="descripcion" required></textarea>
						</div>

                 <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
						<!-- /.input group -->
			</div>

    </div>

    <div class="form-group row">


                    <div class="col-md-4">


                        <label for="negocio">Categoría de Productos</label>
						<div class="input-group">

						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-shopping-basket"></i></span>
						  </div>
						   <select class="custom-select" v-model="id_cat_producto" required>
                            <option value="0" disabled>Seleccione</option>
                            <option v-for="cat_producto in arraycat_productos" :key="cat_producto.id" :value="cat_producto.id" >{{cat_producto.nombre}}</option>
                            </select>

						    </div>
						<!-- /.input group -->

					</div>

                    <div class="col-md-2 custom">

                        <button type="button" class="btn btn-success btn-rounded"  v-on:click.prevent="select_producto()"  title="Buscar">
                            <i class="fa fa-search">&nbsp;Buscar</i>
                        </button> &nbsp;
                    </div>

				</div>







    <div class="form-group row">


         <div class="col-md-6 anyClass" >

            <h3 style="text-align:center">Productos</h3>

            <div class="input-group">
                <input type="text"  class="form-control" placeholder="Texto a Buscar" v-model="textSearch">
            </div>

            <br>

           <draggable :list="productosFilter" :group="{ name: 'productos', pull: 'clone', put: false }" >
                <transition-group type="transition" :name="'flip-list'">

                <div class=" list-group-item list-group-item-action arrasta text-truncate" v-for="producto in productosFilter" :key="producto.id">
                    <img :src="'fotos-productos/'+ producto.foto" class="avatar avatar-xl avatar-bordered" height="70" width="70">
                    <span class="badge" style="color:black;">{{producto.nombre}}</span><br>
                    <span class="badge" style="color:black; ">{{producto.descripcion}}</span>
                </div>

            </transition-group>
        </draggable>

        </div>


        <div class="col-md-6 anyClass">

                <h3 style="text-align:center">Combo</h3>

                    <draggable :list="arraycombo" group="productos" handle=".handle">
                        <transition-group type="transition" :name="'flip-list'">
                        <div class="list-group-item list-group-item-action arrasta text-truncate" v-for="combo in arraycombo" :key="combo.id">
                            <img :src="'fotos-productos/'+ combo.foto" class="avatar avatar-xl avatar-bordered" height="70" width="70">
                            <span class="badge" style="color:black;">{{combo.nombre}}</span><br>
                            <span class="badge" style="color:black; ">{{combo.descripcion}}</span>
                        </div>
                        </transition-group>
                        <div
                            slot="footer"
                            class="btn-group list-group-item"
                            role="group"
                            aria-label="Basic example"
                            >
                             <img src="images/arrastra.png" v-show="show_img_draggable" >
                            </div>
                    </draggable>
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


    <form  method="POST" v-on:submit.prevent="updateCombos(fillcombos.id)">
        <!-- Modal -->
				<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" id="edit">
				  <div class="modal-dialog modal-lg">
					<div class="modal-content">

					  <div class="modal-header bg-mo">
						<h5 class="modal-title">Actualiza Tu Combo ve!</h5>
						<button type="button" class="close" data-dismiss="modal">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
				<div class="row">

            <div class="col s12">


                <div class="box card-inverse bg-img" style="background-image: url(images/fondo-combos.jpg); padding-top: 100px">

              <div class="flexbox align-items-center px-20" data-overlay="4">
                <div class="flexbox align-items-center mr-auto">
                  <a  >
                    <img class="avatar avatar-xl avatar-bordered" :src="'fotos-productos/'+ fillcombos.fotoMiniatura" alt="foto">
                  </a>
                  <div class="pl-10 d-none d-md-block">

                  </div>
                </div>

                <ul class="flexbox flex-justified text-center py-20">

                  <li class="pl-10">
                    <label for="file-upload" class="subir">
                    <i class="fa fa-camera" style="width:50px;"></i>
                    </label>
                    <input id="file-upload" type="file"  @change="obtenereditFoto" name="foto" class="form-control-file" style='display: none;'>
                  </li>
                </ul>

              </div>
            </div>



    <div class="form-group row">

            <div class="col-md-4">
                <validation-provider rules="required" v-slot="{ errors }">
                <label for="nombre">Nombre del Combo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-archive"></i></span>
                        </div>
                            <input id="nombre" type="text" class="form-control" v-model="fillcombos.nombre" required>
                        </div>
                            <!-- /.input group -->
                   <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
            </div>

            <div class="col-md-4">
                <validation-provider rules="required" v-slot="{ errors }">
				<label for="valor">Valor del Combo</label>
					<div class="input-group">
					   <div class="input-group-prepend">
						    <span class="input-group-text"><i class="fa fa-dollar"></i></span>
						</div>
						   <input id="valor" type="number" class="form-control" v-model="fillcombos.valor" min="1" required pattern="[0-9]+" title="Ingrese sólo Números">
						</div>
                <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
						<!-- /.input group -->
			</div>

            <div class="col-md-4">
                <validation-provider rules="required" v-slot="{ errors }">
				<label for="descripcion">Descripción del Combo</label>
					<div class="input-group">
					   <div class="input-group-prepend">
						    <span class="input-group-text"><i class="fa fa-archive"></i></span>
						</div>
						   <textarea id="descripcion" type="text" class="form-control" rows="2" v-model="fillcombos.descripcion" required></textarea>
						</div>
                <span style="color:red">{{ errors[0] }}</span>
                        </validation-provider>
						<!-- /.input group -->
			</div>

    </div>

    <div class="form-group row">



                    <div class="col-md-4">

                        <label for="negocio">Categoría Productos</label>
						<div class="input-group">

						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-shopping-basket"></i></span>
						  </div>
						   <select class="custom-select" v-model="fillcombos.id_cat_producto" required>
                            <option value="0" disabled>Seleccione</option>
                            <option v-for="cat_producto in arraycat_productos" :key="cat_producto.id" :value="cat_producto.id" >{{cat_producto.nombre}}</option>
                            </select>

						    </div>
						<!-- /.input group -->

					</div>

                    <div class="col-md-2 custom">

                        <button type="button" class="btn btn-success btn-rounded"  v-on:click.prevent="edit_select_producto()"  title="Buscar">
                            <i class="fa fa-search"></i>
                        </button> &nbsp;
                    </div>

				</div>







    <div class="form-group row">


         <div class="col-md-6 anyClass">

            <h3 style="text-align:center">Productos</h3>

            <div class="input-group">
                <input type="text"  class="form-control" placeholder="Texto a Buscar" v-model="textSearch">
            </div>

            <br>

           <draggable :list="productosFilter" :group="{ name: 'productos', pull: 'clone', put: false }" >
                <transition-group type="transition" :name="'flip-list'">

                <div class=" list-group-item list-group-item-action arrasta text-truncate" v-for="producto in productosFilter" :key="producto.id">
                    <img :src="'fotos-productos/'+ producto.foto" class="avatar avatar-xl avatar-bordered" height="70" width="70">
                    <span class="badge" style="color:black;">{{producto.nombre}}</span><br>
                    <span class="badge" style="color:black; ">{{producto.descripcion}}</span>
                </div>

            </transition-group>
        </draggable>

        </div>


        <div class="col-md-6 anyClass">

                <h3 style="text-align:center">Combo</h3>

                    <draggable :list="Detalle_combos" group="productos" >
                        <transition-group type="transition" :name="'flip-list'">
                        <div class="list-group-item list-group-item-action arrasta text-truncate" v-for="detalle_combo in Detalle_combos" :key="detalle_combo.id">
                            <img :src="'fotos-productos/'+ detalle_combo.foto" class="avatar avatar-xl avatar-bordered" height="70" width="70">
                            <span class="badge" style="color:black;">{{detalle_combo.nombre}}</span><br>
                            <span class="badge" style="color:black; ">{{detalle_combo.descripcion}}</span>

                        </div>
                        </transition-group>
                    </draggable>


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





        <!-- Ver combos -->
				<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" id="ver">
				  <div class="modal-dialog modal-lg">
					<div class="modal-content">

					  <div class="modal-header bg-mo">
						<h5 class="modal-title">Ver Combo</h5>
						<button type="button" class="close" data-dismiss="modal">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
				<div class="row">

            <div class="col s12">


                <div class="box card-inverse bg-img" style="background-image: url(images/fondo-combos.jpg); padding-top: 100px">

              <div class="flexbox align-items-center px-20" data-overlay="4">
                <div class="flexbox align-items-center mr-auto">
                  <a href="#" >
                    <img class="avatar avatar-xl avatar-bordered" :src="'fotos-combos/'+ fillcombos.fotoMiniatura" alt="foto">
                  </a>
                  <div class="pl-10 d-none d-md-block">

                  </div>
                </div>

              </div>
            </div>



    <div class="form-group row">

            <div class="col-md-4">

                <label for="nombre">Nombre</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-archive"></i></span>
                        </div>
                            <input id="nombre" type="text" class="form-control" v-model="fillcombos.nombre" readonly="readonly">
                        </div>
                            <!-- /.input group -->
            </div>

            <div class="col-md-4">
				<label for="valor">Valor</label>
					<div class="input-group">
					   <div class="input-group-prepend">
						    <span class="input-group-text"><i class="fa fa-dollar"></i></span>
						</div>
						   <input id="valor" type="number" class="form-control" v-model="fillcombos.valor" readonly="readonly">
						</div>
						<!-- /.input group -->
			</div>



    </div>

    <div class="form-group row">

                     <div class="col-md-6">
                        <label for="descripcion">Descripción</label>
                            <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-archive"></i></span>
                                </div>
                                <textarea id="descripcion" type="text" class="form-control" rows="3" v-model="fillcombos.descripcion" readonly="readonly"></textarea>
                            </div>
						<!-- /.input group -->
			        </div>

				</div>


    <div class="form-group row">


        <div class="col-md-6 anyClass">

                <h3 style="text-align:center">Combo</h3>

                    <draggable :list="Detalle_combos" group="productos" >
                        <transition-group type="transition" :name="'flip-list'">
                        <div class="list-group-item list-group-item-action arrasta text-truncate" v-for="detalle_combo in Detalle_combos" :key="detalle_combo.id">
                            <img :src="'fotos-productos/'+ detalle_combo.foto" class="avatar avatar-xl avatar-bordered" height="70" width="70">
                            <span class="badge" style="color:black;">{{detalle_combo.nombre}}</span><br>
                            <span class="badge" style="color:black; ">{{detalle_combo.descripcion}}</span>

                        </div>
                        </transition-group>
                    </draggable>


        </div>

     </div>


              </div>
              </div>

					  </div>

					  <div class="modal-footer modal-footer-uniform">
						<button type="button" class="btn btn-bold btn-pure btn-secondary btn-rounded" data-dismiss="modal">Cerrar</button>

					  </div>
					</div>
				  </div>
				</div>
			  <!-- /.modal -->


</div>

</template>


<script>

    import LayoutDefault from '../components/layouts/Principal.vue';
    import draggable from 'vuedraggable';

     import { ValidationProvider, extend } from 'vee-validate';
    import { required, email } from 'vee-validate/dist/rules';
    import { numeric } from 'vee-validate/dist/rules';


    export default{

        created: function(){

            this.Show_img();

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

        this.select_negocio();
        this.getCombos();
        this.select_categoria_producto();
        //this.select_producto();

        this.$emit('update:layout', LayoutDefault);

    },

    data(){

        return{

        textSearch: "",
        fotoMiniatura:'',
        valor:'',
        nombre:'',
        descripcion:'',
        loading: true,
        arraynegocios:[],
        arraycat_productos:[],
        arrayproductos:[],
        arraycombo:[],
        arrayvacio:[],
        Combos:[],
        Detalle_combos:[],
        id_negocio:'',
        id_cat_producto:'',
        fillcombos:{'id': '', 'id_negocio': '', 'foto': '', 'nombre': '', 'valor': '','descripcion': '' ,'fotoMiniatura': ''},
        editfotoMiniatura : '',
        editfoto:'',
        show_img_draggable: true

        }

    },

    computed: {




            edit_foto(){
                return this.editfotoMiniatura;
            },

            productosFilter: function() {
            var textSearch = this.textSearch;
            return this.arrayproductos.filter(function(el) {
                return el.nombre.toLowerCase().indexOf(textSearch.toLowerCase()) !== -1;
            });
        },



            },

    methods:{

        Show_img(){

            setInterval(() => {

            var count = Object.keys(this.arraycombo).length;

            if( count > 0){

                this.show_img_draggable = false;
            }
            },(1000));

        },


        obtenereditFoto(e){
                let file = e.target.files[0];
                this.edit_foto = file;

                this.cargareditFoto(file);
            },

            cargareditFoto(file){
                let reader = new FileReader();

                reader.onload = (e) => {
                    this.editfotoMiniatura = e.target.result;

                }
                reader.readAsDataURL(file);

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


        getCombos(){

                let me = this;
                this.$http({
                url: 'auth/combos',
                method: 'GET'
                }).then(function (response) {
                    me.Combos = response.data,
                    //me.editfotoMiniatura ='fotos-combos/'+ me.Combos[0]['foto'];
                    //me.editfoto = me.Combos[0]['foto'];
                   // console.log(me.Combos)
                    me.mytable();
                    me.loading = false
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

            editCombos(combos){

                this.fillcombos.id = combos.id;
                this.fillcombos.nombre = combos.nombre;
                this.fillcombos.valor = combos.valor;
                this.fillcombos.descripcion = combos.descripcion;
                this.fillcombos.fotoMiniatura = combos.foto;
                //this.fillcombos.detalle_combo = combos.detalle_combo;


                let id = this.fillcombos.id;
                let me = this;
                this.$http({
                url: 'auth/search-detalle-combo/' + id,
                method: 'GET'
                })
                .then((response) => {
                    me.Detalle_combos = response.data;
                    //console.log(me.Detalle_combos);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });



                $('#edit').modal('show');
            },

            verCombos(combos){

                this.fillcombos.id = combos.id;
                this.fillcombos.nombre = combos.nombre;
                this.fillcombos.valor = combos.valor;
                this.fillcombos.descripcion = combos.descripcion;
                this.fillcombos.fotoMiniatura = combos.foto;
                //this.fillcombos.detalle_combo = combos.detalle_combo;


                let id = this.fillcombos.id;
                let me = this;
                this.$http({
                url: 'auth/search-detalle-combo/' + id,
                method: 'GET'
                })
                .then((response) => {
                    me.Detalle_combos = response.data;

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });



                $('#ver').modal('show');
            },

            updateCombos(id){

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
                url: 'auth/combos/' + id,
                method: 'PUT',
                data: {

                    nombre : this.fillcombos.nombre,
                    valor : this.fillcombos.valor,
                    descripcion : this.fillcombos.descripcion,
                    arraycombo: this.Detalle_combos

                }

                }).then(response => {
                    this.getCombos();
                    this.errors = [];

                    $('#edit').modal('hide');
                    if ($('.modal-backdrop').is(':visible')) {
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                };
                     this.$swal(
                    'Actualizado',
                    'combo actualizado con éxito.',
                    'success'
                )
                }).catch(error =>{
                    this.errors = errors.response.data
                });
            },


        select_negocio(){

                let me = this;
                this.$http({
                url: 'auth/select-negocio',
                method: 'GET'
                })
                .then((response) => {
                    me.arraynegocios = response.data.negocios;
                    //console.log(me.arraynegocios);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

        select_categoria_producto(){

            let me = this;
                this.$http({
                url: 'auth/select-categoria-producto',
                method: 'GET'
                })
                .then((response) => {
                    me.arraycat_productos = response.data;
                    //console.log(me.arraycat_productos);
                    //console.log(me.newid_negocio);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

            },



        edit_select_categoria_producto(){

            let me = this;
                this.$http({
                url: 'auth/select-categoria-producto' ,
                method: 'GET'
                })
                .then((response) => {
                    me.arraycat_productos = response.data;
                    //console.log(me.arraycat_productos);
                    //console.log(me.newid_negocio);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

            },

        edit_select_producto(){

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

            let me = this;
                this.$http({
                url: 'auth/select-producto/' + this.fillcombos.id_cat_producto,
                method: 'GET'
                })
                .then((response) => {
                    this.$swal.close();
                    me.arrayproductos = response.data;
                    //console.log(me.arrayproductos);
                    //console.log(me.newid_negocio);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

            },

        select_producto(){

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

            let me = this;
                this.$http({
                url: 'auth/select-producto/' + this.id_cat_producto,
                method: 'GET'
                })
                .then((response) => {
                    this.$swal.close();
                    me.arrayproductos = response.data;
                    //console.log(me.arrayproductos);
                    //console.log(me.newid_negocio);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

            },

            removeAt(combo) {
                var indice = combo.detalle_combo;
                if (indice != -1){
                    this.Detalle_combos.splice(indice, 1);
                }
            },

            edit_removeAt(detalle_combo) {


                var indice = detalle_combo.id_detalle_combo;
                if (indice != -1){
                    this.Detalle_combos.splice(indice, 1);
                }

               /* this.$http({
                url: 'auth/delete-detalle-combo/' + detalle_combo.id_detalle_combo,
                method: 'PUT',
                }).then(response => {

                })
                .catch(function (error) {
                    console.log(error);
                });*/

            },




           createCombo(){

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
                url: 'auth/combos',
                method: 'POST',
                data: {

                // tabla combos

                 valor : this.valor,
                 foto: this.fotoMiniatura,
                 nombre: this.nombre,
                 descripcion : this.descripcion,
                 arraycombo: this.arraycombo


                }

             }).then(response => {

                 this.getCombos();

                 this.$swal(
                    'Creado',
                    'Combo creado con éxito.',
                    'success'
                )

                 this.id_negocio = '';
                 this.nombre = '';
                 this.descripcion = '';
                 this.valor = '';
                 this.fotoMiniatura = '';
                 this.arraycombo = '';
                 this.show_img_draggable = true;



                 this.errors = [];
                $('#create').modal('hide');
                if ($('.modal-backdrop').is(':visible')) {
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                };


             }).catch(error =>{

                 this.errors = error.response.data

             });

        },

        deleteCombos(combo){

                this.$swal({
                title: 'Está seguro de Eliminar este Combo?',
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
                url: 'auth/combos/' + combo.id,
                method: 'DELETE',
                }).then(response => {
                    this.getCombos();
                    this.$swal(
                        'Eliminado!',
                        'El Combo ha sido Eliminado con éxito.',
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

    },

    components: {
            draggable,
             ValidationProvider


        },



    }



</script>


<style>

.custom{
    margin-top: 20px;

}


.flip-list-move {
  transition: transform 0.5s;
}
.no-move {
  transition: transform 0s;
}
.ghost {
  opacity: 0.5;
  background: #c8ebfb;
}
.list-group {
  min-height: 20px;
}
.list-group-item {
  cursor: move;
}
.list-group-item i {
  cursor: pointer;
}

.anyClass {
  height:350px;
  overflow-y: scroll;
}



</style>
