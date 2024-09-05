<?php
require_once 'app/config.php';

//Namespace
use Dompdf\Dompdf;

$pdf = new Dompdf();
$pdf -> loadHtml('<h1>Hola Mundo</h1>');

$pdf->setPaper('A4');

$pdf->render();

$pdf->stream(time().'.pdf');
?>