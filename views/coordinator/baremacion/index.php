<?php
$thisdir = $_SERVER["DOCUMENT_ROOT"] . "/views/coordinator/baremacion/";
echo '
<head>
    <link rel="stylesheet" href="views/coordinator/baremacion/css/styleStructure.css">
    <link rel="stylesheet" href="views/coordinator/baremacion/css/styleCosmetic.css">

    <script src="views/coordinator/baremacion/js/fetch.js"></script>
    <script src="views/coordinator/baremacion/js/dropdownMenu.js"></script>
    <script src="views/coordinator/baremacion/js/modal.js"></script>
</head>

<div id="divBaremacion">

    <div id="convocatories">
        <div id="head" class="convocatory">
            <div>Proyecto</div>
            <div>País</div>
            <div>Tipo</div>
            <div>Inicio solicitudes</div>
            <div>Fin solicitudes</div>
            <div>Baremación</div>
            <div>Listados definitivos</div>
        </div>
        <div></div>
    </div>

</div>
';

?>