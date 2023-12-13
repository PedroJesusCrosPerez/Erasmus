<?php
$thisdir = "views/norol/list_convocatories/";
$arrConvocatories = DBConvocatory::findAll();
$arrGroups = DBGroup::findAll();

echo '
<head>
    <link rel="stylesheet" href="'.$thisdir.'css/styleListConvocatories.css">
    <script src="'.$thisdir.'js/functions.js"></script>
    <script src="'.$thisdir.'js/fetch.js"></script>
</head>
<div class="convocatories">
    <h1>Solicitar becas</h1>
    <select name="group" id="slctGroup">
        <!--<option value="null" selected disabled>Selecciona un curso para filtrar</option>-->
        <option value="all">Todos</option>
        ';
        foreach ($arrGroups as $group) {
          echo '<option value="'.$group->getId().'">'.$group->getName().'</option>';
        }
        echo '
    </select>

    <div class="convocatories-container" id="convocatories_container"></div>
</div>
';