<head>
    <link rel="stylesheet" href="views/coordinator/baremacion/css/styleCrud.css">
</head>

<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/helpers/Autoload.php";
$arrProjects = DBProject::findAll();
$arrGroups = DBGroup::findAll();
$arrItems = DBItem_baremable::findAll();
$arrLanguages = DBLanguage::findAll();
?>

<!--
<div name="list_convocatories">
    <p>Listado de convocatorias</p>
    <div name="convocatories">
        <div class="mConvocatory">
            <p>1</p>
            <p>España</p>
            <p>Short</p>
            <p>8</p>
        </div>
        <div class="mConvocatory">
            <p>1</p>
            <p>España</p>
            <p>Short</p>
            <p>8</p>
        </div>
        <div class="mConvocatory">
            <p>1</p>
            <p>España</p>
            <p>Short</p>
            <p>8</p>
        </div>
        <div class="mConvocatory">
            <p>1</p>
            <p>España</p>
            <p>Short</p>
            <p>8</p>
        </div>

        <div class="mConvocatory">
            <p>1</p>
            <p>España</p>
            <p>Short</p>
            <p>8</p>
        </div>
        <div class="mConvocatory">
            <p>1</p>
            <p>España</p>
            <p>Short</p>
            <p>8</p>
        </div>
        <div class="mConvocatory">
            <p>1</p>
            <p>España</p>
            <p>Short</p>
            <p>8</p>
        </div>
        <div class="mConvocatory">
            <p>1</p>
            <p>España</p>
            <p>Short</p>
            <p>8</p>
        </div>
        <div class="mConvocatory">
            <p>1</p>
            <p>España</p>
            <p>Short</p>
            <p>8</p>
        </div>
        <div class="mConvocatory">
            <p>1</p>
            <p>España</p>
            <p>Short</p>
            <p>8</p>
        </div>
    </div>
</div>
-->

<div name="current_convocatory" class="current_convocatory">
    <p>Convocatoria actual</p>
    <div name="crud_form" class="crud_form">
    <form name="request" action="http://serverpedroerasmus/api/apiConvocatory.php" method="post">

            <div class="form-sections">
                <div>
                    <label for="convocatory_id">ID</label>
                    <input type="text" name="convocatory_id" class="inputDisabled">
                    <br>
                    <label for="project" class="lblTitle">Proyecto:</label>
                    <select name="project" id="project">
                        <option value="null">**Proyecto al que pertenece**</option>
                        <?php
                        foreach ($arrProjects as $project) {
                            echo '<option value="' . $project->getId() . '">' . $project->getName() . '</option>';
                        }
                        ?>
                    </select>
                    <br>

                    <label for="country">País:</label>
                    <input type="text" name="country" id="">
                    <br>

                    <label for="group" class="lblTitle">Destinatarios:</label>
                    <select name="group">
                        <option value="null">**Grupo al que va destinado**</option>
                        <?php
                        foreach ($arrGroups as $group) {
                            echo '<option value="' . $group->getId() . '">' . $group->getName() . '</option>';
                        }
                        ?>
                    </select>
                    <br>

                    <label for="movilities" class="lblTitle">Núero de movilidades:</label>
                    <input type="number" name="movilities">
                    <br>

                    <div name="divType">
                        <label for="type" name="type" class="lblTitle">Tipo</label>
                        <div>
                            <label for="type" name="type_long" class="lblTitle">Larga</label>
                            <input type="radio" name="type" value="long">
                        </div>
                        <div>
                            <label for="type" name="type_short" class="lblTitle">Corta</label>
                            <input type="radio" name="type" value="short">
                        </div>
                    </div>
                </div>

                <div>
                    <label for="date_requests_start" name="date_requests_start" class="lblTitle">Fecha de inicio solicitudes</label>
                    <input type="date" name="date_requests_start" id="date_requests_start">
                    <br>

                    <label for="date_requests_end" name="date_requests_end" class="lblTitle">Fecha de fin solicitudes</label>
                    <input type="date" name="date_requests_end" id="date_requests_end">
                    <br>

                    <label for="date_baremation" name="date_baremation" class="lblTitle">Fecha de baremación / listados provisionales</label>
                    <input type="date" name="date_baremation" id="date_baremation">
                    <br>

                    <label for="date_definitive_lists" name="date_definitive_lists" class="lblTitle">Fecha de listas definitivas</label>
                    <input type="date" name="date_definitive_lists" id="date_definitive_lists">
                </div>

                <div>
                    <table name="items_baremables">
                        <thead>
                            <tr>
                                <th>Baremable</th>
                                <th>Nombre</th>
                                <th>Requisito</th>
                                <th>Valor mínimo</th>
                                <th>Valor máximo</th>
                                <th>Aporta alumno</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_items_baremable">
                            <?php
                            foreach ($arrItems as $item) {
                                echo '  <tr>
                                <td><input type="checkbox" name="baremable[]" value="' . $item->getId() . '"></td>
                                <td>' . $item->getName() . '</td>
                                <td><input type="checkbox" name="required' . $item->getId() . '" value="true"></td>
                                <td><input type="number" name="min_value' . $item->getId() . '" min="0" max="10"></td>
                                <td><input type="number" name="max_value' . $item->getId() . '" min="0" max="10"></td>
                                <td><input type="checkbox" name="contributes_student' . $item->getId() . '" value="true"></td>
                                </tr>
                            ';
                            }
                            ?>
                        </tbody>
                    </table>

                    <table name="language_levels">
                        <thead>
                            <tr>
                                <?php
                                foreach ($arrLanguages as $language) {
                                    echo '<th>' . $language->getId() . '</th>';
                                }
                                ?>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <?php
                                foreach ($arrLanguages as $language) {
                                    echo '<td> <input type="number" name="score_' . $language->getId() . '"> </td>';
                                }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <input type="submit" value="ENVIAR">
        </form>

        <div class="divBtn">
            <button>guardar</button>
            <button>borrar</button>
        </div>
    </div>
</div>