<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="views/layout/css/resetstyle.css">
    <link rel="stylesheet" href="views/layout/css/style_layout.css">
    <!--<link rel="stylesheet" href="css/responsive.css">-->
    <script src="views/layout/js/js.js"></script>
</head>

<body>

    <main>
        <nav class="main-menu">
            <h1>Becas erasmus</h1>
            <ul>
                <li class="nav-item active">
                    <b></b>
                    <b></b>
                    <!-- <a href="?menu=landingpage"> --><a href="#">
                        <span class="fa fa-home nav-icon"></span>
                        <span class="nav-text">Home</span>
                    </a>
                </li>

                <li class="nav-item">
                    <b></b>
                    <b></b>
                    <!-- <a href="?menu=login"> --><a href="#">
                        <span class="fa fa-user nav-icon"></span>
                        <span class="nav-text">Profile</span>
                    </a>
                </li>

                <li class="nav-item">
                    <b></b>
                    <b></b>
                    <a href="?menu=coordinator">
                        <span class="fa fa-settings nav-icon"></span>
                        <span class="nav-text">Settings</span>
                    </a>
                </li>

                <li class="nav-item">
                    <b></b>
                    <b></b>
                    <a href="?menu=becas">
                        <span class="fa fa-becas nav-icon"></span>
                        <span class="nav-text">Becas</span>
                    </a>
                </li>

                <!--<li class="nav-item">
                    <a href="#">
                        <i class="fa fa-person-running nav-icon"></i>
                        <span class="nav-text">Activities</span>
                    </a>
                </li>-->
            </ul>
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