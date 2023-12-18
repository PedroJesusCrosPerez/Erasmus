<?php
//<img width="300px" heigth="150px" src="/var/www/html/cestero/jamon.jpg" alt="JAMON PATA NEGRA">
    require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
    use Dompdf\Dompdf;

    $html = '
        <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
                <title>Solicitud</title>
            </head>
            <body>
                <h2>Solicitud beca erasmus</h2>
                <p>DNI solicitud: '.$_POST["dni"].'</p>
            </body>
        </html>
        ';

    $dompdf = new Dompdf();
    // Cargamos el contenido HTML.
    $dompdf->loadhtml($html);
    $dompdf->setpaper("A4", "portrait");
    $dompdf->render();
    // Creamos un fichero
    $output = $dompdf->output();

    // $file_path = $_SERVER["DOCUMENT_ROOT"].'/pdfs/mipdf.pdf';
    // $file_path = 'C:/xampp/htdocs/Erasmus/pdfs/mipdf.pdf';
    $file_path = 'C:/xampp/htdocs/Erasmus/pdfs/solicitud.pdf';

    // Guardar el PDF en el directorio local
    file_put_contents($file_path, $output);
    echo $output;

?>