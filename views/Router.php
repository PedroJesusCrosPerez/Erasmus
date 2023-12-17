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
                        Session::delete("coordinator");
                        header("Location: ?menu=landingpage");
                        // require_once "views/landingpage/index.php";
                        break;

                    // Página de aterrizage
                    default:
                        require_once 'landingpage/index.php';
                        break;
                }
            }
            elseif ( isset($_GET["coordinator"]) ) 
            {
                if ( Login::isLoged() ) 
                {
                    switch ($_GET["coordinator"]) 
                    {
                        // Panel de control de coordinador erasmus
                        case 'coordinator':
                            require_once "coordinator/dashboard/index.php";
                            break;
                        
                        // Formulario con "Anterior y Siguiente" crear convocatoria
                        case 'create_convocatory':
                            require_once "coordinator/create_convocatory/index.php";
                            break;
                        
                        // CRUD convocatory
                        case 'crud_convocatory':
                            require_once "coordinator/crud_convocatory/index.php";
                            break;

                        // Baremación
                        case 'baremation':
                            require_once "coordinator/baremacion/index.php";
                            break;
                        
                        // Baremación
                        default:
                            require_once "coordinator/baremacion/index.php";
                            break;
                    }
                }
            }
            else
            {
                require_once 'norol/list_convocatories/index.php';
            }
        }
        elseif ( $_SERVER["REQUEST_METHOD"] == "POST" ) 
        {
            if ( isset($_GET["menu"]) ) 
            {
                switch ($_GET["menu"]) 
                {
                    case 'actionLogin':
                        if ( !empty($_POST["name"]) && !empty($_POST["password"]) )
                        {
                            $coordinator = DBCoordinator::findByName_Password($_POST["name"], $_POST["password"]);
                            if ( isset($coordinator) ) 
                            {
                                Login::login($coordinator, true);
                            }
                            else
                            {
                                require_once "loginForm.php";
                                echo "Error en las credenciales"; // TODO mostrar mejor los errores
                            }
                        }
                        else
                        {
                            require_once "loginForm.php";
                            echo "Error en las credenciales"; // TODO mostrar mejor los errores
                        }
                        break;

                    case 'actionSignup':
                        if ( !(empty($_POST["name"]) && empty($_POST["password"])) )
                        {
                            if ( empty(DBCoordinator::findByName($_POST["name"])) ) 
                            {
                                // Insert en la base de datos
                                DBCoordinator::insert( new Coordinator(null, $_POST["name"], $_POST["password"]) );
                                // TODO mostrar feedback de registro;
                                require_once "views/coordinator/baremacion/index.php";
                                echo "¡¡¡El usuario se ha registrado con éxito!!!";
                            }
                            else
                            {
                                // Tiene que mostrar el error de que el nombre del usuario ya existe en la base de datos
                                echo "Error en las credenciales2"; // TODO mostrar mejor los errores
                            }
                        }
                        else
                        {
                            require_once "loginForm.php";
                            echo "Error en las credenciales1"; // TODO mostrar mejor los errores
                        }
                        break;
                    
                    default:
                        echo "ERROR EN EL SERVIDOR Router.php:129";
                        break;
                }
            }
            else
            {
                require_once 'landingpage/landingpage.php';
            }
        }
        else 
        {
            if (Login::isLoged()) 
            {
                
                require_once $_SERVER['REQUEST_URI']."?menu=baremation";
            }
            else
            {
                require_once $_SERVER['REQUEST_URI']."?menu=landingpage";
            }
        }
    }

}

Router::redirect();

?>