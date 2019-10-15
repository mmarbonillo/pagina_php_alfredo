<?php
include("view.php");
include("models/user.php");

class Controller
{
    protected $user;

    public function __construct() {
        $this->user = new User();
    }

    /**
     * Función principal del controlador. Todas las peticiones pasan por aquí
     */
    public function main() {
        if (isset($_REQUEST["opc"])) {   // La variable "opc" controla el estado de la aplicación
            $opc = $_REQUEST["opc"];
        } else {
            //COMPROBAR SESION INICIADA
            if(Security::getId() != -1):
                $opc = "mainMenu";
            else:
                $opc = "showFormLogin";      // Estado por defecto
            endif;
        }
        $this->$opc();   // Ejecuta la función con el nombre $do. 
                        // P. ej: si $opc vale "showFormLogin", ejecuta $this->showFormLogin()
    }

    /**
     * Muestra formulario de login
     */
    private function showFormLogin() {
        $data["mensaje"] = (isset($_REQUEST["mensaje"]) ? $_REQUEST["mensaje"] : null);
        View::show("formLogin", $data);
    }

    /**
     * Procesa formulario de login
     */
    private function processLogin() {
        $username = $_REQUEST['username'];
        $passwd = $_REQUEST['passwd'];
        $userOk = $this->user->getForUsername($username, $passwd);
        if ($userOk) {
            View::redirect("mainMenu");
        } else {
            $data["mensaje"] = "Nombre de usuario o contraseña incorrecto";
            View::redirect("showFormLogin", $data);
        }
    }

    private function processSignIn() {
        //Compruebo que la sesión no esté iniciada para que ningún usuario pueda registrar nuevos usuarios
        if(!Security::isSessionOpen()):
            $data['username'] = $_REQUEST['username'];
            $data['surnames'] = $_REQUEST['surnames'];
            $data['name'] = $_REQUEST['name'];
            $data['email'] = $_REQUEST['email'];
            $data['type'] = 1;
            if($_REQUEST["passwd"] == $_REQUEST["passwd2"]):
                $data['passwd'] = $_REQUEST['passwd'];
                $resultInsert = $this->user->insert($data);
                $data = null;
                if ($resultInsert == 1):
                    $data["mensaje"] = "Te has registrado con éxito. Prueba a entrar :)";
                    View::redirect("showFormLogin", $data);
                else:
                    $data["mensaje"] = "Error al registrarte";
                    View::redirect("showFormLogin", $data);
                endif;
            else:
                $data["mensaje"] = "Las contraseñas no coinciden";
                View::redirect("showFormLogin", $data);
            endif;
        else:
            $data["mensaje"] = "No tienes permiso para hacer esto";
            View::redirect("mainMenu", $data);
        endif;
    }

    /**
     * Muestra la vista del menú principal (distinto según el tipo de usuario)
     */
    private function mainMenu() {
        //Creadas en el Modelo
        if (Security::getType() == 0) {
            // Tipo de usuario 0 (administador)
            $data["usersData"] = $this->user->getAll();
            $data["userAdmin"] = $this->user->getAllFromOneUser($_SESSION["id"]);
            View::show("menuAdmin", $data);
        } else if (Security::getType() == 1) {
            // Tipo de usuario 1 (usuario normal)
            $data["userData"] = $this->user->getAllFromOneUser($_SESSION["id"]);
            View::show("menuUser", $data);
        } else {
            // Tipo de usuario desconocido O no se ha hecho login
            $data["mensaje"] = "No tienes permiso para hacer esto";
            View::redirect("showFormLogin", $data);
        }
    }

    /**
     * Cierra la sesión y destruye las variables
     */
    private function closeSession() {
        //Compruebo por si el usuario intenta acceder a donde no debe
        if(Security::isSessionOpen()):
            $data["mensaje"] = "Has cerrado tu sesión";
            Security::closeSession();
            View::redirect("showFormLogin", $data);
        else:
            $data["mensaje"] = "No tienes permiso para acceder a esa página.";
            View::redirect("showFormLogin", $data);
        endif;
    }

    /**
     * Muestra formulario de creación de usuarios
     */
    private function formCreateUser() {
        if(Security::getType() == 0):
            $data["userType"] = 0;
        else:
            $data["userType"] = 1;
        endif;
        $data["mensaje"] = (isset($_REQUEST["mensaje"]) ? $_REQUEST["mensaje"] : null);
        View::show("formCreateUser", $data);
    }

    /**
     * Procesa el formulario de creación de usuarios
     */
    private function processCreateUser() {
        if(Security::isSessionOpen() && Security::getType() == 0):
            $data['username'] = $_REQUEST['username'];
            $data['passwd'] = $_REQUEST['passwd'];
            $data['surnames'] = $_REQUEST['surnames'];
            $data['name'] = $_REQUEST['name'];
            $data['email'] = $_REQUEST['email'];
            if (isset($_REQUEST['type']))
                $data['type'] = $_REQUEST['type'];
            else
                $data['type'] = 1;
            $resultInsert = $this->user->insert($data);
            $data = null;
            if ($resultInsert == 1) {
                $data["mensaje"] = "Usuario insertado con éxito";
                View::redirect("mainMenu", $data);
            } else {
                $data["mensaje"] = "Error al insertar";
                View::redirect("mainMenu", $data);
            }
        else:
            $data["mensaje"] = "No tienes permisos para hacer eso";
            View::redirect("mainMenu", $data);
        endif;
    }

    /**
     * Muestra el formulario de actualización de usuarios
     */
    private function formModifyUser() {
        if(Security::isSessionOpen() && (Security::getType() == 0 || Security::getId() == $_REQUEST["usr"])):
            $data["userData"] = $this->user->getAllFromOneUser($_REQUEST["usr"]);
            View::show("formModifyUser", $data);
        else:
            $data["mensaje"] = "No tienes permisos para acceder a esa página";
            View::redirect("showFormLogin", $data);
        endif;
    }

    private function processModifyUser() {
        //Compruebo que el usuario sea administrador o que sea el mismo que tiene iniciada la sesión
        if(Security::isSessionOpen() && (Security::getType() == 0 || Security::getId() == $_REQUEST["usr"])):
            $data["id"] = $_REQUEST["usr"];
            $data["username"] = $_REQUEST["username"];
            $data["nombre"] = $_REQUEST["name"];
            $data["apellidos"] = $_REQUEST["surnames"];
            $data["passwd"] = $_REQUEST["passwd"];
            $data["email"] = $_REQUEST["email"];
            if(isset($_REQUEST["type"])):
                $data["type"] = $_REQUEST["type"];
            endif;
            //View::show("error", $data);
            $result = $this->user->update($data);
            if($result):
                $data["mensaje"] = "Usuario modificado con éxito";
                View::redirect("mainMenu", $data);
            else:
                $data["mensaje"] = "No se ha podido modificar el usuario";
                View::redirect("mainMenu", $data);
            endif;
        else:
            $data["mensaje"] = "Se te ha cerrado la sesión por intentar acceder a donde no debes.";
            Security::closeSession();
            View::redirect("showFormLogin", $data);
        endif;
    }

    /**
     * Elimina un usuario
     */
    private function deleteUser() {
        if(Security::isSessionOpen() && Security::getType() == 0):
            $resultDelete = $this->user->delete($_REQUEST['usr']);
            if ($resultDelete) {
                $data["mensaje"] = "Usuario borrado con éxito";
            } else {
                $data["mensaje"] = "Error al borrar";
            }
            View::redirect("mainMenu", $data);
        else:
            $data["mensaje"] = "No tienes permisos para entrar aquí";
            View::redirect("closeSession", $data);
        endif;
    }

    private function deleteOwnUser() {
        if(Security::isSessionOpen() && Security::getId() == $_REQUEST["usr"]):
            $resultDelete = $this->user->delete($_REQUEST['usr']);
            if ($resultDelete) {
                $data["mensaje"] = "Usuario borrado con éxito";
            } else {
                $data["mensaje"] = "Error al borrar";
            }
            Security::closeSession($data);
            View::redirect("showFormLogin", $data);
        else:
            $data["mensaje"] = "No tienes permisos para acceder a esa página";
            Security::closeSession();
            View::redirect("showFormLogin", $data);
        endif;
    }

    /**
     * Muestra una vista de error
     */
    private function error() {
        View::show("error");
    }
} // class
