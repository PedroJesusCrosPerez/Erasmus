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


    $convocatory = 
    new Convocatory(
        null,
        $type,
        $date_requests_start,
        $date_requests_end,
        $date_baremation,
        $date_definitive_lists,
        $country,
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
}
?>