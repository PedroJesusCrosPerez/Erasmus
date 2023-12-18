<?php
// include_once $_SERVER["DOCUMENT_ROOT"]."/helpers/Autoload.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/entities/Request.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/repository/DB.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/repository/DBRequest.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // Datos de identificación
    $dni =          isset($_POST["dni"])        ? $_POST["dni"]         : null;
    $name =         isset($_POST["name"])       ? $_POST["name"]        : null;
    $surname =      isset($_POST["surname"])    ? $_POST["surname"]     : null;
    $birthdate =    isset($_POST["birthdate"])  ? $_POST["birthdate"]   : null;
    $photo = isset($_POST["photo"])  ? $_POST["photo"]   : null;
    $convocatory_id = 19; // TODO variable temporal
    $request_id = 123456789; // TODO variable temporal

    // Datos de contacto
    $group =    isset($_POST["group"])      ? $_POST["group"]   : null;
    $phone =    isset($_POST["phone"])      ? $_POST["phone"]   : null;
    $email =    isset($_POST["email"])      ? $_POST["email"]   : null;
    $address =  isset($_POST["address"])    ? $_POST["address"] : null;

    // Datos archivos subidos
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    $arrItems = null;
    // Verificar si se han enviado archivos
    if (isset($_FILES["file"])) {
        // Directorio donde se guardarán los archivos
        $serverDir = $_SERVER["DOCUMENT_ROOT"] . "/uploads/";
        $uploadDir = $serverDir;

        foreach ($_FILES["file"]["name"] as $id => $fileName) {
            $tmp_name = $_FILES["file"]["tmp_name"][$id];
            $thisFileName = basename($fileName);
            $file_extension = strtolower(pathinfo($thisFileName, PATHINFO_EXTENSION));

            // if ($id == 'photo') {
            //     // Condición para el primer archivo (foto)
            //     $allowed_extensions_first = array("jpeg", "jpg", "png");
            //     if (in_array($file_extension, $allowed_extensions_first)) {
            //         $thisFileName = $convocatory_id . "-" . $dni . '-' . $thisFileName;
            //         $targetDir = $uploadDir . "photos/";
            //         $targetFile = $targetDir . $thisFileName;
            //         move_uploaded_file($tmp_name, $targetFile);
            //         // echo "Foto del candidato subida correctamente.<br>";
            //         // $arrItems["photo"] = $targetFile;
            //         $photo = $targetFile;
            //     } else {
            //         // echo "La extensión de la foto del candidato no es válida. Se permiten solo extensiones JPEG, JPG o PNG.<br>";
            //     }
            // } else {
                // Condición para archivos restantes (documentos)
                if ($file_extension == "pdf") {
                    $thisFileName = $convocatory_id . "-request_id-" . $id . "-" . $dni . '-' . $thisFileName;
                    $targetDir = $uploadDir . "documents/";
                    $targetFile = $targetDir . $thisFileName;
                    // move_uploaded_file($tmp_name, $targetFile);
                    // echo "Documento con ID $id subido correctamente.<br>";
                    $arrItems[$id]["targetFile"] = $targetFile;
                    $arrItems[$id]["tmp_name"] = $tmp_name;
                } else {
                    // echo "La extensión del documento no es válida. Se permite solo la extensión PDF.<br>";
                }
            // }
        }

    }
    // $result = str_replace("request_id", $request_id, $text);
    // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

    // $photoBase64 = base64_encode(file_get_contents($photo));
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

    DBRequest::insert($request, $arrItems);
    // var_dump($request);


    // ####################################################################################################################################################################################
    // ########################################################## ENVIAR CORREO ADJUNTADO PDF #############################################################################################
    // ####################################################################################################################################################################################
    // $destinatario = "pedrojcros@gmail.com";
    // $asunto = "Solicitud beca erasmus";
    // $cuerpo = "Hola cuerpo";

    // // require_once $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";
    // // require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

    // use GuzzleHttp\Client;
    // $client = new Client();
    // // $data = [
    // //     'key1' => 'value1',
    // //     'key2' => 'value2'
    // // ];
    // $response = $client->request('POST', 'http://localhost/correo/api/apiCreatePDF.php', [
    //     'form_params' => $request,
    // ]);

    // $pdf = $response->getBody();

    // file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/correo/pdfs/mipdf.pdf', $pdf);

    // // header('Content-Type: application/pdf');
    // // header('Content-Disposition: attachment; filename="mipdf.pdf"');

    // // ############################################################
    // // ################## ENVIAR CORREO ###########################
    // // ############################################################
    // require_once $_SERVER["DOCUMENT_ROOT"] . "/helpers/ServicioCorreos.php";

    // $correo = new ServicioCorreos($destinatario, $asunto, $cuerpo, $pdf);
    // $correo->enviar();

    // require_once $_SERVER["DOCUMENT_ROOT"]."/helpers/Session.php";
    // Session::save("request", $request);
    $clave = "request";
    $valor = $request;
    $_SESSION[$clave] = $valor;
    require_once $_SERVER["DOCUMENT_ROOT"]."/sendMail.php";
} else {
    // Si alguien intenta acceder directamente a este archivo sin enviar datos por POST,
    // puedes redirigirlo a la página principal o mostrar un mensaje de error.
    // header("Location: index.php");
    echo "Error, el método de petición no ha sido POST";
    // exit();
}
?>
