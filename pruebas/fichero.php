<?php
    // Verificar si se han enviado datos del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar si se han seleccionado elementos en el checkbox
        if (isset($_POST["baremable"]) && is_array($_POST["baremable"])) {
            echo "<h2>Elementos seleccionados:</h2>";
            echo "<ul>";
            
            // Iterar sobre los elementos seleccionados
            foreach ($_POST["baremable"] as $item) {
                // Mostrar el id del elemento
                echo "<li>Item $item (ID: $item)</li>";
            }

            echo "</ul>";
        } else {
            echo "<p>No se han seleccionado elementos</p>";
        }
    }
?>