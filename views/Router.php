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
                    case 'langingpage':
                        require_once 'landingpage/index.php';
                        break;

                    case 'coordinator':
                        require_once "coordinator/dashboard/index.php";
                        break;

                    case 'create_convocatory':
                        require_once "coordinator/create_convocatory/index.php";
                        break;

                    case 'becas':
                        require_once "becas/index.php";
                        break;

                    case 'login':
                        require_once "forms/loginForm.php";
                        break;

                    case 'signup':
                        require_once "forms/signupForm.php";
                        break;

                    case 'logout':
                        Session::delete("user");
                        header("Location: ?menu=landingpage");
                        break;

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