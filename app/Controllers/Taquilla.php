<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
// Controlador de Taquilla

class Taquilla extends Controller{
    //metodo de la vista principal
    public function index()
    {
        //hacemo sun arreglo para mandarle datos a la vista
        $datos['cabecera'] = view('template/cabecera_taquilla');
        $datos['piepagina'] = view('template/piepagina');
        //retornamos la vista y mandamos el arreglo
        return view('taquilla/principal_taquilla',$datos);
    }
}