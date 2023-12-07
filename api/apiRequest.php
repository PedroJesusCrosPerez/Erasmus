<?php
/**
 * Cómo utilizar esta api
 * TODO como utilizar apiRequest
 * 
 * GET:
 *  - DBRequest::findAll = ?request=findAll
 *  - DBRequest::findByName = ?request=findByName
 *  - DBRequest::findByRole = ?request=findByRole
 * 
 * POST:
 * 
 * 
 * 
 */


// Autoload
include_once $_SERVER["DOCUMENT_ROOT"]."/helpers/Autoload.php";

// Cabeceras
header('Content-Type: application/json');

// Api
switch ($_SERVER["REQUEST_METHOD"]) 
{
    case 'GET': // SELECT
        switch ($_GET["request"]) 
        {
            case 'findAll':
                $val = new Validator();
                $requests = DBRequest::findAll();
                $val->isNotNull($requests, "DBRequest", "No se han encontrado usuarios en la base de datos");
                
                if ($val->isError()) {
                    $val->showErrors();
                } else {
                    echo json_encode(['data' => $requests]);
                }
                break;

            case 'findByName':
                $name = isset($_GET["name"]) ? $_GET["name"] : null;
                $request = DBRequest::findByName($name);
                echo json_encode(['data' => $request]);
                break;

            case 'findByRole':
                $role = isset($_GET["role"]) ? $_GET["role"] : null;
                $requests = DBRequest::findByRole($role);
                echo json_encode(['data' => $requests]);
                break;
            
            default:
                echo json_encode(['error' => 'Invalid operation']);
                break;
        }
        break;

    case 'POST': // UPDATE
        $val = new Validator();
        $data = json_decode(file_get_contents('php://input'), true);
        $response = false;

        $val->isEmpty($data, "data", "No se ha recibido ningún usuario para actualizar.");
        $val->isExist($data, "data", "No se han recibido datos por parte de servidor.");
        $val->isNull($data, "data", "La información recibida es nula.");

        if ($val->isError()) {
            $val->showErrors();
        } else {
            //$response = DBRequest::updateById($data["id"], $data["name"], $data["role"]); // FUNCIONA
            $response = DBRequest::update($data["field"], $data["value"], $data["field_id"], $data["value_id"]);
        }
        
        echo $response ? json_encode(new Response("true")) : json_encode(new Response("false"));
        break;

    case 'PUT': // INSERT
        $data = json_decode(file_get_contents('php://input'), true);
        $request = new Request(null, $data["name"], $data["passowrd"], null);
        $response = DBRequest::insert($request);
        
        echo $response ? json_encode(new Response("true")) : json_encode(new Response("false"));
        break;

    case 'DELETE': // DELETE
        switch ($_POST["property"]) 
        {
            case 'id':
                $data = json_decode(file_get_contents('php://input'), true);
                $response = DBRequest::delete($data["id"]);
                
                echo $response ? json_encode(new Response("true")) : json_encode(new Response("false"));
                break;
            
            case 'name':
                $data = json_decode(file_get_contents('php://input'), true);
                $response = DBRequest::deleteByName($data["name"]);
                
                echo $response ? json_encode(new Response("true")) : json_encode(new Response("false"));
                break;

            default:
                $data = json_decode(file_get_contents('php://input'), true);
                $response = DBRequest::deleteByName($data["name"]);
                
                echo $response ? json_encode(new Response("true")) : json_encode(new Response("false"));
                break;
        }
        break;
    
    default:
        echo json_encode(['error' => 'Invalid request']);
        break;
}

?>