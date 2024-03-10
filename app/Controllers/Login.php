<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usuario;
class Login extends Controller{

    public function index()
    {
        return view('principal/login');
    }

    public function loggeo()
    {
        $usuarioModel = new Usuario();
        $nombre_usuario = $this->request->getVar('nombre_usuario');
        $password = $this->request->getVar('password');
    
        $usuario = $usuarioModel->where('nombre_usuario', $nombre_usuario)->first();
    
        if ($usuario) {
            $contrasenia = $this->desencriptar($usuario['password'], 'Hola123.');    
            if ($contrasenia === $password) { 
    
                if ($usuario['estado_usuario'] == 'Activo') {
    
                    session()->set('id_usuario', $usuario['id_usuario']);
                    session()->set('tipo_usuario', $usuario['tipo_usuario']);
                    session()->set('estado_usuario', $usuario['estado_usuario']);
    
                    if ($usuario['tipo_usuario'] == 'Administrador') {
                        return redirect()->to('home/');
                    } elseif ($usuario['tipo_usuario'] == 'Taquillero') {
                        return redirect()->to('taquilla');
                    }
                } else {
                    $sesion = session();
                    $sesion->setFlashdata("mensaje", "Tu cuenta está inactiva");
                    return redirect()->back()->withInput();
                }
            } else {
                $sesion = session();
                $sesion->setFlashdata("mensaje", "Contraseña Incorrecta");
                return redirect()->back()->withInput();
            }
        } else {
            $sesion = session();
            $sesion->setFlashdata("mensaje", "Usuario no encontrado");
            return redirect()->back()->withInput();
        }
    }

    public function desencriptar($password, $clave) {
        $datos = base64_decode($password);
        $iv = substr($datos, 0, 16); 
        $password = substr($datos, 16);
        $password = openssl_decrypt($password, 'aes-256-cbc', $clave, 0, $iv);
        return $password;
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}