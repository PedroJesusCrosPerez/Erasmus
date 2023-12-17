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
include_once $_SERVER["DOCUMENT_ROOT"] . "/helpers/Autoload.php";

// Cabeceras
// header('Content-Type: application/json');

// Api
switch ($_SERVER["REQUEST_METHOD"]) {
    case 'GET': // SELECT
        switch ($_GET["convocatory"]) {
            case 'findAll':
                echo json_encode(DBConvocatory::findAll());
                break;

            case 'findAllAll':
                echo json_encode(DBConvocatory::findAllAll());
                break;

            case 'findByOnDate':
                // echo json_encode(DBConvocatory::findByMoreDate());
                echo json_encode("==> pending to implement");
                break;

            case 'findAllAllParaPruebas':
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
                            echo json_encode(DBConvocatory::createArrCon_has_group($groups));
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

                            echo json_encode(DBConvocatory::createArrCon_has_group($group, $convocatories));
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
        /**
         * >>>>>>>>>>>>>>> CONVOCATORY >>>>>>>>>>>>>>>
         * 
         * Recoger datos de la convocatoria
         */
        $convocatory_id =   isset($_POST["convocatory_id"]) ? $_POST["convocatory_id"]  : null; // number
        $project =          isset($_POST["project"])        ? $_POST["project"]         : null; // number
        $country =          isset($_POST["country"])        ? $_POST["country"]         : null; // string
        $movilities =       isset($_POST["movilities"])     ? $_POST["movilities"]      : null; // number
        $type =             isset($_POST["type"])           ? $_POST["type"]            : null; // string
        // Fechas de una convocatoria
        $date_requests_start =      isset($_POST["date_requests_start"])    ? $_POST["date_requests_start"]     : null; // date
        $date_requests_end =        isset($_POST["date_requests_end"])      ? $_POST["date_requests_end"]       : null; // date
        $date_baremation =          isset($_POST["date_baremation"])        ? $_POST["date_baremation"]         : null; // date
        $date_definitive_lists =    isset($_POST["date_definitive_lists"])  ? $_POST["date_definitive_lists"]   : null; // date


        $convocatory =
            new Convocatory(
                null,
                $type,
                $date_requests_start,
                $date_requests_end,
                $date_baremation,
                $date_definitive_lists,
                $country,
                $movilities,
                $project
            );
        /**
         * <<<<<<<<<<<<<< CONVOCATORY <<<<<<<<<<<<<<<
         */



        /**
         * >>>>>>>>>>>>>>> GROUP >>>>>>>>>>>>>>>
         * 
         * Recoger datos de la grupo
         */
        $group_id = isset($_POST["group"]) ? $_POST["group"] : null; // string

        $group = DBGroup::findById($group_id);
        /**
         * <<<<<<<<<<<<<< GROUP <<<<<<<<<<<<<<<
         */




        /**
         * >>>>>>>>>>>>>>>>>> ITEMS BAREMABLES >>>>>>>>>>>>>>>>
         * 
         * Recoger datos de los items baremables
         */
        $arrItems = array();
        foreach ($_POST["baremable"] as $item) {
            // $baremables =   isset($_POST["baremable"]) && is_array($_POST["baremable"]) ? $_POST["baremable"]   : null; // number
            $required =    isset($_POST["required" . $item])   ? $_POST["required" . $item]    : false; // bool
            $min_value =   isset($_POST["min_value" . $item])  ? $_POST["min_value" . $item]   : null; // number
            $max_value =   isset($_POST["max_value" . $item])  ? $_POST["max_value" . $item]   : null; // number
            $contributes_student = isset($_POST["contributes_student" . $item]) ? $_POST["contributes_student" . $item] : false; // bool

            $arrItems[] =
                new Convocatory_has_item_baremable(
                    $convocatory_id,
                    $item,
                    $required,
                    $min_value,
                    $max_value,
                    $contributes_student
                );

            $arrScore = null;
            if ($item == 4) {
                $languages = DBLanguage::findAll();
                $arrScore = array();

                foreach ($languages as $value) {
                    $arrScore[$value->getId()] = $_POST["score_" . $value->getId()];
                }
                $arrItems["languages"] = $arrScore;
            }
        }
        /**
         * <<<<<<<<<<<<<<<<< ITEMS BAREMABLES <<<<<<<<<<<<<<<<<<
         */

        /**
         * UPDATE en las tabas:
         *  - convocatory
         *  - convocatory_has_group
         *  - convocatory_has_item_baremable
         */

        echo DBConvocatory::update($convocatory, $group, $arrItems, $convocatory_id);
        // header("Location: ?coordinator=baremation");
        // echo "¡¡La convocatoria se ha actualizado con éxito!!";
        break;

    case 'PUT': // INSERT
        // TODO para pasar a la api el archivo createConvocatory.php tendría que leer los datos del formulario en el body de $_PUT[]
        // $data = json_decode(file_get_contents('php://input'), true);
        // echo json_encode(var_dump($data));
        /**
         * >>>>>>>>>>>>>>> CONVOCATORY >>>>>>>>>>>>>>>
         * 
         * Recoger datos de la convocatoria
         */
        $convocatory_id = null;
        // Esta variable se debe obtener utilizando transacciones de MYSQL
        $project =      isset($_POST["project"])    ? $_POST["project"]     : null; // number
        $country =      isset($_POST["country"])    ? $_POST["country"]     : null; // string
        $movilities =   isset($_POST["movilities"]) ? $_POST["movilities"]  : null; // number
        $type =         isset($_POST["type"])       ? $_POST["type"]        : null; // string
        // Fechas de una convocatoria
        $date_requests_start =      isset($_POST["date_requests_start"])    ? $_POST["date_requests_start"]     : null; // date
        $date_requests_end =        isset($_POST["date_requests_end"])      ? $_POST["date_requests_end"]       : null; // date
        $date_baremation =          isset($_POST["date_baremation"])        ? $_POST["date_baremation"]         : null; // date
        $date_definitive_lists =    isset($_POST["date_definitive_lists"])  ? $_POST["date_definitive_lists"]   : null; // date


        $convocatory =
            new Convocatory(
                null,
                $type,
                $date_requests_start,
                $date_requests_end,
                $date_baremation,
                $date_definitive_lists,
                $country,
                $movilities,
                $project
            );
        /**
         * <<<<<<<<<<<<<< CONVOCATORY <<<<<<<<<<<<<<<
         */



        /**
         * >>>>>>>>>>>>>>> GROUP >>>>>>>>>>>>>>>
         * 
         * Recoger datos de la grupo
         */
        $group_id = isset($_POST["group"]) ? $_POST["group"] : null; // string

        $group = DBGroup::findById($group_id);
        /**
         * <<<<<<<<<<<<<< GROUP <<<<<<<<<<<<<<<
         */




        /**
         * >>>>>>>>>>>>>>>>>> ITEMS BAREMABLES >>>>>>>>>>>>>>>>
         * 
         * Recoger datos de los items baremables
         */
        $arrItems = array();
        foreach ($_POST["baremable"] as $item) {
            // $baremables =   isset($_POST["baremable"]) && is_array($_POST["baremable"]) ? $_POST["baremable"]   : null; // number
            $required =    isset($_POST["required" . $item])   ? $_POST["required" . $item]    : false; // bool
            $min_value =   isset($_POST["min_value" . $item])  ? $_POST["min_value" . $item]   : null; // number
            $max_value =   isset($_POST["max_value" . $item])  ? $_POST["max_value" . $item]   : null; // number
            $contributes_student = isset($_POST["contributes_student" . $item]) ? $_POST["contributes_student" . $item] : false; // bool

            $arrItems[] =
                new Convocatory_has_item_baremable(
                    $convocatory_id,
                    $item,
                    $required,
                    $min_value,
                    $max_value,
                    $contributes_student
                );

            $arrScore = null;
            if ($item == 4) {
                $languages = DBLanguage::findAll();
                $arrScore = array();

                foreach ($languages as $value) {
                    $arrScore[$value->getId()] = $_POST["score_" . $value->getId()];
                }
                $arrItems["languages"] = $arrScore;
            }
        }
        /**
         * <<<<<<<<<<<<<<<<< ITEMS BAREMABLES <<<<<<<<<<<<<<<<<<
         */




        /**
         * INSERT en las tabas:
         *  - convocatory
         *  - convocatory_has_group
         *  - convocatory_has_item_baremable
         */

        echo DBConvocatory::insert($convocatory, $group, $arrItems);
        header("Location: http://serverpedroerasmus?coordinator=create_convocatory");
        // foreach ($arrItems as $key => $value) {
        //     if (!is_array($value)) {
        //         echo("KEY: ".$key." | VALUE: ".$value);
        //         echo "<hr>";
        //     } else {
        //         foreach ($arrScore as $key => $value) {
        //             echo("KEY: ".$key." | VALUE: ".$value);
        //             echo "<hr>";
        //         }
        //     }
        // }
        break;

    case 'DELETE': // DELETE
        $id = json_decode(file_get_contents('php://input'), true);
        DBConvocatory::delete($id);
        // header("Location: ?coordinator=baremation");
        // require_once "views/coordinator/baremacion/index.php";
        // echo "¡¡La convocatoria se ha actualizado con éxito!!";
        break;

    default:
        echo json_encode(['error' => 'Invalid request']);
        break;
}
