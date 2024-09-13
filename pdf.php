<?php

require_once 'app/config.php';

//Validar que existen cotizaciones y el paramettro $_GET number
if (!isset($_GET['number'])) {
    redirect('index.php?error=invalid_number');
}

//Si no hay cotizaciones
$quotes = get_all_quotes();
if (empty($quotes)) {
    redirect('index.php?error=no_quotes');
}

//Buscar el match del folio
$number = trim($_GET['number']);
$file = sprintf(UPLOADS.'coty_%s.pdf', $number);

if (!is_file($file)) {
    //No existe cotización
    redirect(sprintf('index.php?error=not_found'));
}

//Descarga
header('Content-Type: application/pdf');
header(sprintf('Content-Disposition: attachment;filename=%s', pathinfo($file, PATHINFO_BASENAME)));
readfile($file);
