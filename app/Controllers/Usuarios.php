<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usuario;
class Usuarios extends Controller{

    public function index()
    {
        return view('principal/home');
    }

    public function usuarios_view()
    {
        $usuarios = new Usuario();
        $datos['usuarios'] = $usuarios->orderBy('id_usuario','ASC')->findAll();
        $datos['cabecera'] = view('template/cabecera');
        $datos['piepagina'] = view('template/piepagina');
        if (!session()->has('usuario_id')) {
            return view('usuarios/crud_usuarios', $datos);
        }
    }
    public function crear_usuario_view()
    {
        $datos['cabecera2'] = view('template/cabecera_form');
        $datos['piepagina'] = view('template/piepagina');
        return view('usuarios/insertar_usuario', $datos);
    }
    public function guardar_usuario()
    {
        $usuario = new Usuario();
        $nombre_usuario=$this->limpiar_cadena($this->request->getVar('nombre_usuario'));
        $password=$this->limpiar_cadena($this->request->getVar('password'));
        $tipo_usuario=$this->limpiar_cadena($this->request->getVar('tipo_usuario'));
        $estado_usuario=$this->limpiar_cadena($this->request->getVar('estado_usuario'));
        $confirmar_password =$this->limpiar_cadena( $this->request->getVar('confirmar_password'));
        $usuario_existente = $usuario->where('nombre_usuario', $nombre_usuario)->first();
        if ($usuario_existente) {
            $sesion = session();
            $sesion->setFlashdata("mensaje", "El nombre de usuario ya está en uso. Por favor, elige otro.");
            return redirect()->back()->withInput();
        }
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
        
            $password_encriptada = password_hash($password, PASSWORD_DEFAULT);
    
            $datos = [
                "nombre_usuario" => $nombre_usuario,
                "password" => $password_encriptada,
                "tipo_usuario" => $tipo_usuario,
                "estado_usuario" => $estado_usuario
            ];
            $usuario->insert($datos);    
            return $this->response->redirect(site_url('usuarios'));
    }
    private function coincidir_password(string $password, string $confirmar_password){
        
        if ($password != $confirmar_password) {
            return false;
        }else{
            return true;
        }
    }
    private function longitud_valida($nombre_usuario, $password)
    {
        if (strlen($nombre_usuario) < 4 || strlen($password) < 8) {
            return false;
        }
        return true;
    }
    private function longitud_nombre($nombre_usuario)
    {
        if (strlen($nombre_usuario) < 4) {
            return false;
        }
        return true;
    }

    private function es_valido($nombre_usuario, $password, $confirmar_password, $tipo_usuario, $estado_usuario)
    {
        if (empty($nombre_usuario) || empty($password) || empty($confirmar_password) || empty($tipo_usuario) || empty($estado_usuario)) {
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
        $usuario->where('id_usuario',$id_usuario)->delete($id_usuario);
        return $this->response->redirect(site_url('usuarios'));
    }
    public function login()
    {
        // Obtener los datos del formulario
        $nombre_usuario = $this->request->getPost('nombre_usuario');
        $password = $this->request->getPost('password');
    
        // Cargar el modelo de Usuario
        $usuarioModel = new Usuario();
    
        // Buscar el usuario por nombre de usuario
        $usuario = $usuarioModel->where('nombre_usuario', $nombre_usuario)->first();
    
        if ($usuario) {
            // Verificar la contraseña
            if (password_verify($password, $usuario['password'])) {
                // Contraseña válida, establecer la sesión del usuario
                session()->set('id_usuario', $usuario['id_usuario']); // Aquí establecemos la sesión del usuario
    
                // Redirigir a la página de inicio después del inicio de sesión exitoso
                return redirect()->to('usuarios/'); // Ruta correcta
            } else {
                // Contraseña incorrecta, redirigir al formulario de inicio de sesión con un mensaje de error
                $session = session();
                $session->setFlashdata("mensaje", "Contraseña Incorrecta");
                return redirect()->back()->withInput();
            }
        } else {
            // Usuario no encontrado, redirigir al formulario de inicio de sesión con un mensaje de error
            $session = session();
            $session->setFlashdata("mensaje", "Usuario no encontrado");
            return redirect()->back()->withInput();
        }
    }    
    public function actualizar($id_usuario = null){
        $usuario = new Usuario();
        $id = $this->request->getVar('id'); // Obtener el ID del usuario a actualizar
        $nombre_usuario = $this->limpiar_cadena($this->request->getVar('nombre_usuario'));
        $password = $this->limpiar_cadena($this->request->getVar('password'));
        $tipo_usuario = $this->limpiar_cadena($this->request->getVar('tipo_usuario'));
        $estado_usuario = $this->limpiar_cadena($this->request->getVar('estado_usuario'));
        $confirmar_password = $this->limpiar_cadena($this->request->getVar('confirmar_password'));
        
        // Verificar la longitud y la complejidad de la contraseña
        if (!$this->longitud_nombre($nombre_usuario)) {
            $sesion = session();
            $sesion->setFlashdata("mensaje", "El nombre de usuario debe tener mínimo 4 caracteres y la contraseña debe tener mínimo 8 caracteres.");
            return redirect()->back()->withInput();
        }
    
        // Encriptar la contraseña antes de actualizar si se proporciona una nueva contraseña
        if (!empty($password) && !empty($confirmar_password) && $password === $confirmar_password) {
            // Verificar si las contraseñas coinciden
            if (!$this->coincidir_password($password, $confirmar_password)) {
                $sesion = session();
                $sesion->setFlashdata("mensaje","Las contraseñas no coinciden. Por favor, inténtalo de nuevo.");
                return redirect()->back()->withInput();
            }
            if (!$this->contrasena_fuerte($password)) {
                $sesion = session();
                $sesion->setFlashdata("mensaje", "La contraseña debe contener al menos un número, una letra minúscula, una letra mayúscula y un carácter especial.");
                return redirect()->back()->withInput();
            }
            $password_encriptada = password_hash($password, PASSWORD_DEFAULT);

        } else {
            // Mantener la contraseña actual si no se proporciona una nueva contraseña
            $usuario_actual = $usuario->find($id); // Obtener el usuario actual desde la base de datos
            $password_encriptada = $usuario_actual['password'];
        }
    
        // Construir el array de datos a actualizar
        $datos = [
            "nombre_usuario" => $nombre_usuario,
            "tipo_usuario" => $tipo_usuario,
            "estado_usuario" => $estado_usuario
        ];
    
        // Si hay una nueva contraseña, agregarla al array de datos
        if (!empty($password_encriptada)) {
            $datos["password"] = $password_encriptada;
        }
    
        // Actualizar el usuario con la cláusula "where" para especificar qué fila actualizar
        $usuario->update($id, $datos);
    
        return $this->response->redirect(site_url('usuarios'));
    }
    

    public function editar($id_usuario=null){
        $usuario = new Usuario();
        $datos['usuario']= $usuario->where('id_usuario',$id_usuario)->first();
        
        // Verificar si existe un usuario con el ID proporcionado
        if (!$datos['usuario']) {
            // Manejar el caso en el que no se encuentre un usuario con el ID dado
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }
        
        // Desencriptar la contraseña si está encriptada
        if (!empty($datos['usuario']['password'])) {
            $datos['usuario']['password'] = ''; // Limpiar la contraseña para evitar su visualización
        }
    
        $datos['cabecera2'] = view('template/cabecera_form');
        $datos['piepagina'] = view('template/piepagina');
        return view("usuarios/actualizar_usuarios", $datos);
    }
    
    
}