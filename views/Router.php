<?php
    //require_once "helpers/Autoload.php";

class Router
{
    static function redirect() 
    {
        if ( $_SERVER["REQUEST_METHOD"] == "GET" ) 
        {
            if ( isset($_GET["menu"]) )
            {
                switch ($_GET['menu']) 
                {
                    // Página de aterrizage
                    case 'langingpage':
                        require_once 'landingpage/index.php';
                        break;

                    // >>>>>>>>>>>>>>>>>>>>>> COORDINATOR - START >>>>>>>>>>>>>>>>>>>>>>>>
                    // Panel de control de coordinador erasmus
                    case 'coordinator':
                        require_once "coordinator/dashboard/index.php";
                        break;
                    
                    // Formulario con "Anterior y Siguiente" crear convocatoria
                    case 'create_convocatory':
                        require_once "coordinator/create_convocatory/index.php";
                        break;
                    
                    // TODO CRUD CONVOCATORY
                    case 'crud_convocatory':
                        require_once "coordinator/crud_convocatory/index.php";
                        break;
                    // Baremación
                    case 'baremation':
                        require_once "coordinator/baremacion/index.php";
                        break;
                    // <<<<<<<<<<<<<<<<<<<<<<< COORDINATOR - END <<<<<<<<<<<<<<<<<<<<<<<<<

                    // Listado de becas con botón solicitar
                    case 'list_convocatories':
                        require_once "norol/list_convocatories/index.php";
                        break;

                    // Solicitud para rellenar
                    case 'complete_request':
                        require_once "norol/request/index.php";
                        break;
                    // Formulario de inicio de sesión (coordinador)
                    case 'login':
                        require_once "forms/loginForm.php";
                        break;

                    // Formulario de registro de usuario (coordinador)
                    case 'signup':
                        require_once "forms/signupForm.php";
                        break;

                    // Cerrar sesión (coordinador)
                    case 'logout':
                        Session::delete("user");
                        header("Location: ?menu=landingpage");
                        break;

                    // Página de aterrizage
                    default:
                        require_once 'landingpage/index.php';
                        break;
                }
            }
            else
            {
                require_once 'landingpage/index.php';
            }
        }
        else 
        {
            require_once 'landingpage/index.php';
        }
    }

}

Router::redirect();

?>