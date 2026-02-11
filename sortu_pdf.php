<?php
session_start();
include "Konexioa.php";

if (!isset($_POST['eskaera_id'])) {
    die("Errorea: Eskaera ID falta da");
}

$eskaera_id = (int)$_POST['eskaera_id'];

$java_programa = "java -jar ruta/al/programa.jar";
$pdf_karpeta = "fakturak/";
$pdf_fitxategia = $pdf_karpeta . "faktura_" . $eskaera_id . ".pdf";

if (!file_exists($pdf_karpeta)) {
    mkdir($pdf_karpeta, 0777, true);
}

$komandoa = "$java_programa $eskaera_id $pdf_fitxategia";
exec($komandoa, $irteera, $return_var);

if ($return_var !== 0) {
    die("Errorea: Ezin izan da PDFa sortu");
}

if (file_exists($pdf_fitxategia)) {
    
    $gorde_tokia = $pdf_karpeta;
    $stmt = mysqli_prepare($konexioa, "INSERT INTO faktura (gorde_tokia, eskaera_id) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "si", $gorde_tokia, $eskaera_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="faktura_' . $eskaera_id . '.pdf"');
    header('Content-Length: ' . filesize($pdf_fitxategia));
    readfile($pdf_fitxategia);
    exit;
} else {
    die("Errorea: PDFa ez da aurkitu");
}

mysqli_close($konexioa);
?>