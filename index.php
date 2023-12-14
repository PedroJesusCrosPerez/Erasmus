<?php

class Main
{
    public static function main()
    {
        require_once $_SERVER["DOCUMENT_ROOT"]."/helpers/Autoload.php";
        require_once $_SERVER["DOCUMENT_ROOT"]."/views/layout/index.php";
    }
}
Main::main();

/**
 * Mostrar listados provisionales, y listados definitivos
 */

?>