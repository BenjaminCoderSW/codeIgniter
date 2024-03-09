<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// La diagonal es la parte que se agrega a la URL, Login es el controlador, index es la funcion 
$routes->get('/', 'Login::index');
$routes->get('usuarios', 'Usuarios::usuarios_view',['filter' => 'auth']);
$routes->get('usuarios/crear', 'Usuarios::crear_usuario_view',['filter' => 'auth']);
$routes->post('usuarios/guardar', 'Usuarios::guardar_usuario', ['filter' => 'auth']);
$routes->get('usuarios/borrar/(:num)', 'Usuarios::borrar_usuario/$1',['filter' => 'auth']);
$routes->post('login', 'Login::loggeo');
$routes->get('dashboard', 'Usuarios::dashboard', ['filter' => 'auth']);
$routes->get('usuarios/editar/(:num)', 'Usuarios::editar/$1',['filter' => 'auth']);
$routes->post('usuarios/actualizar', 'Usuarios::actualizar', ['filter' => 'auth']);
$routes->get('taquilla', 'Taquilla::index');
$routes->get('salir', 'Login::logout');
