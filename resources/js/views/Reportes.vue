<template>


    <div>

        <div class="content-wrapper">

            <div class="row">

                <div class=" col-md-12 ">
                    <div class="media align-items-center bg-white mb-20">
                    <span class="avatar  bg-primary"><i class="fa fa-table"></i></span>
                    <div class="media-body">
                        <h3><strong>Reportes</strong></h3>
                    </div>
                    </div>
                </div>

            </div>

<section class="content">

	  <div class="row">

        <div class="col-6 col-lg-3">
            <div class="box box-body">
              <div class="text-center">
                <a href="#">
                  <img class="avatar avatar-xxl rounded-circle mb-15" src="images/cliente.jpg" alt="">
                </a>
				<h3 class="mb-5"><a href="#">Reporte de clientes</a></h3>
				<a href="#" class="btn btn-rounded btn-danger" v-on:click.prevent="generateReporte_clientes()"><i class="fa fa-file-pdf-o"></i>&nbsp;Generar</a>
              </div>
            </div>
          </div>

          <div class="col-6 col-lg-3">
            <div class="box box-body">
              <div class="text-center">
                <a href="#">
                  <img class="avatar avatar-xxl rounded-circle mb-15" src="images/venta.jpg" alt="">
                </a>
				<h3 class="mb-5"><a href="#">Reporte de ventas</a></h3>


                        <label for="fecha1">Fecha</label>
                            <v-date-picker mode='range' v-model='range' :columns="$screens({ lg: 2 }, 1)" :is-required="true"/>

                        <label for="id_laboratorio">Laboratorio</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-fw fa-hospital-o"></i></span>
						  </div>
						<select class="custom-select" v-model="id_laboratorio">
                            <option value="0" disabled>Seleccione</option>
                            <option v-for="laboratorio in arraylaboratorios" :key="laboratorio.id" :value="laboratorio.id" >{{laboratorio.nombre}}</option>
                        </select>
						</div>


                    <br>
				<a href="#" class="btn btn-rounded btn-danger" v-on:click.prevent="generateReporte_ventas()"><i class="fa fa-file-pdf-o"></i>&nbsp;Generar</a>
              </div>
            </div>
          </div>

        <div class="col-6 col-lg-3">
            <div class="box box-body">
              <div class="text-center">
                <a href="#">
                  <img class="avatar avatar-xxl rounded-circle mb-15" src="images/comision.jpg" alt="">
                </a>
				<h3 class="mb-5"><a href="#">Reporte de comisiones</a></h3>


                        <label for="fecha2">Fecha</label>

                                <v-date-picker mode='range' v-model='range_comisiones' :columns="$screens({ lg: 2 }, 1)" />

                        <br>
                        <label for="documento">Número Documento</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                                </div>
                                <input type="number" name="documento" class="form-control" v-model="documento">
                            </div>


                    <br>

				<a href="#" class="btn btn-rounded btn-danger" v-on:click.prevent="generateReporte_comisiones()"><i class="fa fa-file-pdf-o"></i>&nbsp;Generar</a>
              </div>
            </div>
          </div>



	  </div>
</section>


        </div>



    </div>


</template>

<script>

    import LayoutDefault from '../components/layouts/Principal.vue';

       export default {

           created:function(){

               this.$emit('update:layout', LayoutDefault);
               this.select_laboratorio();

           },

            data() {
                return {
                range: {
                    start: '',
                    end: ''
                },

                range_comisiones: {
                    start: '',
                    end: ''
                },

                range_laboratorios: {
                    start: '',
                    end: ''
                },

                documento:0,
                id_laboratorio:0,
                arraylaboratorios:[]

            };
        },



           methods:{

            generateReporte_clientes(){

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
                url: 'auth/reporte-clientes',
                method: 'GET',
                responseType: 'blob',
                }).then((response) => {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'clientes.pdf');
                document.body.appendChild(link);
                link.click();
                this.$swal(
                        'Generado',
                        'Reporte Generado con éxito.',
                        'success'
                    )
                });
        },

        generateReporte_ventas(){



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
                url: 'auth/reporte-ventas/' + this.range.start + '/' + this.range.end + '/' + this.id_laboratorio,
                method: 'GET',
                responseType: 'blob',
                }).then((response) => {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'ventas.pdf');
                document.body.appendChild(link);
                link.click();
                this.$swal(
                        'Generado',
                        'Reporte Generado con éxito.',
                        'success'
                    )
                }).catch(error =>{
                if(error.response.status == 400){
                    this.$swal({
                    type: 'error',
                    text: 'Por favor seleccciona un rango de fechas',
                    })
                }
             });

        },

        generateReporte_comisiones(){


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
                url: 'auth/reporte-comisiones/' + this.range_comisiones.start + '/' + this.range_comisiones.end + '/' + this.documento,
                method: 'GET',
                responseType: 'blob',
                }).then((response) => {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'comisiones.pdf');
                document.body.appendChild(link);
                link.click();
                this.$swal(
                        'Generado',
                        'Reporte Generado con éxito.',
                        'success'
                    )
                 }).catch(error =>{
                if(error.response.status == 400){
                    this.$swal({
                    type: 'error',
                    text: 'Por favor seleccciona un rango de fechas',
                    })
                }
             });
        },

        select_laboratorio(){

                let me = this;
                this.$http({
                url: 'auth/select_laboratorio',
                method: 'GET'
                }).then(function (response) {
                    me.arraylaboratorios = response.data.laboratorios;

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

        generateReporte_laboratorio(){


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
                url: 'auth/reporte-laboratorios/' + this.range_comisiones.start + '/' + this.range_comisiones.end + '/' + this.id,
                method: 'GET',
                responseType: 'blob',
                }).then((response) => {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'laboratorios.pdf');
                document.body.appendChild(link);
                link.click();
                this.$swal(
                        'Generado',
                        'Reporte Generado con éxito.',
                        'success'
                    )
                 }).catch(error =>{
                if(error.response.status == 400){
                    this.$swal({
                    type: 'error',
                    text: 'Por favor seleccciona un rango de fechas',
                    })
                }
             });
        },


           }
       }


</script>

<style>

.center-block {
    display: table;  /* Instead of display:block */
    margin-left: auto;
    margin-right: auto;
}

.date-picker /deep/ input {
    display: block !important;
    width: 100% !important;
    color: #495057 !important;
    background-color: #fff !important;
    background-clip: padding-box !important;
    border: 1px solid #ced4da !important;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out !important;
    padding: .25rem .5rem !important;
    font-size: .875rem !important;
    line-height: 1.5 !important;
    border-radius: .2rem !important;
}

</style>
