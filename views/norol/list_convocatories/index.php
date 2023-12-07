<?php
$thisdir = "views/norol/list_convocatories/";
$arrConvocatories = DBConvocatory::findAll();
$arrGroups = DBGroup::findAll();

echo '
<head>
    <link rel="stylesheet" href="'.$thisdir.'css/style.css">
    <script src="'.$thisdir.'js/functions.js"></script>
    <script src="'.$thisdir.'js/fetch.js"></script>
</head>
<div class="convocatories">
    <h1>Solicitar becas</h1>
    <select name="group" id="slctGroup">
        <option value="null" selected disabled>Selecciona un curso para filtrar</option>
        <option value="all">Todos</option>
        ';
        foreach ($arrGroups as $group) {
          echo '<option value="'.$group->getId().'">'.$group->getName().'</option>';
        }
        echo '
    </select>

    <div class="convocatories-container" id="convocatories_container"></div>
    <!--
    <div class="activity-container">
        <div class="image-container img-one">
            <img src="https://github.com/ecemgo/mini-samples-great-tricks/assets/13468728/467cf682-03fb-4fae-b129-5d4f5db304dd" alt="tennis" />
        </div>

        <div class="image-container img-two">
            <img src="https://github.com/ecemgo/mini-samples-great-tricks/assets/13468728/3bab6a71-c842-4a50-9fed-b4ce650cb478" alt="hiking" />
        </div>

        <div class="image-container img-three">
            <img src="https://github.com/ecemgo/mini-samples-great-tricks/assets/13468728/c8e88356-8df5-4ac5-9e1f-5b9e99685021" alt="running" />
        </div>

        <div class="image-container img-four">
            <img src="https://github.com/ecemgo/mini-samples-great-tricks/assets/13468728/69437d08-f203-4905-8cf5-05411cc28c19" alt="cycling" />
        </div>

        <div class="image-container img-five">
            <img src="https://github.com/ecemgo/mini-samples-great-tricks/assets/13468728/e1a66078-1927-4828-b793-15c403d06411" alt="yoga" />
        </div>

        <div class="image-container img-six">
            <img src="https://github.com/ecemgo/mini-samples-great-tricks/assets/13468728/7568e0ff-edb5-43dd-bff5-aed405fc32d9" alt="swimming" />
        </div>
    </div>
    -->
</div>
';