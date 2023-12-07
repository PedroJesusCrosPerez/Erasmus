<?php
// TODO validar
include_once $_SERVER["DOCUMENT_ROOT"]."/helpers/Autoload.php";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function validateBoolean($value) {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    $convocatory_id = 1; // TODO variable temporal
    // Recoger datos de la convocatoria
    $project = $_POST["project"]; // number
    $country = $_POST["country"]; // string
    $group = $_POST["group"]; // string
    $movilities = $_POST["movilities"]; // number
    $type = $_POST["type"]; // string

    $date_requests_start = $_POST["date_requests_start"]; // date
    $date_requests_end = $_POST["date_requests_end"]; // date
    $date_baremation = $_POST["date_baremation"]; // date
    $date_definitive_lists = $_POST["date_definitive_lists"]; // date

    // Recoger datos de los items baremables
    $baremables = $_POST["baremable"]; // number
    $ids = $_POST["id"]; // number
    $required = $_POST["required"]; // bool
    $min_values = $_POST["min_value"]; // number
    $max_values = $_POST["max_value"]; // number
    $contributes_students = validateBoolean($_POST["contributes_student"]); // bool
    
    // Imprimir convocatoria para validar
    $convocatory = new Convocatory(
        null,
        $type,
        $date_requests_start,
        $date_requests_end,
        $date_baremation,
        $date_definitive_lists,
        $country,
        $project
    );
    var_dump($convocatory);


    // Procesar datos de items baremables
    $arrItems = array();
    for ($i = 0; $i < count($baremables); $i++) {
        if ($baremables[$i]) {
        
            $convocatory_has_item_baremable = new Convocatory_has_item_baremable(
                $convocatory_id,
                $ids[$i],
                isset($required[$i]),
                $min_values[$i],
                $max_values[$i],
                isset($contributes_students[$i])
            );
            $arrItems[] = ($convocatory_has_item_baremable);
        
        }
    }

    // Imprimir items baremables para validar
    print_r($arrItems);
}

DBConvocatory::insert($convocatory, $group, $arrItems);
?>