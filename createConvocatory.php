<?php
// TODO validar con validator
include_once $_SERVER["DOCUMENT_ROOT"]."/helpers/Autoload.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) 
{
    /**
     * >>>>>>>>>>>>>>> CONVOCATORY >>>>>>>>>>>>>>>
     * 
     * Recoger datos de la convocatoria
     */
    $convocatory_id = null;    // TODO variable temporal. 
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


    /**
     * >>>>>>>>>>>>>>> VALIDAR >>>>>>>>>>>>>>>
     */
    $val = new Validator();
    // IS NULL
    $val->isNull($project,      "project",      "El proyecto seleccionado es NULO");
    $val->isNull($country,      "country",      "El proyecto seleccionado es NULO");
    $val->isNull($movilities,   "movilities",   "El proyecto seleccionado es NULO");
    $val->isNull($type,         "type",         "El proyecto seleccionado es NULO");
    $val->isNull($date_requests_start,      "date_requests_start",      "El proyecto seleccionado es NULO");
    $val->isNull($date_requests_end,        "date_requests_end",        "El proyecto seleccionado es NULO");
    $val->isNull($date_baremation,          "date_baremation",          "El proyecto seleccionado es NULO");
    $val->isNull($date_definitive_lists,    "date_definitive_lists",    "El proyecto seleccionado es NULO");

    // IS NUMERIC
    $val->isNumeric($project,       "project",      "El proyecto debe ser un ID (un número), con el cuál poder acceder a él");
    $val->isNumeric($movilities,    "movilities",   "La cantidad de movilidades deben ser numéricas");
    
    // RANGE
        // - INT RANGE
        $min = 1;
        $max = 30;
    $val->intRange($movilities,    "movilities",   "Debes tener entre [".$min." y ".$max."] movilidades", $min, $max);
    
        // - STRING RANGE
        $minLength = 1;
        $maxLength = 30;
    $val->stringRange($country, "country", "El país debe tener una longitud entre [".$minLength." y ".$maxLength." caracteres.", $minLength, $maxLength);
    /**
     * <<<<<<<<<<<<<<< VALIDAR <<<<<<<<<<<<<<<
     */


    if ($val->isError()) 
    {
        echo "Se ha producido los siguientes errores: <br>";
        echo $val->getErrors();
    } 
    else 
    {
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
    }
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
        $required =    isset($_POST["required".$item])   ? $_POST["required".$item]    : false; // bool
        $min_value =   isset($_POST["min_value".$item])  ? $_POST["min_value".$item]   : null; // number
        $max_value =   isset($_POST["max_value".$item])  ? $_POST["max_value".$item]   : null; // number
        $contributes_student = isset($_POST["contributes_student".$item]) ? $_POST["contributes_student".$item] : false; // bool

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
                $arrScore[$value->getId()] = $_POST["score_".$value->getId()];
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
    
    DBConvocatory::insert($convocatory, $group, $arrItems);
    header("Location: ?coordinator=create_convocatory");
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
}
?>