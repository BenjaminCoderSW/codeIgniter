<?php 
namespace App\Controllers;

use CodeIgniter\Controller;

class Taquilla extends Controller{
    public function index()
    {
        return view('taquilla/principal_taquilla');
    }
}