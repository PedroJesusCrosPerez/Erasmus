<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/helpers/Autoload.php";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger datos del formulario
    $project = $_POST["project"];
    $country = $_POST["country"];
    $group = $_POST["group"];
    $movilities = $_POST["movilities"];
    $type = $_POST["type"];

    $date_requests_start = $_POST["date_requests_start"];
    $date_requests_end = $_POST["date_requests_end"];
    $date_baremation = $_POST["date_baremation"];
    $date_definitive_lists = $_POST["date_definitive_lists"];

    // Recoger datos de los items baremables
    $baremables = $_POST["baremable"];
    $ids = $_POST["id"];
    $required = $_POST["required"];
    $min_values = $_POST["min_value"];
    $max_values = $_POST["max_value"];
    $contributes_students = $_POST["contributes_student"];

    // Ahora puedes procesar o almacenar estos datos como desees
    // Por ejemplo, puedes imprimirlos para verificar
    echo "Proyecto: " . $project . "<br>";
    echo "País: " . $country . "<br>";
    echo "Destinatarios: " . $group . "<br>";
    echo "Número de movilidades: " . $movilities . "<br>";
    echo "Tipo: " . $type . "<br>";

    echo "Fecha de inicio solicitudes: " . $date_requests_start . "<br>";
    echo "Fecha de fin solicitudes: " . $date_requests_end . "<br>";
    echo "Fecha de baremación: " . $date_baremation . "<br>";
    echo "Fecha de listas definitivas: " . $date_definitive_lists . "<br>";

    // Procesar datos de items baremables
    $arrItems = array();
    for ($i = 0; $i < count($baremables); $i++) {
        echo "Baremable " . ($i + 1) . ": ";
        echo "ID: " . $ids[$i] . ", ";
        echo "Requerido: " . (isset($required[$i]) ? "true" : "false") . ", ";
        echo "Valor mínimo: " . $min_values[$i] . ", ";
        echo "Valor máximo: " . $max_values[$i] . ", ";
        echo "Aporta alumno: " . (isset($contributes_students[$i]) ? "true" : "false") . "<br>";

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
    

        // Guardar contenido en un archivo JSON
        $outputData = array(
            'convocatory' => $convocatory,
            'convocatory_has_item_baremable' => $arrItems
        );
    
        $outputJson = json_encode($outputData, JSON_PRETTY_PRINT);
    
        file_put_contents('output.json', $outputJson);
    
        // Imprimir objetos
        var_dump($convocatory);
}

?>