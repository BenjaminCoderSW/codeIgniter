<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// La diagonal es la parte que se agrega a la URL, Login es el controlador, index es la funcion 
//ruta para el login
$routes->get('/', 'Login::index');
//ruta para la lista de los usuarios
$routes->get('usuarios', 'Usuarios::usuarios_view',['filter' => 'auth']);
//ruta para la vista de crear un usuario
$routes->get('usuarios/crear', 'Usuarios::crear_usuario_view',['filter' => 'auth']);
//ruta para guardar un usuario
$routes->post('usuarios/guardar', 'Usuarios::guardar_usuario', ['filter' => 'auth']);
//ruta para borar un usuario
$routes->get('usuarios/borrar/(:num)', 'Usuarios::borrar_usuario/$1',['filter' => 'auth']);
//ruta para loggear un usuario
$routes->post('login', 'Login::loggeo');
//no me acuerdo, creo que no hace nada, solo era un ejemplo
$routes->get('dashboard', 'Usuarios::dashboard', ['filter' => 'auth']);
//ruta para la vista de editar con id
$routes->get('usuarios/editar/(:num)', 'Usuarios::editar/$1',['filter' => 'auth']);
//ruta para actualizar ese usuario
$routes->post('usuarios/actualizar', 'Usuarios::actualizar', ['filter' => 'auth']);
//ruta para taquilla
$routes->get('taquilla', 'Taquilla::index', ['filter' => 'auth']);
//ruta para salir de la sesión
$routes->get('salir', 'Login::logout');
//ruta para la vista del HOME
$routes->get('home', 'Home::index', ['filter' => 'auth']);
//ruta para la vista del de peliculas
$routes->get('peliculas', 'Peliculas::index', ['filter' => 'auth']);
