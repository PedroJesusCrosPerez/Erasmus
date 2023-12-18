<?php

    // ####################################################################################################################################################################################
    // ########################################################## ENVIAR CORREO ADJUNTADO PDF #############################################################################################
    // ####################################################################################################################################################################################
    // Cargar la clase Request
    require_once $_SERVER["DOCUMENT_ROOT"] . "/entities/Request.php";
    
    use GuzzleHttp\Client;
    require_once $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";
    
    $destinatario = "pedrojcros@gmail.com";
    $asunto = "Solicitud beca erasmus";
    $cuerpo = "Hola cuerpo";
    
    $client = new Client();
    
    $clave = "request";
    $request = $_SESSION[$clave] ?? null;
    
    // Verifica si el objeto $request tiene el método toArray
    if ($request instanceof Request) {
        $requestData = $request->jsonSerialize();
    } else {
        // Si no es una instancia de Request, maneja el error según tus necesidades
        echo "Error: El objeto no es una instancia válida de la clase Request";
        exit;
    }
    
    try {
        $response = $client->request('POST', 'http://serverpedroerasmus/api/apiCreatePDF.php', [
            'form_params' => $requestData,
        ]);
    
        $pdf = $response->getBody();
        // echo $pdf;
    
        // file_put_contents($_SERVER["DOCUMENT_ROOT"].'/pdfs/mipdf.pdf', $pdf);
        file_put_contents($_SERVER["DOCUMENT_ROOT"].'/pdfs/solicitud.pdf', $pdf);
        
        // header('Content-Type: application/pdf');
        // header('Content-Disposition: attachment; filename="mipdf.pdf"');
        
        
        // ############################################################
        // ################## ENVIAR CORREO ###########################
        // ############################################################
        require_once $_SERVER["DOCUMENT_ROOT"]."/helpers/ServicioCorreos.php";
        
        $asunto = "Solicitud becas erasmus - ".$request->getName();
        $cuerpo = "ID solicitud: ".$request->getConvocatory_id() . "<br>" . "Contraseña: ".$request->getDni();

        $correo = new ServicioCorreos($request->getEmail(), $asunto, $cuerpo, $pdf);
        $correo->enviar();
    } catch (Exception $e) {
        echo "Error al realizar la solicitud: " . $e->getMessage();
    }
    
?>