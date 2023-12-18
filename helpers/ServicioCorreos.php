<?php

use PHPMailer\PHPMailer\PHPMailer;
require_once $_SERVER["DOCUMENT_ROOT"]."/vendor/autoload.php";

class ServicioCorreos {
    private $asunto;
    private $descripcion;
    private $destinatario;
    private $pdf;

    public function __construct($destinatario = null, $asunto = "asunto", $descripcion = "descripción", $pdf = null) {
        $this->asunto = $asunto;
        $this->descripcion = $descripcion;
        $this->destinatario = $destinatario;
        $this->pdf = $pdf;
    }

    public function enviar() {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        // $mail->SMTPDebug  = 2;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "tls";
        $mail->Host       = "smtp.gmail.com";
        $mail->Port       = 587;
        $mail->Username   = "pcroper1909@g.educaand.es";
        $mail->Password   = "ogjp yubs muot jvsj";
        $mail->SetFrom('pcroper1909@g.educaand.es', 'Solicitud beca erasmus');
        $mail->Subject    = $this->asunto;
        // $mail->addAttachment($_SERVER["DOCUMENT_ROOT"]."/pdfs/mipdf.pdf");
        // $mail->addAttachment('C:/xampp/htdocs/Erasmus/pdfs/mipdf.pdf');
        $mail->addAttachment('C:/xampp/htdocs/Erasmus/pdfs/solicitud.pdf');
        // $mail->addAttachment($this->pdf);
        $mail->MsgHTML($this->descripcion); //$this->descripcion
        $address = $this->destinatario;
        $mail->AddAddress($address, "Pedro Jesús Cros Pérez");

        $result = $mail->Send();
        
        if(!$result) {
            return "Error en ServicioCorreo.php:39 ==> " . $mail->ErrorInfo;
        } else {
            return "Enviado<br>";
        }
    }
}

?>