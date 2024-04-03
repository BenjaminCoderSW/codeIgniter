<?php 

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Sala; 
use App\Models\Pelicula; 
use App\Models\Usuario; 

class Taquilla extends Controller {
    public function gethorarios() {
        $salaModel = new Sala();
        $datos['salas'] = $salaModel->findAll(); // Obtener todas las salas

        $datos['cabecera'] = view('template/cabecera_taquilla');
        $datos['piepagina'] = view('template/piepagina');

        return view('taquilla/venta_ticket', $datos);
    }

    public function index() {
        $peliculaModel = new Pelicula();

        // Obtener todas las películas activas
        $peliculas_activas = $peliculaModel->where('estado_pelicula', 1)->findAll();

        $datos['peliculas_activas'] = $peliculas_activas;
        $datos['cabecera'] = view('template/cabecera_taquilla');
        $datos['piepagina'] = view('template/piepagina');

        return view('taquilla/principal_taquilla', $datos);
    }

    public function filtrarPeliculas($idPelicula) {
        $peliculaModel = new Pelicula();
        $pelicula = $peliculaModel->find($idPelicula);

        // Devolver los detalles de la película en formato JSON
        return $this->response->setJSON($pelicula);
    }

    public function vista_comprar_boletos($id_pelicula=null){
        // Verificar si hay un usuario en sesión y obtener su nombre
        $nombreUsuario = session()->get('nombre_usuario');

        $salaModel = new Sala();
        
        $datos['salas'] = $salaModel->findAll(); 
        
        // Crea una nueva instancia de la clase Pelicula
        $pelicula = new Pelicula();
        // Obtiene los datos de una película específica utilizando el ID proporcionado como parámetro
        // y los asigna a la variable $datos['pelicula']
        $datos['pelicula']= $pelicula->where('id_pelicula',$id_pelicula)->first();
        // Asigna vistas de cabecera y pie de página a las variables $datos['cabecera'] y $datos['piepagina'], respectivamente.
        $datos['cabecera'] = view('template/cabecera_comprar_boletos');
        $datos['piepagina'] = view('template/piepagina');

        // Pasar el nombre de usuario a la vista
        $datos['nombre_usuario'] = $nombreUsuario;

        // Devuelve una vista llamada "peliculas/actualizar_peliculas" con los datos obtenidos
        return view("taquilla/venta_ticket", $datos);
    }
    
}
