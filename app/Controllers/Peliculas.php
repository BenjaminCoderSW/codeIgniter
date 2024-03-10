<?php 
namespace App\Controllers;

use CodeIgniter\Controller;

class Peliculas extends Controller{
    public function index()
    {
        return view('peliculas/principal_peliculas');
    }
}