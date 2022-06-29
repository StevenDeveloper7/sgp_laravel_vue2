<template>

    <div>

<div class="content-wrapper">


        <!-- Main content -->
    <section class="content">

	  <div class="row">

            <div class="col-xl-3 col-md-6 col-6">
			  <!-- small box -->
			  <div class="small-box box-inverse bg-primary-gradient">
				<div class="inner">
				  <h3 v-text="TotalNegocios"></h3>

				  <p>NEGOCIOS REGISTRADS</p>
				</div>
				<div class="icon text-white">
				  <i class="fa fa-home"></i>
				</div>
				<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
			  </div>
			</div>
			<!-- ./col -->
			<div class="col-xl-3 col-md-6 col-6">
			  <!-- small box -->
			  <div class="small-box box-inverse bg-warning-gradient">
				<div class="inner">
				  <h3 v-text="TotalProductos"></h3>

				  <p>PRODUCTOS CREADOS</p>
				</div>
				<div class="icon text-white">
				  <i class="fa fa-cart-plus"></i>
				</div>
				<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
			  </div>
			</div>
			<!-- ./col -->
			<div class="col-xl-3 col-md-6 col-6">
			  <!-- small box -->
			  <div class="small-box box-inverse bg-success-gradient">
				<div class="inner">
				  <h3 v-text="TotalVendedores"></h3>

				  <p>VENDEDORES REGISTRADOS</p>
				</div>
				<div class="icon text-white">
				  <i class="fa fa-users"></i>
				</div>
				<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
			  </div>
			</div>
			<!-- ./col -->
			<div class="col-xl-3 col-md-6 col-6">
			  <!-- small box -->
			  <div class="small-box box-inverse bg-danger-gradient">
				<div class="inner">
				  <h3 v-text="TotalCategorias"></h3>

				  <p>CATEGORÍAS DE PRODUCTOS</p>
				</div>
				<div class="icon text-white">
				  <i class="fa fa-shopping-basket"></i>
				</div>
				<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
			  </div>
			</div>
			<!-- ./col -->

	  </div>

	</section>

        <section class="content" v-show="false">
            <div class="row">

            <div class="col-md-6">
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
                <i class="fa fa-bar-chart"></i>
                    Ventas Anuales</h3>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas ref="CharVentas_anuales" width="500" height="150"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            </div>

            <div class="col-md-6">
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
                <i class="fa fa-bar-chart"></i>
                    Ventas Mensuales</h3>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas ref="CharVentas_mensuales" width="500" height="150"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            </div>


            </div>
        </section>


    </div>

    </div>

</template>

<script>

    import LayoutDefault from '../components/layouts/Principal.vue';
    import Chart from 'chart.js';
    import numeral from 'numeral';


    export default{

        created: function(){

            this.total_negocios();
            this.total_productos();
            this.total_vendedores();
            this.total_categorias();
            //this.ventas_anuales();
            //this.ventas_mensuales();

            this.$emit('update:layout', LayoutDefault);
        },

        data (){

            return{
                TotalNegocios:0,
                TotalProductos:0,
                TotalVendedores:0,
                TotalCategorias:0

            }
        },

        methods:{



            total_negocios(){
                let me = this;
                this.$http({
                url: 'auth/total-negocios',
                method: 'GET'
                }).then(function (response) {
                    me.TotalNegocios = response.data;

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

            total_productos(){

                let me = this;
                this.$http({
                url: 'auth/total-productos',
                method: 'GET'
                }).then(function (response) {
                    me.TotalProductos = response.data;

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

            total_vendedores(){

                let me = this;
                this.$http({
                url: 'auth/total-vendedores',
                method: 'GET'
                }).then(function (response) {
                    me.TotalVendedores = response.data;

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

            total_categorias(){

                let me = this;
                this.$http({
                url: 'auth/total-categorias',
                method: 'GET'
                }).then(function (response) {
                    me.TotalCategorias = response.data;

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

             ventas_anuales(){

                let Total = new Array();
                let Anual = new Array();

                this.$http({
                url: 'auth/ventas-anuales',
                method: 'GET'
                }).then((response) => {
                    //creamos un array y guardamos el contenido que nos devuelve el response
                    let data = response.data;

                    data.forEach(element => {
                        Total.push(element.total);
                        Anual.push(element.year);
                        });


                    new Chart(this.$refs.CharVentas_anuales, {
                            type: 'bar',
                            data: {
                                labels: Anual,
                                datasets: [
                            {
                                label: 'Ventas',
                                backgroundColor: '#00BFF3',
                                data: Total,

                            },
                                    ],
                            },
                            options: {
                            scales: {
                            yAxes: [{
                                ticks: {
                                beginAtZero: true,
                                callback: value => numeral(value).format('$0,0')
                                }
                            }]
                            }
                        },
                        tooltips: {
                        callbacks: {
                            label(tooltipItem, data) {
                            // Get the dataset label.
                            const label = data.datasets[tooltipItem.datasetIndex].label;

                            // Format the y-axis value.
                            const value = numeral(tooltipItem.yLabel).format('$0,0');

                            return `${label}: ${value}`;
                            }
                        }
                        }
                    });

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
                },

                ventas_mensuales(){

                let Total = new Array();
                let Mes = new Array();

                this.$http({
                url: 'auth/ventas-mensuales',
                method: 'GET'
                }).then((response) => {
                    //creamos un array y guardamos el contenido que nos devuelve el response
                    let data = response.data;

                    data.forEach(element => {
                        Total.push(element.total);
                        Mes.push(element.month);
                        });


                    new Chart(this.$refs.CharVentas_mensuales, {
                            type: 'bar',
                            data: {
                                labels: Mes,
                                datasets: [
                            {
                                label: 'Ventas',
                                backgroundColor: '#28D094',
                                data: Total,

                            },
                                    ],
                            },
                            options: {
                            scales: {
                            yAxes: [{
                                ticks: {
                                beginAtZero: true,
                                callback: value => numeral(value).format('$0,0')
                                }
                            }]
                            }
                        },
                        tooltips: {
                        callbacks: {
                            label(tooltipItem, data) {
                            // Get the dataset label.
                            const label = data.datasets[tooltipItem.datasetIndex].label;

                            // Format the y-axis value.
                            const value = numeral(tooltipItem.yLabel).format('$0,0');

                            return `${label}: ${value}`;
                            }
                        }
                        }
                    });

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
                },


        }

    }


</script>
