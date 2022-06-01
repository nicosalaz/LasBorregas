<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// INDEX
$routes->get('/', 'Home::index');
//LOGICA DE LOGIN Y LOGOUT
$routes->post('/auth/login', 'AuthController::login');
$routes->get('/auth/logout', 'AuthController::logout');
//LOGICA DE CLIENTES
$routes->get('/clientes', 'ApiController::readClientes');
$routes->get('/clientes/eliminar/(:num)', 'ApiController::deleteCliente/$1');
$routes->post('/clientes/agregar', 'ApiController::addCliente');
$routes->get('/clientes/editar/(:num)', 'ApiController::editPlantilla/$1');
$routes->post('/clientes/editarCliente/(:num)', 'ApiController::editCliente/$1');
$routes->get('/clientes/getVentaCliente/(:num)', 'ApiController::getVentaCliente/$1');
$routes->get('/clientes/getDetalleVenta/(:num)', 'ApiController::getDetalleVenta/$1');
$routes->post('/clientes/venta-cliente', 'ApiController::ventaCliente');
//LOGICA DE VENTAS
$routes->get('/venta', 'ApiController::readVentas');
$routes->get('/venta/eliminar/(:num)', 'ApiController::deleteVenta/$1');
$routes->get('/venta/agregar', 'ApiController::addPlantillaVenta');
$routes->post('/venta/agregarVenta', 'ApiController::addVentas');
$routes->get('/venta/editar/(:num)', 'ApiController::editPlantillaVenta/$1');
$routes->post('/venta/editarVenta/(:num)', 'ApiController::editVenta/$1');
//LOGICA PARA BLOQUE
$routes->get('/bloque', 'ApiController::readBloque');
$routes->get('/bloque/eliminar/(:num)', 'ApiController::deleteBloque/$1');
$routes->post('/bloque/agregar', 'ApiController::addBloque');
$routes->get('/bloque/editar/(:num)', 'ApiController::editPlantillaBloque/$1');
$routes->post('/bloque/editarBloque/(:num)', 'ApiController::editBloque/$1');
$routes->get('/bloque/plantillaAumentarExistencia/(:num)', 'ApiController::plantillaAumentarExistencia/$1');
$routes->post('/bloque/aumentarExistencia/(:num)', 'ApiController::aumentarExistencia/$1');
// LOGICA EMPLEADOS
$routes->get('/empleados', 'ApiController::getPlantillaEmpleados');
$routes->get('/empleados/add-empleado', 'ApiController::getPlantillaAddEmpleado');
$routes->post('/empleados/add', 'ApiController::addEmpleado');
$routes->get('/empleados/delete/(:num)', 'ApiController::eliminarEmpleado/$1');
$routes->get('/empleados/plantillaEditEmpleado/(:num)', 'ApiController::plantillaEditEmpleado/$1');
$routes->get('/empleados/agregar-venta', 'ApiController::plantillaAddVentaEmpleado');
$routes->post('/empleados/add-venta', 'ApiController::addVentaEmpleado');
$routes->post('/empleados/edit-empleado/(:num)', 'ApiController::editEmpleado/$1');
//LOGICA PARA REPORTES
$routes->get('/reportes', 'ApiController::getReportesPlantilla');
$routes->get('/reportes/bloques_vendidos_ordenados', 'ApiController::getReporteBloquesVendidos');
$routes->get('/reportes/clientes_ventas_ordenadas', 'ApiController::getReporteClientesVentas');
$routes->get('/reportes/ventas_por_fecha', 'ApiController::getReporteVentasPorFecha');
$routes->get('/reportes/ventas_por_cliente', 'ApiController::getReporteVentasPorCliente');
// LAS DEMAS RUTAS QUE SE CREEN
$routes->get('/vistas/(:any)', 'Home::view/$1');
$routes->get('/register/(:any)', 'Home::viewRegister/$1');
$routes->get('/home', 'Home::home');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
