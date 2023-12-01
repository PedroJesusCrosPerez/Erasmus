<?php

require_once $_SERVER["DOCUMENT_ROOT"]."/helpers/Autoload.php";

// Example of usage:
// try {
//     $db = DB::getConnection();
//     $repository = new DBConvocatory($db);

//     // Example of inserting a convocatory
//     $newConvocatory = new Convocatory(/* provide parameters */);
//     $repository->insertConvocatory($newConvocatory);

//     // Example of getting a convocatory by ID
//     $retrievedConvocatory = $repository->getConvocatoryById(/* provide ID */);
//     echo $retrievedConvocatory;

//     // Example of updating a convocatory
//     $retrievedConvocatory->setType("New Type");
//     $repository->updateConvocatory($retrievedConvocatory);

//     // Example of deleting a convocatory
//     $repository->deleteConvocatory(/* provide ID */);
// } finally {
//     DB::closeConnection();
// }

$group = DBGroup::findById("1ASA");
$item_baremable = array();
$item_baremable[] = DBItem_baremable::findById(1);
$convocatory = DBConvocatory::findById(1);

echo var_dump(DBConvocatory::insert($convocatory, $group, $item_baremable));

?>