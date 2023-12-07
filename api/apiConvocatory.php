<?php
/**
 * Cómo utilizar esta api
 * TODO como utilizar apiConvocatory
 * 
 * GET:
 *  - DBConvocatory::findAll = ?convocatory=findAll
 *  - DBConvocatory::findByName = ?convocatory=findByName
 *  - DBConvocatory::findByRole = ?convocatory=findByRole
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
        switch ($_GET["convocatory"]) 
        {
            case 'findAll':
                echo json_encode(DBConvocatory::findAll());
                break;

            case 'findByGroup':
                if (isset($_GET["group"])) {
                    switch ($_GET["group"]) {
                        case 'findAll':
                            $groups = DBGroup::findAll();
                            
                            echo json_encode(DBConvocatory::createArrCon_has_group( $groups ));
                            break;
                        
                        case 'findById':
                            if (isset($_GET["id"])) {
                                $group = DBGroup::findById($_GET["id"]);
                                $convocatories = DBConvocatory::findByGroupId($_GET["id"]);
                                
                                echo json_encode(DBConvocatory::createArrCon_has_groupByGroup_id($_GET["id"]));
                            }
                            break;
                        
                        default: // Select * | findAll
                            $group = DBGroup::findAll();
                            $convocatories = DBConvocatory::findAll();
                            
                            echo json_encode(DBConvocatory::createArrCon_has_group( $group, $convocatories ));
                            break;
                    }
                }
                break;
            
            default:
                echo json_encode(['error' => 'Invalid operation']);
                break;
        }
        break;

    case 'POST': // UPDATE
        $convocatory = new Convocatory(1, 'Type Example', '2023-01-01', '2023-02-01', '2023-03-01', '2023-04-01', 'Country Example', 123);
        DBConvocatory::update($convocatory);
        break;

    case 'PUT': // INSERT
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode(var_dump($data));
        //$convocatory = new Convocatory(1, 'Type Example', '2023-01-01', '2023-02-01', '2023-03-01', '2023-04-01', 'Country Example', 123);
        //DBConvocatory::insert($convocatory);
        break;

    case 'DELETE': // DELETE
        //$convocatory = new Convocatory(1, 'Type Example', '2023-01-01', '2023-02-01', '2023-03-01', '2023-04-01', 'Country Example', 123);
        $id = json_decode(file_get_contents('php://input'), true);
        DBConvocatory::delete($id);
        break;
    
    default:
        echo json_encode(['error' => 'Invalid request']);
        break;
}

?>