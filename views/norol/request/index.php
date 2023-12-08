<?php
$thisdir = "views/norol/request/";

echo '
<head>
  <title>Rellenar solicitud</title>

  <!-- JAVASCRIPT -->
  <script type="text/javascript" src="'.$thisdir.'js/FormElement.js" charset="utf-8" defer></script> <!-- Elementos del html pasados a javascript -->
  <script type="text/javascript" src="'.$thisdir.'js/functions.js" charset="utf-8" defer></script><!--  --> <!--<script type="text/javascript" src="script/programa.js" charset="utf-8" defer></script><!---->
  <script type="text/javascript" src="'.$thisdir.'js/listeners.js" charset="utf-8" defer></script><!--  -->
  <!-- <script type="text/javascript" src="js/Validator.js" charset="utf-8" defer></script> -->
  <!-- <script src="js/inputJs.js"></script> -->

  <!-- CSS3 -->
  <link rel="stylesheet" href="'.$thisdir.'css/styleStructure.css"> <!-- Esqueleto de la web -->
  <link rel="stylesheet" href="'.$thisdir.'css/stylePositioning.css"> <!-- Posicionamiento con flexbox. Además introduzco paddings y margin donde cuadrar los contenedores a mi gusto personal -->
  <link rel="stylesheet" href="'.$thisdir.'css/styleCosmetic.css"> <!-- Detalles estéticos de la web: colores, fondos, tamaño y fuentes de letra -->
  <link rel="stylesheet" href="'.$thisdir.'css/inputStyle.css">
</head>

<!--
  1º Datos personales
   - name
   - apellidos
   - dni
   - fecha nacimiento,
   - foto

  2º Contacto
   - teléfono
   - email
   - dirección

  3º Subir ficheros
   - Los ficheros a subir se consultarán en la DB con PHP
-->
<div class="form-container">

<div id="topButton-container">
    <button class="topButton" id="btnIdentificacion"></button>
    <p>Identificación</p>
    <button class="topButton" id="btnDomicilio"></button>
    <p>Contacto</p>
    <button class="topButton" id="btnUploadFiles"></button>
    <p>Subir documentos</p>
</div>

<h2 id="h2Titulo">Identificación</h2>

<form name="request" action="createRequest.php" accept-charset="utf-8" autocomplete="off" enctype="multipart/form-data" method="post" formtarget="_blank" formnovalidate="formnovalidate">
    <!-- Formulario Identificación - START -->
    <div id="identificacion">

    <label for="name">Nombre:</label>
    <input type="text" name="name" autofocus maxlength="40">
    <label for="name" class="inputError" id="nameError"></label>
    
    <label for="surname">Apellidos:</label>
    <input type="text" id="surname" name="surname" maxlength="40">
    <label for="surname" class="inputError" id="surnameError"></label>

    <label for="dni" id="lblDni">DNI:</label>
    <input type="text" id="dni" name="dni" maxlength="9">
    <label for="dni" class="inputError" id="dniError"></label>

    <label for="birthdate" id="lblFecha_nac" class="fecha_nac">Fecha Nacimiento:</label>
    <input type="date" id="birthdate" class="fecha_nac" name="birthdate" autofocus maxlength="10">
    <label for="birthdate" class="inputError fecha_nac" id="birthdateError"></label>
    
    <label for="photo" id="lblPhoto">Fotografía:</label>
    <!-- <input type="file" name="photo"> -->
    <div class="container-input" name="photo">
        <input type="file" name="file-7" id="file-7" class="inputfile inputfile-7" data-multiple-caption="{count} archivos seleccionados" multiple />
        <label for="file-7">
        <span class="iborrainputfile"></span>
        <strong>
        <svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
        Seleccionar archivo
        </strong>
        </label>
        </div>
    <label for="photo" class="inputError" id="photoError"></label>

    <!-- <button type="button" id="btnViewImage">Visualizar imágen</button> -->

    <button type="button" id="ideSiguiente">Siguiente</button>

    <label for="feedback" id="feedback">¡¡Tú formulario se ha enviado correctamente!!</label>
    </div>
    <!-- Formulario Identificación - END -->

    <!-- Formulario Domicilio - START -->
    <div id="domicilio">

    <label for="lblDireccion">Dirección:</label>
    <input type="text" id="direccion" name="direccion" autofocus maxlength="40">
    <label for="direccion" class="inputError" id="direccionError"></label>

    <label for="email">Correo electrónico:</label>
    <input type="email" id="email" name="email">
    <label for="email" class="inputError" id="emailError"></label>

    <label for="telefono" class="telefono">Teléfono:</label>
    <input type="text" id="telefono" class="telefono" name="telefono" maxlength="9">
    <label for="telefono" class="inputError telefono" id="telefonoError"></label>

    <button type="button" id="btnDomiAnterior">Anterior</button>
    <button type="button" id="btnDomiSiguiente">Siguiente</button>

    </div>
    <!-- Formulario Domicilio - END -->

    <!-- Formulario Subir archivos - START -->
    <div id="uploadFiles">

    

    <button type="button" id="btnUploadFilesAnterior">Anterior</button>
    <button type="button" id="btnUploadFilesEnviar">ENVIAR</button>

    </div>
    <!-- Formulario Subir archivos - END -->

</form>

</div>

<script>
  "use strict";

  ;
  (function (document, window, index) {
      var inputs = document.querySelectorAll(".inputfile");
      Array.prototype.forEach.call(inputs, function (input) {
          var label = input.nextElementSibling,
              labelVal = label.innerHTML;

          input.addEventListener("change", function (e) {
              var fileName = "";
              if (this.files && this.files.length > 1)
                  fileName = (this.getAttribute("data-multiple-caption") || "").replace(
                      "{count}", this.files.length);
              else
                  fileName = e.target.value.split("\\").pop();

              if (fileName)
                  label.querySelector("span").innerHTML = fileName;
              else
                  label.innerHTML = labelVal;
          });
      });
  }(document, window, 0));
</script>
';
?>