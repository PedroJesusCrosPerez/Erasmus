<?php
$thisdir = "views/coordinator/";
echo '
<head>
    <link rel="stylesheet" href="'.$thisdir.'css/styleCoordinator.css">
    <script src="'.$thisdir.'js/modal.js"></script>
    <script src="'.$thisdir.'js/ajax.js"></script>
</head>

<div id="crud_container">
    <p>Crear, leer, actualizar y eliminar de convocatorias</p>
    <div id="div_buttons">
        <div class="btn btnCreate" id="btnCreate" title="Crear una nueva"></div>
        <div class="btn btnUpdate" title="Selecciona una convocatoria y pulsa aquí para editarla"></div>
        <div class="btn btnDelete" title="Selecciona una convocatoria para eliminarla"></div>
    </div>
    <p id="form_convocatory_title">Crear convocatoria</p>



<form id="form_convocatory" name="convocatory" accept-charset="utf-8" autocomplete="off" enctype="multipart/form-data" method="post" formtarget="_blank" formnovalidate="formnovalidate"> <!--action="?menu=actionLogin">-->
    <label for="class" name="class">Destinatarios</label>
    <select name="class" id="slct_class">
        <option value="class">1DWA</option>
        <option value="class">2DWA</option>
        <option value="class">1DMA</option>
        <option value="class">2DMA</option>
    </select>

    <label for="movilities" name="movilities">Movilidades</label>
    <input type="number" name="movilities" id="input_movilities" value="1" min="1" max="30">

    <label for="type" name="type">Tipo</label>
    <label for="type" name="type_long">Larga</label>
    <input type="radio" name="type" value="long">
    <label for="type" name="type_short">Corta</label>
    <input type="radio" name="type" value="short">
    
    <label for="country" name="country">País de destino</label>
    <select name="country" id="country">
        <option value="england">Inglaterra</option>
        <option value="germany">Alemania</option>
        <option value="france">Francia</option>
    </select>

    <label for="date_requests_start" name="date_requests_start">Fecha de inicio solicitudes</label>
    <input type="date" name="date_requests_start" id="date_requests_start">

    <label for="date_requests_end" name="date_requests_end">Fecha de fin solicitudes</label>
    <input type="date" name="date_requests_end" id="date_requests_end">

    <label for="date_baremation" name="date_baremation">Fecha de baremación / listados provisionales</label>
    <input type="date" name="date_baremation" id="date_baremation">

    <label for="date_definitive_lists" name="date_definitive_lists">Fecha de listas definitivas</label>
    <input type="date" name="date_definitive_lists" id="date_definitive_lists">


    <label for="item_baremable" name="item_baremable">Items baremables</label>
    <button name="item_baremable">Configura aquí</button>

    <input type="submit" value="Enviar" id="input_submit">
</form>



</div>
';

?>