<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/helpers/Autoload.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

    // Datos de identificación
    $dni =          isset($_POST["dni"])        ? $_POST["dni"]         : null;
    $name =         isset($_POST["name"])       ? $_POST["name"]        : null;
    $surname =      isset($_POST["surname"])    ? $_POST["surname"]     : null;
    $birthdate =    isset($_POST["birthdate"])  ? $_POST["birthdate"]   : null;
    $photo = null;
    $convocatory_id = 19; // TODO variable temporal

    // Datos de contacto
    $group =    isset($_POST["group"])      ? $_POST["group"]   : null;
    $phone =    isset($_POST["phone"])      ? $_POST["phone"]   : null;
    $email =    isset($_POST["email"])      ? $_POST["email"]   : null;
    $address =  isset($_POST["address"])    ? $_POST["address"] : null;

    // Datos archivos subidos
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    // Verificar si se han enviado archivos
    if (isset($_FILES["file"])) {
        // Directorio donde se guardarán los archivos
        $uploadDir = $_SERVER["DOCUMENT_ROOT"] . '/uploads/';

        if (count($_FILES["file"]["name"]) > 0) {
            // Obtener información del primer archivo
            $tmp_name = $_FILES["file"]["tmp_name"][0];
            $name = basename($_FILES["file"]["name"][0]);
            $file_extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));

            // Verificar si la extensión es JPEG, PNG o JPG
            $allowed_extensions_first = array("jpeg", "jpg", "png");
            if (in_array($file_extension, $allowed_extensions_first)) {
                // Mover el archivo al directorio de destino
                $photo = $uploadDir . "photos/" . $name;
                move_uploaded_file($tmp_name, $photo);

                // Iterar sobre cada archivo restante si es necesario
                foreach ($_FILES["file"]["name"] as $id => $filename) {
                    $tmp_name = $_FILES["file"]["tmp_name"][$id];
                    $name = basename($filename);
                    $file_extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));

                    // Verificar si la extensión es PDF
                    if ($file_extension == "pdf") {
                        $document = $uploadDir . "documents/" . $name;
                        move_uploaded_file($tmp_name, $document);
                    } else {
                        echo "La extensión de la foto del candidato no es válida. Se permiten solo extensiones PDF.";
                    }
                }

                echo "Archivos subidos correctamente.<br>";
            } else {
                echo "La extensión del primer archivo no es válida. Se permiten solo extensiones JPEG, JPG o PNG.";
            }
        } else {
            echo "No se han enviado archivos.";
        }
    }
    // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<


    $request = new Request(
        null,
        $dni,
        $name,
        $surname,
        $birthdate,
        $group,
        $phone,
        $email,
        $address,
        $photo,
        $convocatory_id
    );

    echo $request;
} else {
    // Si alguien intenta acceder directamente a este archivo sin enviar datos por POST,
    // puedes redirigirlo a la página principal o mostrar un mensaje de error.
    // header("Location: index.php");
    echo "Error, el método de petición no ha sido POST";
    exit();
}

?>
