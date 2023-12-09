<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han enviado archivos
    if (isset($_FILES["file"])) {
        // Directorio donde se guardarán los archivos
        $uploadDir = __DIR__ . '/uploads/';

        $dni = isset($_POST["dni"]) ? $_POST["dni"] : "78162647E";
        $request_id = 123456789;
        $convocatory_id = isset($_GET["convocatory_id"]) ? $_GET["convocatory_id"] : "987";
        $serverDir = $_SERVER["DOCUMENT_ROOT"] . "/uploads/";

        foreach ($_FILES["file"]["name"] as $id => $filename) {
            $tmp_name = $_FILES["file"]["tmp_name"][$id];
            $name = basename($filename);
            $file_extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));

            if ($id === 'photo') {
                // Condición para el primer archivo (foto)
                $allowed_extensions_first = array("jpeg", "jpg", "png");
                if (in_array($file_extension, $allowed_extensions_first)) {
                    $name = $dni . '_' . $convocatory_id . '_' . $name;
                    $targetDir = $uploadDir . "photos/";
                    move_uploaded_file($tmp_name, $targetDir . $name);
                    echo "Foto del candidato subida correctamente.<br>";
                } else {
                    echo "La extensión de la foto del candidato no es válida. Se permiten solo extensiones JPEG, JPG o PNG.<br>";
                }
            } else {
                // Condición para archivos restantes (documentos)
                if ($file_extension == "pdf") {
                    $name = $request_id . '_' . $name;
                    $targetDir = $uploadDir . "documents/";
                    move_uploaded_file($tmp_name, $targetDir . $name);
                    echo "Documento con ID $id subido correctamente.<br>";
                } else {
                    echo "La extensión del documento no es válida. Se permite solo la extensión PDF.<br>";
                }
            }
        }
    } else {
        echo "No se han enviado archivos.";
    }
}
?>