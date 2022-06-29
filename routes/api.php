<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function () {
    // Below mention routes are public, user can access those without any restriction.
    // Create New User
    Route::post('register', 'AuthController@register');
    // Login User
    Route::post('login', 'AuthController@login');

    Route::post('login-facebook', 'LoginFacebookController@login');

    // Refresh the JWT Token
    Route::get('refresh', 'AuthController@refresh');



    // Below mention routes are available only for the authenticated users.
    Route::middleware('auth:api')->group(function () {
        // Get user info
        Route::get('user', 'AuthController@user');

        // Get user info in movil
        Route::get('user-movil', 'AuthController@user_movil');

        // Logout user from application
        Route::post('logout', 'AuthController@logout');

        //Clientes
        Route::resource('clientes', 'ClienteController');


        //Ventas
        Route::resource('ventas', 'SolicitudVentaController');
        Route::get('select_cliente', 'SolicitudVentaController@select_cliente');
        Route::get('select_vendedor', 'SolicitudVentaController@select_vendedor');
        Route::get('select_laboratorio', 'SolicitudVentaController@select_laboratorio');
        Route::get('select_estado', 'SolicitudVentaController@select_estado');
        Route::get('select_estado_pago', 'SolicitudVentaController@select_estado_pago');

        //Usuarios
        Route::resource('usuarios', 'UsuarioController');
        Route::resource('admin_usuarios', 'AdminUsuarioController');
        Route::get('estado-usuario/{id}', 'UsuarioController@estado_usuario');
        Route::get('ubicacion/{id}', 'UsuarioController@ubicacion');


        //Reportes
        Route::get('reporte-clientes', 'ReporteController@reporte_clientes');
        Route::get('reporte-ventas/{start}/{end}/{id}', 'ReporteController@reporte_ventas');
        Route::get('reporte-comisiones/{start}/{end}/{documento}', 'ReporteController@reporte_comisiones');
        Route::get('reporte-laboratorios/{start}/{end}/{id}', 'ReporteController@reportelaboratorios');


        //Tipo documento
        Route::resource('documentos', 'TipoDocumentoController');

        //Roles
        Route::resource('roles', 'RoleController');


        //Configuración
        Route::get('listar-configuracion', 'ComisionController@listar_configuracion');
        Route::get('validar-configuracion', 'ComisionController@validar_configuracion');


        //Dashboard
        Route::get('total-negocios', 'DashboardController@total_negocios');
        Route::get('total-productos', 'DashboardController@total_productos');
        Route::get('total-vendedores', 'DashboardController@total_vendedores');
        Route::get('total-categorias', 'DashboardController@total_categorias');
        Route::get('ventas-anuales', 'DashboardController@ventas_anuales');
        Route::get('ventas-mensuales', 'DashboardController@ventas_mensuales');
        Route::get('productos-random', 'DashboardController@productos_random');

         //Productos
         Route::resource('productos', 'ProductoController');

         //Categoria de Productos
         Route::resource('categoria_productos', 'CategoriaProductoController');

         //Negocios
         Route::resource('negocios', 'NegocioController');
        //Pedidos
        Route::resource('pedido_negocios', 'PedidoNegocioController');
        Route::get('search_detalle_pedido/{id}', 'PedidoNegocioController@search_detalle_pedido');
        Route::get('datos_cliente/{id}', 'PedidoNegocioController@datos_cliente');
        Route::get('datos_pedido/{id}', 'PedidoNegocioController@datos_pedido');
        Route::get('datos_combo/{id}', 'PedidoNegocioController@datos_combo');

        Route::resource('pedido_clientes', 'PedidoClienteController');



         Route::get('validar-negocio', 'NegocioController@validar_negocio');
         Route::get('position/{id}', 'NegocioController@position');

         //Combos
         Route::resource('combos', 'ComboController');
         Route::get('select-negocio', 'ComboController@select_negocio');
         Route::get('select-categoria-producto', 'ComboController@select_categoria_producto');
         Route::get('select-producto/{id_cat_producto}', 'ComboController@select_producto');
         Route::get('search-detalle-combo/{id}', 'ComboController@search_detalle_combo');
         Route::put('delete-detalle-combo/{id}', 'ComboController@delete_detalle_combo');


        //Cliente Negocios
        Route::resource('cliente_negocios', 'ClienteNegocioController');
        Route::get('search-negocio-producto/{producto}', 'ClienteNegocioController@search_negocio_producto');
        Route::get('search-negocio-categoria/{id}', 'ClienteNegocioController@search_negocio_categoria');



        //cliente pedidos

        Route::post('obtenerProductosNegocio', 'ClientePedidosController@obtenerProductosNegocio');
        Route::post('obtenerCombosNegocio', 'ClientePedidosController@obtenerCombosNegocio');
        Route::post('generarPedido', 'ClientePedidosController@generarPedido');
        Route::post('getCategoriasNegocios', 'ClientePedidosController@getCategoriasNegocios');
        Route::post('pago-electronico', 'ClientePedidosController@pago_electronico');

        Route::get('select_categoria', 'CategoriaProductoController@select_categoria');
        Route::get('select_categoria2', 'CategoriaProveedorController@select_categoria2');
        Route::get('select_categoria_negocio', 'NegocioController@select_categoria');
        Route::get('select_ciudad', 'NegocioController@select_ciudad');



        //Notificaciones

        Route::resource('notificaciones', 'NotificacionController');
        Route::get('canal-negocio', 'NotificacionController@canal_negocio');

        //Tarifas
        Route::post('valor-tarifa', 'TarifaController@valor_tarifa');


    });
});

//Categorias negocio
Route::post('getCategoriasNegocios', 'ClientePedidosController@getCategoriasNegocios');

//Ciudad
Route::resource('ciudads', 'CiudadController');


Route::get('prueba', 'ReporteController@prueba');

//pago electronico
Route::post('pago-electronico', 'PagoelectronicoController@pago_electronico');
Route::post('pago-electronico-tarjeta', 'PagoelectronicoController@pago_electronico_tarjeta');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();


});
