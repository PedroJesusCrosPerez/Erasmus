<?php

echo '<pre>';
print_r($_POST);
echo '</pre>';


echo "<br><br>";

$baremable = isset($_POST["baremable"]) ? $_POST["baremable"] : [];
$id = isset($_POST["id"]) ? $_POST["id"] : [];


for ($i = 0; $i < count($baremable); $i++) {
    $currentBaremable = $baremable[$i];
    $currentId = $id[$i];
    $currentRequired = isset($required[$i]) ? $required[$i] : "off";
    $currentMinValue = isset($min_value[$i]) ? $min_value[$i] : "";
    $currentMaxValue = isset($max_value[$i]) ? $max_value[$i] : "";
    $currentContributesStudent = isset($contributes_student[$i]) ? $contributes_student[$i] : "off";

    // Process or store the values as needed
    // Example: Print the values
    echo "Baremable: $currentBaremable, Id: $currentId, Required: $currentRequired, Min Value: $currentMinValue, Max Value: $currentMaxValue, Contributes Student: $currentContributesStudent<br>";
}

?>