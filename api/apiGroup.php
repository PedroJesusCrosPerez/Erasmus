<?php
// Autoload
include_once $_SERVER["DOCUMENT_ROOT"]."/helpers/Autoload.php";

// Cabeceras
header('Content-Type: application/json');

// Api
switch ($_SERVER["REQUEST_METHOD"]) 
{
    case 'GET': // SELECT
        switch ($_GET["group"]) 
        {
            case 'findAll':
                $val = new Validator();
                $groups = DBGroup::findAll();
                $val->isNull($groups, "DBGroup", "No se han encontrado grupos en la base de datos");
                
                if ($val->isError()) {
                    $val->showErrors();
                } else {
                    echo json_encode(['data' => $groups]);
                }
                break;

            case 'findById':
                $id = isset($_GET["id"]) ? $_GET["id"] : null;
                $group = DBGroup::findById($name);
                echo json_encode(['data' => $group]);
                break;
            
            default:
                echo json_encode(['error' => 'Invalid operation']);
                break;
        }
        break;

    default:
        echo json_encode(['error' => 'Invalid request']);
        break;
}

?>