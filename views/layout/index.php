<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="application-name" content="Proyecto HTML5, CSS3, javascript y PHP">
    <meta name="author" content="Pedro Jesús Cros Pérez">
    <meta name="description" content="Proyecto utilizando lenguajes HTML5, CSS3, javascript y PHP">
    <meta name="generator" content="Visual Studio Code">
    <meta name="keywords" content="proyecto, html, css, javascript, php, formulario, erasmus, login, crud convocatory">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<base href="views/src" target="_blank">-->
    <link rel="shortcut icon" href="views/src/icons/favicon.ico" type="image/x-icon">
    <title>Erasmus I.E.S. Fuentezuelas</title>

    <!-- CSS3 -->
    <link rel="stylesheet" href="views/layout/css/resetstyle.css">
    <link rel="stylesheet" href="views/layout/css/styleLayout.css">
    <link rel="stylesheet" href="views/layout/css/styleCosmetic.css">

    <!-- JS -->
    <script src="helpersJS/Validator.js"></script>
    <script src="views/layout/js/nav.js"></script>
</head>

<body>
    
    <main>
        <nav class="main-menu">
            <?php
            require $_SERVER["DOCUMENT_ROOT"] . "/views/layout/nav.php";
            ?>
        </nav>

        <section class="content">
            <div class="content-background">
                <?php
                require_once $_SERVER["DOCUMENT_ROOT"] . "/views/Router.php";
                ?>
            </div>
        </section>

    </main>

</body>

</html>