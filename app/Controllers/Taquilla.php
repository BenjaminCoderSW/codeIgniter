<?php 
namespace App\Controllers;

use CodeIgniter\Controller;

class Taquilla extends Controller{
    public function index()
    {
        $datos['cabecera'] = view('template/cabecera_taquilla');
        $datos['piepagina'] = view('template/piepagina');
        return view('taquilla/principal_taquilla',$datos);
    }
}