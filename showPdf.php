<?php
// $pdfPath = "C:\Users\pedro\Documents\idoneidad.pdf";
// $pdfPath = "C:/xampp/htdocs/erasmus/uploads/documents/19-4-2-12345645A-HeavenTicket.pdf";
// $pdfPath = "uploads/documents/19-4-2-12345645A-HeavenTicket.pdf";
$pdfPath = $_GET["url_idoneidad"];
echo '<embed src="'.$pdfPath.'" type="application/pdf" width="400" height="300px" />';

?>