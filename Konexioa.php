<?php
$serbidorea = "localhost:3307";
$erabiltzailea = "root";
$pasahitza = "1MG32025";
$datu_basea = "bigarrenerronka";

$konexioa = new mysqli($serbidorea, $erabiltzailea, $pasahitza, $datu_basea);

if ($konexioa->connect_error) {
    die("Konexio arazoa: " . $konexioa->connect_error);
}
?>