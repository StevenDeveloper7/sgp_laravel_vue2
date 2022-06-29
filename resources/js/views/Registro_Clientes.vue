<template>
    <div>
        <img class="wave-login" src="images/wave2.png" />
        <div class="container-login">
            <div class="img animar"></div>
            <div class="login-content">
                <form @submit.prevent="register" v-if="!success" method="post">
                    <img src="images/avatar.png" class="img-avatar" />
                    <h2 class="title">Bienvenido</h2>

                    <div class="form-group">
                        <validation-provider
                            rules="required"
                            v-slot="{ errors }"
                        >
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-mo">
                                        <i class="fa fa-id-card"></i>
                                    </span>
                                </div>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Nombre Completo"
                                    v-model="nombre_completo"
                                    required
                                />
                            </div>
                            <span style="color: red">{{ errors[0] }}</span>
                        </validation-provider>
                        <!-- /.input group -->
                    </div>

                    <div class="form-group">
                        <validation-provider
                            rules="required"
                            v-slot="{ errors }"
                        >
                            <v-select
                                label="nombre"
                                placeholder="Ciudad"
                                :options="arrayciudads"
                                :reduce="(nombre) => nombre.id"
                                v-model="id_ciudad"
                                required
                            ></v-select>
                            <span style="color: red">{{ errors[0] }}</span>
                        </validation-provider>
                    </div>

                    <div class="form-group">
                        <validation-provider
                            rules="positive|required|numeric"
                            v-slot="{ errors }"
                        >
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-mo">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Numero de Documento"
                                    v-model="numero_documento"
                                    required
                                />
                            </div>
                            <span style="color: red">{{ errors[0] }}</span>
                        </validation-provider>
                        <!-- /.input group -->
                    </div>

                    <div class="form-group">
                        <validation-provider
                            rules="positive|required|numeric"
                            v-slot="{ errors }"
                        >
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-mo">
                                        <i class="fa fa-phone"></i>
                                    </span>
                                </div>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Teléfono"
                                    v-model="telefono"
                                    required
                                />
                            </div>
                            <span style="color: red">{{ errors[0] }}</span>
                        </validation-provider>
                        <!-- /.input group -->
                    </div>

                    <div class="form-group">
                        <validation-provider
                            rules="required"
                            v-slot="{ errors }"
                        >
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-mo">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                                </div>
                                <!-- <gmap-autocomplete @place_changed="setPlace" :options="autocompleteOptions" :value="newdireccion" class="form-control" placeholder="Dirección"> </gmap-autocomplete> -->
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Direccion"
                                    v-model="direccion"
                                    required
                                />
                            </div>
                            <span style="color: red">{{ errors[0] }}</span>
                        </validation-provider>
                    </div>

                    <div class="form-group">
                        <validation-provider
                            name="email"
                            rules="required|email"
                            v-slot="{ errors }"
                        >
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-mo">
                                        <i class="ti-email"></i>
                                    </span>
                                </div>
                                <input
                                    type="email"
                                    class="form-control"
                                    placeholder="Email"
                                    v-model="email"
                                    required
                                />
                            </div>
                            <span style="color: red">{{ errors[0] }}</span>
                        </validation-provider>
                    </div>

                    <div class="form-group">
                        <validation-provider
                            name="password"
                            rules="required"
                            v-slot="{ errors }"
                        >
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-mo">
                                            <i class="ti-lock"></i>
                                        </span>
                                    </div>
                                    <input
                                        type="password"
                                        class="form-control"
                                        placeholder="Contraseña"
                                        v-model="password"
                                        required
                                        id="password-field"
                                    />
                                    <div class="input-group-addon">
                                        <a
                                            type="password"
                                            @click="switchVisibility"
                                            ><i
                                                id="pass-status"
                                                class="fa fa-eye"
                                                aria-hidden="true"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                            <span style="color: red">{{ errors[0] }}</span>
                        </validation-provider>
                    </div>

                    <div class="form-group">
                        <validation-provider
                            name="password"
                            rules="required"
                            v-slot="{ errors }"
                        >
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-mo">
                                            <i class="ti-lock"></i>
                                        </span>
                                    </div>
                                    <input
                                        type="password"
                                        class="form-control"
                                        placeholder="Confirmar Contraseña"
                                        v-model="password_confirmation"
                                        required
                                        id="password-field"
                                    />
                                    <div class="input-group-addon">
                                        <a
                                            type="password"
                                            @click="switchVisibility2"
                                            ><i
                                                id="pass-status2"
                                                class="fa fa-eye"
                                                aria-hidden="true"
                                            ></i
                                        ></a>
                                    </div>
                                </div>
                            </div>
                            <span style="color: red">{{ errors[0] }}</span>
                        </validation-provider>
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <input
                                type="checkbox"
                                id="basic_checkbox_1"
                                @click="validate()"
                            />
                            <label for="basic_checkbox_1" class="cambio-color"
                                >Acepto</label
                            >
                            <a
                                href="terminos/terminosycondiciones.html"
                                target="_blank"
                                class="cambio-color"
                                >Términos y condiciones</a
                            >
                        </div>
                    </div>

                    <div class="col-md-12">
                        <router-link :to="{ name: 'login' }">
                            <a class="cambio-color" href="#"
                                >¿Ya tienes una cuenta? Inicia Sesión</a
                            >
                        </router-link>
                    </div>

                    <!-- aqui -->

                    <div class="col-md-12">
                        <input
                            type="submit"
                            class="btn-login"
                            value="Crear Cuenta"
                        />
                    </div>

                    <p class="cambio-color">
                        &copy; 2020
                        <a
                            class="cambio-color"
                            href="https://www.sya-tecnova.com/"
                            >Sya Tecnova S.A.S</a
                        >. Todos los derechos reservados.
                    </p>
                </form>
            </div>
        </div>

        <!-- The Modal Loading -->
        <div class="modal fade" tabindex="-1" id="load" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <img src="images/spinner.gif" />
                        <label>Cargando...</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal ayuda -->
        <div class="modal fade" tabindex="-1" id="ayuda" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <img src="statics/images/direccion.gif" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ValidationProvider, extend } from "vee-validate";
import { required, email } from "vee-validate/dist/rules";
import { numeric } from "vee-validate/dist/rules";

export default {
    created: function () {
        extend("positive", (value) => {
            return value >= 0;
        });

        extend("numeric", {
            ...required,
            message: "Ingrese solo numeros",
        });

        extend("required", {
            ...required,
            message: "Este campo es obligatorio",
        });

        extend("email", {
            ...required,
            message: "Ingrese un email válido",
        });

        this.select_tipo_documento();
        this.select_departamento();
        this.select_ciudad();
    },

    data() {
        return {
            autocompleteOptions: {
                componentRestrictions: {
                    country: ["co"],
                },
            },
            numero_documento: "",
            nombre_completo: "",
            email: "",
            password: "",
            id_tipo: "",
            id_departamento: "",
            id_ciudad: "",
            telefono: "",
            direccion: "",
            password_confirmation: "",
            has_error: false,
            error: "",
            errors: {},
            success: false,
            arraydocumentos: [],
            arraydepartamentos: [],
            arrayciudads: [],
            loading: true,
            toggle: true,
            markers: [],
            places: [],
            terminos: false,
            passwordFieldType: "password",
            lat: "",
            lng: "",
        };
    },

    mounted() {},

    methods: {
        methodToRunOnSelect(payload) {
            this.object = payload;
        },

        switchVisibility() {
            var passwordInput = document.getElementById("password-field");
            var passStatus = document.getElementById("pass-status");

            if (passwordInput.type == "password") {
                passwordInput.type = "text";
                passStatus.className = "fa fa-eye-slash";
            } else {
                passwordInput.type = "password";
                passStatus.className = "fa fa-eye";
            }
        },

        switchVisibility2() {
            var passwordInput = document.getElementById(
                "password-field-confirmation"
            );
            var passStatus = document.getElementById("pass-status2");

            if (passwordInput.type == "password_confirmation") {
                passwordInput.type = "text";
                passStatus.className = "fa fa-eye-slash";
            } else {
                passwordInput.type = "password_confirmation";
                passStatus.className = "fa fa-eye";
            }
        },

        setPlace(place) {
            this.currentPlace = place;

            this.lat = this.currentPlace.geometry.location.lat();
            this.lng = this.currentPlace.geometry.location.lng();
            this.direccion = this.currentPlace.name;
        },

        addMarker() {
            if (this.currentPlace) {
                const marker = {
                    lat: this.currentPlace.geometry.location.lat(),
                    lng: this.currentPlace.geometry.location.lng(),
                    name: this.currentPlace.formatted_address,
                };
                this.markers = marker;
                this.places.push(this.currentPlace);
                this.center = marker;
                this.currentPlace = null;
            }
            //console.log(this.markers);
        },

        validate() {
            var isChecked = document.getElementById("basic_checkbox_1").checked;

            if (isChecked) {
                this.terminos = true;
            }
        },

        select_tipo_documento() {
            let me = this;
            let url = "documentos";
            axios
                .get(url)
                .then((response) => {
                    me.arraydocumentos = response.data.documentos;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
        },

        select_departamento() {
            let me = this;
            let url = "departamentos";
            axios
                .get(url)
                .then((response) => {
                    me.arraydepartamentos = response.data.departamentos;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
        },

        select_ciudad() {
            let me = this;
            let url = "ciudads";
            axios
                .get(url)
                .then((response) => {
                    me.arrayciudads = response.data.ciudads;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
        },

        register() {
            if (this.terminos == false) {
                this.$swal({
                    type: "error",
                    title: "Términos y condiciones",
                    text: "Para continuar con el registro debes aceptar los términos y condiciones",
                });
            }
            // else if (this.lat === "" || this.lng === "") {
            //     this.$swal({
            //         type: "error",
            //         title: "Términos y condiciones",
            //         text: "Debes seleccionar una dirección de la lista",
            //     });

            //     $("#ayuda").modal("show");
            // }
            else {
                this.$swal({
                    title: "Cargando!",
                    text: "Espere un momento por favor..",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    showCancelButton: false,
                    showConfirmButton: false,
                    imageUrl: "images/spinner.gif",
                    onOpen: () => {
                        swal.showLoading();
                    },
                });

                this.addMarker();

                var app = this;
                this.$auth.register({
                    data: {
                        nombre_completo: app.nombre_completo,
                        numero_documento: app.numero_documento,
                        id_departamento: app.id_departamento,
                        id_ciudad: app.id_ciudad,
                        direccion: app.direccion,
                        telefono: app.telefono,
                        email: app.email,
                        password: app.password,
                        password_confirmation: app.password_confirmation,
                        id_role: 2,
                    },
                    success: function () {
                        app.success = true;
                        this.$router.push({
                            name: "login",
                            params: { successRegistrationRedirect: true },
                        });

                        this.$swal(
                            "Creada",
                            "Cuenta creada con éxito.",
                            "success"
                        );
                    },
                    error: function (res) {
                        // console.log(res.response.data.errors)
                        app.has_error = true;
                        app.error = res.response.data.error;
                        if (res.response.data.code == 1) {
                            this.$swal({
                                type: "error",
                                title: "Este correo ya se encuentra registrado",
                                text: "Por favor verifica los datos",
                            });
                        }
                    },
                });
            }
        },
    },
    components: {
        ValidationProvider,
    },
};
</script>

<style>
.v-select {
    background: white !important;
}

.inner-addon {
    position: relative;
}
.inner-addon .glyphicon {
    position: absolute;
    padding: 10px;
    pointer-events: none;
}
.left-addon .glyphicon {
    left: 0px;
}
.right-addon .glyphicon {
    right: 0px;
}
.left-addon input {
    padding-left: 30px;
}
.right-addon input {
    padding-right: 30px;
}
</style>
