<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="views/layout/css/resetstyle.css">
    <link rel="stylesheet" href="views/layout/css/style_layout.css">
    <link rel="stylesheet" href="views/layout/css/styleCosmetic.css">
    <!--<link rel="stylesheet" href="css/responsive.css">-->
    <!-- <script src="views/layout/js/js2.js"></script> -->
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