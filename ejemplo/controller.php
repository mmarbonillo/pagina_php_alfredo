<?php
include("view.php");
include("models/user.php");

class Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * Función principal del controlador. Todas las peticiones pasan por aquí
     */
    public function main() {
        session_start();
        if (isset($_REQUEST["do"])) {   // La variable "do" controla el estado de la aplicación
            $do = $_REQUEST["do"];
        } else {
            $do = "showFormLogin";      // Estado por defecto
        }
        $this->$do();   // Ejecuta la función con el nombre $do. 
                        // P. ej: si $do vale "showFormLogin", ejecuta $this->showFormLogin()
    }

    /**
     * Muestra formulario de login
     */
    private function showFormLogin()
    {
        $data["mensaje"] = (isset($_REQUEST["mensaje"]) ? $_REQUEST["mensaje"] : null);
        View::show("formLogin", $data);
    }

    /**
     * Procesa formulario de login
     */
    private function processLogin()
    {
        $username = $_REQUEST['user'];
        $pass = $_REQUEST['password'];
        $userOk = $this->user->getForUsername($username, $pass);
        if ($userOk) {
            View::redirect("mainMenu");
        } else {
            $data["mensaje"] = "Nombre de usuario o contraseña incorrecto";
            View::redirect("showFormLogin", $data);
        }
    }

    /**
     * Muestra la vista del menú principal (distinto según el tipo de usuario)
     */
    private function mainMenu()
    {
        if (isset($_SESSION["id"]) && $_SESSION["tipo"] == 0) {
            // Tipo de usuario 0 (administador)
            $data["usersList"] = $this->user->getAll();
            View::show("menuAdmin", $data);
        } else if (isset($_SESSION["id"]) && $_SESSION["tipo"] == 1) {
            // Tipo de usuario 1 (usuario normal)
            View::show("menuUser");
        } else {
            // Tipo de usuario desconocido O no se ha hecho login
            $data["mensaje"] = "No tienes permiso para hacer esto";
            View::redirect("showFormLogin", $data);
        }
    }

    /**
     * Cierra la sesión y destruye las variables
     */
    private function closeSession()
    {
        session_destroy();
        $data["mensaje"] = "Sesión cerrada con éxito";
        View::redirect("showFormLogin", $data);
    }

    /**
     * Muestra formulario de creación de usuarios
     */
    private function formCreateUser()
    {
        if (isset($_SESSION["id"]) && $_SESSION["tipo"] == 0) {
            $data["userType"] = 0;
        } else {
            $data["userType"] = 1;
        }
        $data["mensaje"] = (isset($_REQUEST["mensaje"]) ? $_REQUEST["mensaje"] : null);
        View::show("createUser", $data);
    }

    /**
     * Procesa el formulario de creación de usuarios
     */
    private function createUser()
    {
        $data['user'] = $_REQUEST['user'];
        $data['pass'] = $_REQUEST['pass'];
        $data['email'] = $_REQUEST['email'];
        if (isset($_REQUEST['tipo']))
            $data['tipo'] = $_REQUEST['tipo'];
        else
            $data['tipo'] = 1;
        $resultInsert = $this->user->insert($data);
        $data = null;
        if ($resultInsert == 1) {
            $data["mensaje"] = "Usuario insertado con éxito";
            View::redirect("formCreateUser", $data);
        } else {

            $data["mensaje"] = "Error al insertar";
            View::redirect("formCreateUser", $data);
        }
    }

    /**
     * Muestra el formulario de actualización de usuarios
     */
    private function formUpdateUser()
    {
        if (isset($_SESSION["id"]) && $_SESSION["tipo"] == 0) {
            echo "Formulario modificar usuario - En construcción";
        }
    }

    /**
     * Procesa el formulario de actualización de usuarios
     */
    private function updateUser()
    {
        echo "Modificar usuario - En construcción";
    }

    /**
     * Elimina un usuario
     */
    private function deleteUser()
    {
        $resultDelete = $this->user->delete($_REQUEST['user']);
        if ($resultDelete) {
            $data["mensaje"] = "Usuario borrado con éxito";
        } else {
            $data["mensaje"] = "Error al borrar";
        }
        View::redirect("mainMenu", $data);
    }

    /**
     * Muestra una vista de error
     */
    private function error()
    {
        View::error();
    }
} // class
