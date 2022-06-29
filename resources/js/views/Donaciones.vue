<template>


    <div>

        <div class="content-wrapper">

            <div class="row">

                <div class=" col-md-12 ">
                    <div class="media align-items-center bg-white mb-20">
                    <span class="avatar  bg-primary"><i class="fa fa-credit-card"></i></span>
                    <div class="media-body">
                        <h3><strong>Donaciones</strong></h3> <br><br>
                        <h4 class="text-center">Al realizar tu donacion contribuiras  para el matenimiento del sitio, nuevas mejoras y actualizaciones que te daran una mejor experiencia 
                     de usuario. Ademas de esto El 20 % de las donaciones recibidas se utilizaran para beneficiar a los mas afectados por la pandemia, por medio de mercados y aportes monetarios</h4>

                    </div>
                    </div>
                </div>

            </div>


            <section class="content">

                <div class="row">

                    <div class="col-md-12">


                    </div>

                </div>


                    <div class="row no-gutters">

              <div class="col-md-3">
                <div class="box box-shadowed box-round text-center p-40">
                  <label class="valor"><sup>$</sup>5.000 </label>

                  <a href="https://biz.payulatam.com/B0d0067223C378A"><img src="http://www.payulatam.com/img-secure-2015/boton_pagar_mediano.png"></a>
                  <br>
                  <img class=" img-responsive" src='images/donacion.jpg' alt="Card image cap">
                </div>
              </div>

              <div class="col-md-3">
                <div class="box box-shadowed box-round text-center p-40">
                  <h3 class="price text-success">
                    <sup>$</sup>10.000

                  </h3>
                  <a href="https://biz.payulatam.com/B0d00678B052CAA"><img src="http://www.payulatam.com/img-secure-2015/boton_pagar_mediano.png"></a>

                  <br>
                  <img class=" img-responsive" src='images/donacion.jpg' alt="Card image cap">
                </div>
              </div>

              <div class="col-md-3">
                <div class="box box-shadowed box-round text-center p-40">

                  <h3 class="price text-info">
                    <sup>$</sup>20.000

                  </h3>
                  <a href="https://biz.payulatam.com/B0d0067E06FE685"><img src="http://www.payulatam.com/img-secure-2015/boton_pagar_mediano.png"></a>

                  <br>
                  <img class=" img-responsive" src='images/donacion.jpg' alt="Card image cap">
                </div>
              </div>

              <div class="col-md-3">
                <div class="box box-shadowed box-round text-center p-40">

                  <h3 class="price text-danger">
                    <sup>$</sup>50.000

                  </h3>
                  <a href="https://biz.payulatam.com/B0d00674A19C088"><img src="http://www.payulatam.com/img-secure-2015/boton_pagar_mediano.png"></a>

                  <br>
                  <img class=" img-responsive" src='images/donacion.jpg' alt="Card image cap">
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

           },

           data() {
                return {


                    }
        },


        methods:{

            }

           }



</script>
<style>
.valor{
  font-size: 30px;
}

</style>

