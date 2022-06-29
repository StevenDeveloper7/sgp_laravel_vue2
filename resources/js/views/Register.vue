<template>
  <div>
    <img class="wave-login" src="images/wave2.png" />
    <div class="container-login">
      <div class="img animar">
        <img src="images/new_logo.png" />
      </div>
      <div class="login-content">
        <div class="row">
          <div class="col-12 col-lg-12">
            <div class="row">
              <div class="col-12">
                <h4 class="page-header titulo">Bienvenido Ve! Para comenzar, dinos quién eres</h4>
              </div>

              <div class="col-md-6 col-lg-4">
                  <router-link :to="{name: 'registro_vendedores'}">
                <div class="box box-body text-center py-30 card1">
                  <a href="#">
                    <img class="avatar avatar-xxl store-style" src="images/store.png" alt />
                  </a>

                    <h5 class="mt-10 mb-1">
                      <a class="text-white hover-danger" href="#">Vendedor</a>
                    </h5>
                </div>
                </router-link>
              </div>

              <div class="col-md-6 col-lg-4"></div>

              <div class="col-md-6 col-lg-4">
                  <router-link :to="{name: 'registro_clientes'}">
                <div class="box box-body text-center py-30 box-inverse card2">
                  <a href="#">
                    <img class="avatar avatar-xxl" src="images/avatar.png" alt />
                  </a>

                    <h5 class="mt-10 mb-1">
                      <a class="text-white hover-primary" href="#">Comprador</a>
                    </h5>
                </div>
                </router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>




<style>
.card1 {
  background-color: #7f82eb;
  color: white;
}

.card2 {
  background-color: #c35d89;
  color: white;
}

.titulo {
  font-weight: bold;
  font-size: 20px;
}

.store-style{
    width: 105px !important;
    height: 100px !important;
}

</style>
