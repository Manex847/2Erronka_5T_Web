<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $izena = $_POST['izena'];
    $prezioa = $_POST['prezioa'];

    if (!isset($_SESSION['saskia'])) {
        $_SESSION['saskia'] = [];
    }

    $_SESSION['saskia'][] = [
        'id' => $id,
        'izena' => $izena,
        'prezioa' => $prezioa
    ];
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
?>