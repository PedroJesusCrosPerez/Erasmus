<?php
// $thisdir = $_SERVER["DOCUMENT_ROOT"]."/views/coordinator/create_convocatory/";
$thisdir = "/views/coordinator/create_convocatory/";

$arrProjects = DBProject::findAll();
$arrGroups = DBGroup::findAll();

echo '
<head>
  <title>Formulario Pedro</title>

  <!-- JAVASCRIPT -->
  <script type="text/javascript" src="'.$thisdir.'js/FormElement.js" charset="utf-8" defer></script>
  <script type="text/javascript" src="'.$thisdir.'js/functions.js" charset="utf-8" defer></script>
  <script type="text/javascript" src="'.$thisdir.'js/listeners.js" charset="utf-8" defer></script>

  <!-- CSS3 -->
  <link rel="stylesheet" href="'.$thisdir.'css/hojaReseteoEstilosCss.css"> <!-- Hoja de reseteo de estilos CSS -->
  <link rel="stylesheet" href="'.$thisdir.'css/structure.css"> <!-- Esqueleto de la web -->
  <link rel="stylesheet" href="'.$thisdir.'css/estiloPosicionamiento.css"> <!-- Posicionamiento con flexbox. Además introduzco paddings y margin donde cuadrar los contenedores a mi gusto personal -->
  <link rel="stylesheet" href="'.$thisdir.'css/estiloEstetica.css"> <!-- Detalles estéticos de la web: colores, fondos, tamaño y fuentes de letra -->
</head>

  <div class="form-container">

    <div id="topButton-container">
      <button class="topButton" id="btnInformation"></button>
      <p>Información</p>
      <button class="topButton" id="btnDates"></button>
      <p>Fechas</p>
      <button class="topButton" id="btnItems"></button>
      <p>Items baremables</p>
    </div>


    <h2 id="h2Titulo">Identificación</h2>

    <form name="request" action="createConvocatory.php" method="post"> <!--accept-charset="utf-8" autocomplete="off" enctype="multipart/form-data" formtarget="_blank" formnovalidate="formnovalidate">-->
      <!-- Formulario Identificación - START -->
      <div id="information">

        <label for="project">Proyecto:</label>
        <select name="project">
          <option value="null" disabled selected>Selecciona el proyecto al que pertenece</option>
          ';
          foreach ($arrProjects as $project) {
            echo '<option value="'.$project->getId().'">'.$project->getName().'</option>';
          }
          echo '
        </select>
        <label for="project" class="inputError" id="projectError"></label>
        
        <label for="country">País:</label>
        <input type="text" name="country" maxlength="40">
        <label for="country" class="inputError" id="countryError"></label>

        <label for="group">Destinatarios:</label>
        <select name="group">
          <option value="null">Selecciona un grupo</option>
          ';
          foreach ($arrGroups as $group) {
            echo '<option value="'.$group->getId().'">'.$group->getName().'</option>';
          }
          echo '
        </select>
        <label for="group" class="inputError" id="groupError"></label>

        <label for="movilities">Núero de movilidades:</label>
        <input type="number" name="movilities" value="1" min="1" max="30">
        <label for="movilities" class="inputError" id="movilitiesError"></label>

        <div name="divType">
          <label for="type" name="type">Tipo</label>
          <div>
            <label for="type" name="type_long">Larga</label>
            <input type="radio" name="type" value="long">
          </div>
          <div>
            <label for="type" name="type_short">Corta</label>
            <input type="radio" name="type" value="short">
          </div>
        </div>
        <label for="type" class="inputError" id="typeError"></label>

        <button type="button" id="btnInformationNext">Siguiente</button>

        <label for="feedback" id="feedback">¡¡Tú formulario se ha enviado correctamente!!</label>
      </div>
      <!-- Formulario Identificación - END -->

      <!-- Formulario Domicilio - START -->
      <div id="dates">

        <label for="date_requests_start" name="date_requests_start">Fecha de inicio solicitudes</label>
        <input type="date" name="date_requests_start" id="date_requests_start">
        <label for="date_requests_start" class="inputError" id="date_requests_startError"></label>

        <label for="date_requests_end" name="date_requests_end">Fecha de fin solicitudes</label>
        <input type="date" name="date_requests_end" id="date_requests_end">
        <label for="date_requests_end" class="inputError" id="date_requests_endError"></label>

        <label for="date_baremation" name="date_baremation">Fecha de baremación / listados provisionales</label>
        <input type="date" name="date_baremation" id="date_baremation">
        <label for="date_baremation" class="inputError" id="date_baremationError"></label>

        <label for="date_definitive_lists" name="date_definitive_lists">Fecha de listas definitivas</label>
        <input type="date" name="date_definitive_lists" id="date_definitive_lists">
        <label for="date_definitive_lists" class="inputError" id="date_definitive_listsError"></label>

        <button type="button" id="btnDatesBefore">Anterior</button>
        <button type="button" id="btnDatesNext">Siguiente</button>

      </div>
      <!-- Formulario Domicilio - END -->

      <!-- Formulario Otros - START -->
      <div id="items">

        <table>
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
          <tbody id="tbody_items_batemable">
            <tr>
              <td><input type="checkbox" name="baremable[]"></td>
              <td>Expediente <input type="number" name="id[]" value="1"></td>
              <td><input type="checkbox" name="required[]"></td>
              <td><input type="number" name="min_value[]" min="0" max="10"></td>
              <td><input type="number" name="max_value[]" min="0" max="10"></td>
              <td><input type="checkbox" name="contributes_student[]"></td>
            </tr>
            <tr>
              <td><input type="checkbox" name="baremable[]"></td>
              <td>Idiomas <input type="number" name="id[]" value="2"></td>
              <td><input type="checkbox" name="required[]"></td>
              <td><input type="number" name="min_value[]" min="0" max="10"></td>
              <td><input type="number" name="max_value[]" min="0" max="10"></td>
              <td><input type="checkbox" name="contributes_student[]"></td>
            </tr>
            <tr>
              <td><input type="checkbox" name="baremable[]"></td>
              <td>Entrevista <input type="number" name="id[]" value="3"></td>
              <td><input type="checkbox" name="required[]"></td>
              <td><input type="number" name="min_value[]" min="0" max="10"></td>
              <td><input type="number" name="max_value[]" min="0" max="10"></td>
              <td><input type="checkbox" name="contributes_student[]"></td>
            </tr>
            <tr>
              <td><input type="checkbox" name="baremable[]"></td>
              <td>Idoneidad <input type="number" name="id[]" value="4"></td>
              <td><input type="checkbox" name="required[]"></td>
              <td><input type="number" name="min_value[]" min="0" max="10"></td>
              <td><input type="number" name="max_value[]" min="0" max="10"></td>
              <td><input type="checkbox" name="contributes_student[]"></td>
            </tr>
          </tbody>
        </table>

        <button type="button" id="btnItemsBefore">Anterior</button>
        <!--<button type="button" id="btnItemsSend">ENVIAR</button>-->
        <input type="submit" value="ENVIAR" name="submit">
      </div>
      <!-- Formulario Otros - END -->

    </form>

  </div>
';
?>