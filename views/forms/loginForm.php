<?php
$thisdir = "views/forms";
?>
<head>
    <link rel="stylesheet" href="<?php echo $thisdir?>/css/styleForm.css">
</head>

<!-- Login Form - START -->
<div class="form-container">

    <h2 id="h2Titulo">Iniciar sesión</h2>

    <form name="examinator-login" accept-charset="utf-8" autocomplete="off" enctype="multipart/form-data"
    method="post" formtarget="_blank" formnovalidate="formnovalidate" action="?menu=actionLogin">

    <!-- Login form - START -->
    <div name="examinatorForm" name="login">

        <label for="name">Nombre:</label>
        <input type="text" name="name" autofocus maxlength="45" require>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" maxlength="45" require>

        <label for="login" class="feedback" name="feedback"></label>
        <input type="submit" value="Iniciar sesión" name="login">
        <!--<label for="feedback" id="feedback">¡¡Tú formulario se ha enviado correctamente!!</label>-->

        <a href="?menu=forgotpassword" name="aForgotPassword">Olvidé contraseña</a>
        <a href="?menu=signup" name="aSignUp">Registro</a>
        
    </div>
    <!-- Login form - END -->
    </form>

</div>
<!-- Login Form - END -->