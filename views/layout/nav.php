<?php
echo '
<h1>Becas erasmus</h1>
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
            <span class="fa fa-user nav-icon"></span>
            <span class="nav-text">Perfil</span>
        </a>
    </li>

    <li class="nav-item" id="menu-create_convocatory">
        <b></b>
        <b></b>
        <a href="?menu=create_convocatory">
            <span class="fa fa-create_convocatory nav-icon"></span>
            <span class="nav-text">Crear convocatoria beca</span>
        </a>
    </li>

    <li class="nav-item" id="menu-becas">
        <b></b>
        <b></b>
        <a href="?menu=becas">
            <span class="fa fa-list_becas nav-icon"></span>
            <span class="nav-text">Listado de becas</span>
        </a>
    </li>

    <!--<li class="nav-item">
        <a href="#">
            <i class="fa fa-person-running nav-icon"></i>
            <span class="nav-text">Activities</span>
        </a>
    </li>-->
</ul>
';
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
            //icon.style.backgroundImage = `url(views/src/icons/${menuParam}-active.png)`;
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
