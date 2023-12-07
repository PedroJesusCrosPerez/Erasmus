<?php
// TODO validar
include_once $_SERVER["DOCUMENT_ROOT"]."/helpers/Autoload.php";

// header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function validateBoolean($value) {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    $convocatory_id = 1; // TODO variable temporal
    /**
     * CONVOCATORY
     * 
     * Recoger datos de la convocatoria
     */
    $project =      isset($_POST["project"])    ? $_POST["project"]     : null; // number
    $country =      isset($_POST["country"])    ? $_POST["country"]     : null; // string
    $group =        isset($_POST["group"])      ? $_POST["group"]       : null; // string
    $movilities =   isset($_POST["movilities"]) ? $_POST["movilities"]  : null; // number
    $type =         isset($_POST["type"])       ? $_POST["type"]        : null; // string
    // Fechas de una convocatoria
    $date_requests_start =      isset($_POST["date_requests_start"])    ? $_POST["date_requests_start"]     : null; // date
    $date_requests_end =        isset($_POST["date_requests_end"])      ? $_POST["date_requests_end"]       : null; // date
    $date_baremation =          isset($_POST["date_baremation"])        ? $_POST["date_baremation"]         : null; // date
    $date_definitive_lists =    isset($_POST["date_definitive_lists"])  ? $_POST["date_definitive_lists"]   : null; // date

    /**
     * ITEMS BAREMABLES
     * 
     * Recoger datos de los items baremables
     */
    $baremables =   isset($_POST["baremable"]) && is_array($_POST["baremable"]) ? $_POST["baremable"]   : null; // number
    $ids =          isset($_POST["id"])         ? $_POST["id"]          : null; // number
    $required =     isset($_POST["required"])   ? $_POST["required"]    : null; // bool
    $min_values =   isset($_POST["min_value"])  ? $_POST["min_value"]   : null; // number
    $max_values =   isset($_POST["max_value"])  ? $_POST["max_value"]   : null; // number
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
    var_dump($ids);
    echo "<hr>";
    var_dump($_POST["baremable"]);
    echo "<hr>";
    var_dump($_POST["required"]);
    echo "<hr>";
    var_dump($_POST["contributes_student"]);

    echo "<br><br><br><br>";
    

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        foreach ($_POST["baremable"] as $item) {
            echo "Convocatory [ID: " . $item . "] <br>";
            
            // Verifica si el ítem es requerido
            $required = isset($_POST["required"][$item]) ? "true" : "false";
            echo " -  [required: " . $required . "] <br>";
    
            // Verifica si el ítem contribuye al estudiante
            $contributesStudent = isset($_POST["contributes_student"][$item]) ? "true" : "false";
            echo " -  [contributes_student: " . $contributesStudent . "] <br>";
            
            echo "<br>";
        }

        // Accede a los valores mínimos y máximos
        $minValue = isset($_POST["min_value"][$item]) ? $_POST["min_value"][$item] : "No especificado";
        $maxValue = isset($_POST["max_value"][$item]) ? $_POST["max_value"][$item] : "No especificado";
        $length = count();
        for ($i=0; $i < $length; $i++) { 
            echo " -  [min_value: " . $minValue . "] <br>";
            echo " -  [max_value: " . $maxValue . "] <br>";
        }


    }
    
    
    

    // Procesar datos de items baremables
    // $arrItems = array();
    // for ($i = 0; $i < count($baremables); $i++) {
    //     if ($baremables[$i]) {
        
    //         $convocatory_has_item_baremable = new Convocatory_has_item_baremable(
    //             $convocatory_id,
    //             $ids[$i],
    //             isset($required[$i]),
    //             $min_values[$i],
    //             $max_values[$i],
    //             isset($contributes_students[$i])
    //         );
    //         $arrItems[] = ($convocatory_has_item_baremable);
        
    //     }
    // }


    // Imprimir items baremables para validar
    // print_r($arrItems);
}

// var_dump($arrItem);
?>

<?php
    // var_dump($baremables);
    // // Verificar si se han enviado datos del formulario
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     // Verificar si se han seleccionado elementos en el checkbox
    //     if (isset($_POST["baremable"]) && is_array($_POST["baremable"])) {
    //         echo "<h2>Elementos seleccionados:</h2>";
    //         echo "<ul>";
            
    //         // Iterar sobre los elementos seleccionados
    //         foreach ($_POST["baremable"] as $item) {
    //             // Mostrar el id del elemento
    //             echo "<li>Item $item (ID: $item)</li>";
    //         }

    //         echo "</ul>";
    //     } else {
    //         echo "<p>No se han seleccionado elementos</p>";
    //     }
    // }
?>