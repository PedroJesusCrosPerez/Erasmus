<?php

require_once "helpers/Autoload.php";

$arrItems = DBItem_baremable::findContributesStudent($_GET["convocatory_id"]);

foreach ($arrItems as $value) {
    echo $value . "<hr>";
}


?>