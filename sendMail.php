<?php

    // ####################################################################################################################################################################################
    // ########################################################## ENVIAR CORREO ADJUNTADO PDF #############################################################################################
    // ####################################################################################################################################################################################
    $destinatario = "pedrojcros@gmail.com";
    $asunto = "Solicitud beca erasmus";
    $cuerpo = "Hola cuerpo";

    use GuzzleHttp\Client;
    require_once $_SERVER["DOCUMENT_ROOT"]."/vendor/autoload.php";
        
    $client = new Client();
    // $request = Session::read("request");
    $clave = "request";
    $request = $_SESSION[$clave] ?? null;
    $response = $client->request('POST', 'http://localhost/correo/api/apiCreatePDF.php', [
        'form_params' => $request,
    ]);
    $cuerpo = $request->myToString();

    $pdf = $response->getBody();
    
    // file_put_contents($_SERVER["DOCUMENT_ROOT"].'/pdfs/mipdf.pdf', $pdf);
    file_put_contents($_SERVER["DOCUMENT_ROOT"].'/pdfs/solicitud.pdf', $pdf);
    
    // header('Content-Type: application/pdf');
    // header('Content-Disposition: attachment; filename="mipdf.pdf"');
    
    
    // ############################################################
    // ################## ENVIAR CORREO ###########################
    // ############################################################
    require_once $_SERVER["DOCUMENT_ROOT"]."/helpers/ServicioCorreos.php";
    
    $correo = new ServicioCorreos($destinatario, $asunto, $cuerpo, $pdf);
    $correo->enviar();
    
?>