<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Pelicula;
class Peliculas extends Controller{


    public function index()
    {
        $pelicula = new Pelicula();
        $datos['cabecera'] = view('template/cabecera');
        $datos['piepagina'] = view('template/piepagina');

        $filtro_genero = $this->request->getGet('genero');
        $filtro_estado_pelicula = $this->request->getGet('estado_pelicula');
        $filtro_titulo_pelicula = $this->limpiar_cadena($this->request->getGet('u'));

        $query = $pelicula; 
        if ($filtro_genero && $filtro_genero != 'genero') {
            $query = $query->where('genero', $filtro_genero);
        }
        if ($filtro_estado_pelicula && $filtro_estado_pelicula != 'estado_pelicula') {
            $query = $query->where('estado_pelicula', $filtro_estado_pelicula);
        }
        if ($filtro_titulo_pelicula) {
            $query = $query->like('titulo_pelicula', $filtro_titulo_pelicula);
        }
        $total_peliculas = count($query->findAll());

        $peliculas_por_pagina = 5;

        $total_pages = ceil($total_peliculas / $peliculas_por_pagina);

        $current_page = $this->request->getVar('page') ?? 1;

        $offset = ($current_page - 1) * $peliculas_por_pagina;

        $query = $pelicula;
        if ($filtro_genero && $filtro_genero != 'genero') {
            $query = $query->where('genero', $filtro_genero);
        }
        if ($filtro_estado_pelicula && $filtro_estado_pelicula != 'estado_pelicula') {
            $query = $query->where('estado_pelicula', $filtro_estado_pelicula);
        }
        if ($filtro_titulo_pelicula) {
            $query = $query->like('titulo_pelicula', $filtro_titulo_pelicula);
        }
        $datos['peliculas'] = $query->orderBy('titulo_pelicula', 'ASC')->findAll($peliculas_por_pagina, $offset);

        $datos['total_pages'] = $total_pages;
        $datos['current_page'] = $current_page;

        return view('peliculas/principal_peliculas', $datos);
    }



    public function crear_pelicula_view()
    {
        $datos['cabecera2'] = view('template/cabecera_form');
        $datos['piepagina'] = view('template/piepagina');
        return view('peliculas/insertar_pelicula', $datos);
    }
    public function guardar_pelicula()
    {
        $pelicula = new Pelicula();
        $titulo_pelicula=$this->limpiar_cadena($this->request->getVar('titulo_pelicula'));
        $duracion=$this->limpiar_cadena($this->request->getVar('duracion'));
        $sinopsis=$this->limpiar_cadena($this->request->getVar('sinopsis'));
        $genero=$this->limpiar_cadena($this->request->getVar('genero'));
        $imagen =$this->request->getFile('imagen');
        $estado_pelicula=$this->limpiar_cadena($this->request->getVar('estado_pelicula'));
        $precio=$this->limpiar_cadena($this->request->getVar('precio'));
        $pelicula_existente = $pelicula->where('titulo_pelicula', $titulo_pelicula)->first();
        $validacion =$this->validate([
            'imagen'=>
                'uploaded[imagen]',
                'mime_in[imagen,image/jpg,image/jpeg,image/png,image/webp]',
                'max_size[imagen,1024]',
        ]);
        if(!$validacion){
            $session = session();
            $session->setFlashdata("mensaje","Información inválida. El archivo debe ser una imágen. Y los campos son Obligatorios");
            return redirect()->back()->withInput();
        }
        if ($pelicula_existente) {
            $sesion = session();
            $sesion->setFlashdata("mensaje", "La película ya existe");
            return redirect()->back()->withInput();
        }
        if (!$this->longitud_valida($titulo_pelicula)) {
            $sesion = session();
            $sesion->setFlashdata("mensaje", "El nombre de usuario debe tener mínimo 4 caracteres y la contraseña debe tener mínimo 8 caracteres.");
            return redirect()->back()->withInput();
        }
        if (!$this->es_valido($titulo_pelicula, $duracion, $sinopsis, $genero, $precio, $estado_pelicula)) {
            $sesion = session();
            $sesion->setFlashdata("mensaje", "Por favor, completa todos los campos obligatorios.");
            return redirect()->back()->withInput();
        }
            $nuevoNombre=$imagen->getRandomName();
            $imagen->move("../public/uploads/", $nuevoNombre);

            $datos = [
                "titulo_pelicula" => $titulo_pelicula,
                "duracion" => $duracion,
                "sinopsis" => $sinopsis,
                "genero" => $genero,
                "imagen" => $nuevoNombre,
                "precio" => $precio,
                "estado_pelicula" => $estado_pelicula,
            ];
            $pelicula->insert($datos);    
            //return $this->response->redirect(site_url('usuarios'));
    }
    private function coincidir_password(string $password, string $confirmar_password){
        
        if ($password != $confirmar_password) {
            return false;
        }else{
            return true;
        }
    }
    private function longitud_valida($nombre_usuario)
    {
        if (strlen($nombre_usuario) <= 4 ) {
            return false;
        }
        return true;
    }
    private function longitud_nombre($nombre_usuario)
    {
        if (strlen($nombre_usuario) <= 4 || strlen($nombre_usuario)<=1) {
            return false;
        }
        return true;
    }

    private function es_valido($titulo_pelicula, $duracion, $sinopsis, $genero, $precio, $estado_pelicula)
    {
        if (empty($titulo_pelicula) || empty($duracion) || empty($sinopsis) || empty($genero) || empty($precio) || empty($estado_pelicula)) {
            return false;
        }
        return true;
    }
    private function contrasena_fuerte($password)
    {
        $patron = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()-_+=])[0-9a-zA-Z!@#$%^&*()-_+=]{8,}$/';
        if (!preg_match($patron, $password)) {
            return false;
        }
        return true;
    }
    function limpiar_cadena($cadena){
        $cadena=trim($cadena);
        $cadena=stripslashes($cadena);
        $cadena=str_ireplace("<script>", "", $cadena);
        $cadena=str_ireplace("</script>", "", $cadena);
        $cadena=str_ireplace("<script src", "", $cadena);
        $cadena=str_ireplace("<script type=", "", $cadena);
        $cadena=str_ireplace("!DOCTYPE html>", "", $cadena);
        $cadena=str_ireplace("SELECT * FROM", "", $cadena);
        $cadena=str_ireplace("DELETE FROM", "", $cadena);
        $cadena=str_ireplace("INSERT INTO", "", $cadena);
        $cadena=str_ireplace("DROP TABLE", "", $cadena);
        $cadena=str_ireplace("DROP DATABASE", "", $cadena);
        $cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
        $cadena=str_ireplace("SHOW TABLES;", "", $cadena);
        $cadena=str_ireplace("SHOW DATABASES;", "", $cadena);
        $cadena=str_ireplace("<?php", "", $cadena);
        $cadena=str_ireplace("?>", "", $cadena);
        $cadena=str_ireplace("--", "", $cadena);
        $cadena=str_ireplace("^", "", $cadena);
        $cadena=str_ireplace("<", "", $cadena);
        $cadena=str_ireplace("[", "", $cadena);
        $cadena=str_ireplace("]", "", $cadena);
        $cadena=str_ireplace("==", "", $cadena);
        $cadena=str_ireplace(";", "", $cadena);
        $cadena=str_ireplace("::", "", $cadena);
        $cadena=trim($cadena);
        $cadena=stripslashes($cadena);
        return $cadena;
    }
    public function borrar_usuario($id_usuario=null){
        $usuario = new Usuario();
        $datos=$usuario->where('id_usuario',$id_usuario)->first();
        if($datos['nombre_usuario']==='Tigger'){
            $sesion = session();
            $sesion->setFlashdata("mensaje", "Este Usuario no se puede eliminar.");
            return redirect()->back()->withInput();
        }
        $usuario->where('id_usuario',$id_usuario)->delete($id_usuario);
        return $this->response->redirect(site_url('usuarios'));
    }
    


  
    public function actualizar($id_usuario = null){
        $usuario = new Usuario();
        $id = $this->request->getVar('id'); 
        $nombre_usuario=$this->limpiar_cadena($this->request->getVar('nombre_usuario'));
        $password=$this->limpiar_cadena($this->request->getVar('password'));
        $tipo_usuario=$this->limpiar_cadena($this->request->getVar('tipo_usuario'));
        $estado_usuario=$this->limpiar_cadena($this->request->getVar('estado_usuario'));
        $confirmar_password =$this->limpiar_cadena( $this->request->getVar('confirmar_password'));
        //$usuario_existente = $usuario->where('nombre_usuario', $nombre_usuario)->first();
        
        if (!$this->longitud_valida($nombre_usuario, $password)) {
            $sesion = session();
            $sesion->setFlashdata("mensaje", "El nombre de usuario debe tener mínimo 4 caracteres y la contraseña debe tener mínimo 8 caracteres.");
            return redirect()->back()->withInput();
        }
        if (!$this->contrasena_fuerte($password)) {
            $sesion = session();
            $sesion->setFlashdata("mensaje", "La contraseña debe contener al menos un número, una letra minúscula, una letra mayúscula y un carácter especial.");
            return redirect()->back()->withInput();
        }
        if (!$this->es_valido($nombre_usuario, $password, $confirmar_password, $tipo_usuario, $estado_usuario)) {
            $sesion = session();
            $sesion->setFlashdata("mensaje", "Por favor, completa todos los campos obligatorios.");
            return redirect()->back()->withInput();
        }
        if (!$this->coincidir_password($password,$confirmar_password)) {
            $sesion = session();
            $sesion->setFlashdata("mensaje","Las contraseñas no coinciden. Por favor, inténtalo de nuevo.");
            return redirect()->back()->withInput();
        }
        
            $password_encriptada = $this->encriptar($password, 'Hola123.');

            $datos = [
                "nombre_usuario" => $nombre_usuario,
                "password" => $password_encriptada,
                "tipo_usuario" => $tipo_usuario,
                "estado_usuario" => $estado_usuario
            ];
    
        $usuario->update($id, $datos);
    
        return $this->response->redirect(site_url('usuarios'));
    }
    
    

    public function editar($id_usuario=null){
        $usuario = new Usuario();
        $datos['usuario']= $usuario->where('id_usuario',$id_usuario)->first();
        
        if (!$datos['usuario']) {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }
        
        $datos['usuario']['password'] = $this->desencriptar($datos['usuario']['password'], 'Hola123.');
        
        $datos['cabecera2'] = view('template/cabecera_form');
        $datos['piepagina'] = view('template/piepagina');
        
        return view("usuarios/actualizar_usuarios", $datos);
    }
    
    
    public function encriptar($password, $clave) {
        $iv = random_bytes(16); 
        $texto_encriptado = openssl_encrypt($password, 'aes-256-cbc', $clave, 0, $iv);
        return base64_encode($iv . $texto_encriptado); 
    }
    
    public function desencriptar($password, $clave) {
        $datos = base64_decode($password);
        $iv = substr($datos, 0, 16); 
        $password = substr($datos, 16);
        $password = openssl_decrypt($password, 'aes-256-cbc', $clave, 0, $iv);
        return $password;
    }
}