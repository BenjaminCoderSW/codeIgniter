<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Sala; 
use App\Models\Pelicula; 

// Controlador de Taquilla

class Taquilla extends Controller {
    public function gethorarios() {
        $salaModel = new Sala();
        $datos['salas'] = $salaModel->findAll(); // Obtener todas las salas

        $datos['cabecera'] = view('template/cabecera_taquilla');
        $datos['piepagina'] = view('template/piepagina');

        return view('taquilla/venta_ticket', $datos);
    }
    public function index()
    {
    $peliculaModel = new Pelicula();

    // Obtener todas las películas activas
    $peliculas_activas = $peliculaModel->where('estado_pelicula', 1)->findAll();

    // Configurar el paginador
    $pager = \Config\Services::pager();
    $page = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
    $perPage = 5; // Número de resultados por página
    $offset = ($page - 1) * $perPage;

    // Obtener las películas activas paginadas
    $query = $peliculaModel->where('estado_pelicula', 1)->orderBy('titulo_pelicula', 'ASC')->findAll($perPage, $offset);
    $total_peliculas = $peliculaModel->where('estado_pelicula', 1)->countAllResults(); // Contar todas las películas activas

    // Calcular el número total de páginas
    $total_pages = ceil($total_peliculas / $perPage);

    // Pasar los datos a la vista
    $datos['peliculas'] = $query;
    $datos['peliculas_activas'] = $peliculas_activas; // Agregar las películas activas
    $datos['total_pages'] = $total_pages;
    $datos['current_page'] = $page;

    $datos['cabecera'] = view('template/cabecera_taquilla');
    $datos['piepagina'] = view('template/piepagina');

    return view('taquilla/principal_taquilla', $datos);
    }

}