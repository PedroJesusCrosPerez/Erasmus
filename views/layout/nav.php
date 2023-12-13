<?php
echo '
<span> <img src="views/src/logos/logo.png" alt="logotipo erasmus fuentezuelas" width="60" heigth="60"> <h1>Convocatorias erasmus</h1> </span>
<ul>
    <li class="nav-item" id="menu-home">
        <b></b>
        <b></b>
        <a href="?menu=home">
            <span class="fa fa-home nav-icon"></span>
            <span class="nav-text">Inicio</span>
        </a>    
    </li>

    <li class="nav-item" id="menu-login">
        <b></b>
        <b></b>
        <a href="?menu=login">
            <span class="fa fa-coordinator nav-icon"></span>
            <span class="nav-text">Coordinador</span>
        </a>
    </li>

    <li class="nav-item" id="menu-list_convocatories">
        <b></b>
        <b></b>
        <a href="?menu=list_convocatories">
            <span class="fa fa-list_convocatories nav-icon"></span>
            <span class="nav-text">Listar</span>
        </a>
    </li>
    
    <!--<li class="nav-item" id="menu-complete_request">
        <b></b>
        <b></b>
        <a href="?menu=complete_request">
            <span class="fa fa-complete_request nav-icon"></span>
            <span class="nav-text">Rellenar solicitud</span>
        </a>
    </li>-->

';
// $user = Session::read("user");

// if ($user->getRole() == "coordinator") {
// if (isset($_GET["role"]) && $_GET["role"] == "coordinator") {
echo 
'
    <li class="nav-item" id="menu-create_convocatory">
        <b></b>
        <b></b>
        <a href="?menu=create_convocatory">
            <span class="fa fa-create_convocatory nav-icon"></span>
            <span class="nav-text">Crear</span>
        </a>
    </li>

    <li class="nav-item" id="menu-baremation">
        <b></b>
        <b></b>
        <a href="?menu=baremation">
            <span class="fa fa-baremation nav-icon"></span>
            <span class="nav-text">Baremación</span>
        </a>
    </li>
';
// }

echo '</ul>';

?>

<script>
window.addEventListener("load", function () {
    const navItems = document.querySelectorAll(".nav-item");

    function changeImages() {
    navItems.forEach((navItem) => {
        const icon = navItem.querySelector(".fa");
        const href = navItem.querySelector("a").getAttribute("href");
        
        // Extraer el valor después de "?menu="
        const menuParam = href.split("?menu=")[1];

        if (navItem.classList.contains("active")) {
            // icon.style.backgroundImage = `url(views/src/icons/${menuParam}-active.png)`;
            icon.style.backgroundImage = `url(views/src/icons/${menuParam}.png)`;
        } else {
            icon.style.backgroundImage = `url(views/src/icons/${menuParam}.png)`;
        }
    });
}


    navItems.forEach((navItem, i) => {
        navItem.addEventListener("click", () => {
            navItems.forEach((item, j) => {
                item.classList.remove("active");
            });
            navItem.classList.add("active");
            changeImages();
        });
    });

    // Obtener el parámetro 'menu' de la URL
    const params = new URLSearchParams(window.location.search);
    const menuParam = params.get('menu');

    // Activar el enlace correspondiente según el parámetro 'menu'
    if (menuParam) {
        const activeNavItem = document.getElementById(`menu-${menuParam}`);
        if (activeNavItem) {
            activeNavItem.classList.add("active");
            changeImages();
        }
    }
});
</script>
