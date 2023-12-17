<?php

echo 
'
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
';

if ( Login::isLoged() ) {
    echo '
        <li class="nav-item" id="menu-logout">
            <b></b>
            <b></b>
            <a href="?menu=logout">
                <span class="fa fa-logout nav-icon"></span>
                <span class="nav-text">Cerrar sesión</span>
            </a>
        </li>
        
        <li class="nav-item" id="menu-create_convocatory">
            <b></b>
            <b></b>
            <a href="?coordinator=create_convocatory">
                <span class="fa fa-create_convocatory nav-icon"></span>
                <span class="nav-text">Crear</span>
            </a>
        </li>

        <li class="nav-item" id="menu-baremation">
            <b></b>
            <b></b>
            <a href="?coordinator=baremation">
                <span class="fa fa-baremation nav-icon"></span>
                <span class="nav-text">Baremación</span>
            </a>
        </li>
    ';
    // }

    echo '</ul>';
}

?>