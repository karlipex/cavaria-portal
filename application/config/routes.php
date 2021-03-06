<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'menu';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//URL MENU
$route['/']='menu/index';
$route['menu-principal']='menu/principal';
$route['logout']='menu/logout';
$route['cambiar-password']='menu/cambioPassword';
$route['error']='menu/error';

//URL CONTACTO
$route['menu-contactos']='contactos/index';
$route['nuevo-contacto']='contactos/nuevo';
$route['nuevo-contacto-facebook']='externos/getFacebook';
$route['llenar-contactos']='contactos/llenar';
$route['detalle-contacto/(:num)']='contactos/detalle/$1';
$route['modifica-contacto']='contactos/update';
$route['eliminar-contacto/(:num)']='contactos/eliminar/$1';
$route['reporte-contacto/(:num)']='contactos/reporte/$1';
$route['get-contacto/(:num)']='contactos/getContacto/$1';
$route['siguiente-contacto']='contactos/siguiente';
$route['llenar-contactos-diarios']='contactos/llenar2';
$route['llenar-contactos-diarios-llamados']='contactos/llenar3';
$route['llenar-contactos-diarios-agendados']='contactos/llenar4';
$route['trae-contactos-filtro']='contactos/traeContactos1';
$route['trae-contactados-filtro']='contactos/traeContactados1';
$route['trae-agendados-filtro']='contactos/traeAgendados1';
$route['trae-llamados-filtro']='contactos/traeLlamados1';
$route['carga-contactos-antiguos']='contactos/getAntiguo';
$route['volver/(:num)']='contactos/volver/$1';
$route['info-por-cape']='contactos/infoCape';
$route['info-por-cape-diario']='contactos/infoCape2';
//URL PROVINCIAS
$route['trae-regiones']='regiones/getRegiones';
$route['trae-provincias']='provincias/traeProvincias';
$route['trae-comunas']='comunas/traeComunas';

//URL LLAMADAS
$route['nueva-llamada']='llamadas/nueva';
$route['trae-llamadas/(:num)']='llamadas/traeLlamadas/$1';

//URL TIEMPOS
$route['tiempo-fuera']='tiempos/insertTime';
$route['trae-tiempos-usuario']='tiempos/traeTiempoCape';
$route['trae-tiempos-usuario-diario']='tiempos/traeTiempoCape2';

//URL EMPLEADOS
$route['menu-empleados']='empleados/menu';
$route['nuevo-empleado']='empleados/nuevo';
$route['ficha-empleado/(:num)']='empleados/ficha/$1';
$route['exportar-lista-empleados']='empleados/excel';

//URL MENU ADMINISTRACIÓN
$route['trae-contactos-cpanel']='contactos/traeContactos';
