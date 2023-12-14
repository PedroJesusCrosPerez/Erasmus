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
            
            case 'findByOnDate':
                // echo json_encode(DBConvocatory::findByMoreDate());
                echo json_encode("==> pending to implement");
                break;
            
            case 'findAllAll':
                // echo json_encode(DBConvocatory::findAllAll());
                
                echo '
                [
                    {
                        "convocatory": {
                            "id": 1,
                            "type": "short",
                            "date_start_requests": "2023-12-04",
                            "date_end_requests": "2023-12-25",
                            "date_baremation": "2024-01-10",
                            "date_definitive_lists": "2024-01-20",
                            "country": "germany",
                            "project_id": 1
                        },
                        "project": {
                            "id": 1,
                            "name": "I.E.S. Fuentezuelas por el mundo",
                            "code": "1DWA123",
                            "date_start": "2023-09-20",
                            "date_end": "2024-06-20"
                        },
                        "requests": [
                            {
                                "id": 1,
                                "dni": "78162647E",
                                "name": "Pedro",
                                "surname": "Cros",
                                "birthdate": "2004-09-19",
                                "group": "2DWA",
                                "phone": "609323607",
                                "email": "pcroper1909@g.educaand.es",
                                "address": "calle de pedro cros 78162647E",
                                "photo": "base64_encoded_image_data_1",
                                "convocatory_id": 19
                            },
                            {
                                "id": 2,
                                "dni": "98765432F",
                                "name": "María",
                                "surname": "López",
                                "birthdate": "2003-08-15",
                                "group": "3B",
                                "phone": "609323608",
                                "email": "maria@g.educaand.es",
                                "address": "calle de maría lópez 98765432F",
                                "photo": "base64_encoded_image_data_2",
                                "convocatory_id": 19
                            },
                            {
                                "id": 3,
                                "dni": "55555555X",
                                "name": "Juan",
                                "surname": "García",
                                "birthdate": "2005-05-10",
                                "group": "1A",
                                "phone": "609323609",
                                "email": "juan@gmail.com",
                                "address": "calle de juan garcía 55555555X",
                                "photo": "base64_encoded_image_data_3",
                                "convocatory_id": 2
                            },
                            {
                                "id": 4,
                                "dni": "12345678A",
                                "name": "Ana",
                                "surname": "Martínez",
                                "birthdate": "2004-12-12",
                                "group": "2C",
                                "phone": "609323610",
                                "email": "ana@example.com",
                                "address": "calle de ana martínez 12345678A",
                                "photo": "base64_encoded_image_data_4",
                                "convocatory_id": 2
                            }
                        ]
                    },
                    {
                        "convocatory": {
                            "id": 2,
                            "type": "short",
                            "date_start_requests": "2023-12-04",
                            "date_end_requests": "2023-12-25",
                            "date_baremation": "2024-01-10",
                            "date_definitive_lists": "2024-01-20",
                            "country": "spain",
                            "project_id": 1
                        },
                        "project": {
                            "id": 1,
                            "name": "I.E.S. Fuentezuelas por el mundo",
                            "code": "1DWA123",
                            "date_start": "2023-09-20",
                            "date_end": "2024-06-20"
                        },
                        "requests": [
                            {
                                "id": 5,
                                "dni": "98765432F",
                                "name": "María",
                                "surname": "González",
                                "birthdate": "2002-04-28",
                                "group": "3A",
                                "phone": "609323611",
                                "email": "maria.g@example.com",
                                "address": "Calle Principal 789",
                                "photo": "base64_encoded_image_data_5",
                                "convocatory_id": 2
                            },
                            {
                                "id": 6,
                                "dni": "87654321B",
                                "name": "Javier",
                                "surname": "Ruiz",
                                "birthdate": "2003-10-15",
                                "group": "1B",
                                "phone": "609323612",
                                "email": "javier@example.com",
                                "address": "Avenida Central 456",
                                "photo": "base64_encoded_image_data_6",
                                "convocatory_id": 2
                            }
                        ]
                    }
                ]
                ';
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