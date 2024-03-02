<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Usuarios::index');
$routes->get('usuarios', 'Usuarios::usuarios_view',['filter' => 'auth']);
$routes->get('usuarios/crear', 'Usuarios::crear_usuario_view',['filter' => 'auth']);
$routes->post('usuarios/guardar', 'Usuarios::guardar_usuario');
$routes->get('usuarios/borrar/(:num)', 'Usuarios::borrar_usuario/$1');
$routes->post('login', 'Usuarios::login');
$routes->get('dashboard', 'Usuarios::dashboard', ['filter' => 'auth']);
$routes->get('usuarios/editar/(:num)', 'Usuarios::editar/$1');
$routes->post('usuarios/actualizar', 'Usuarios::actualizar');