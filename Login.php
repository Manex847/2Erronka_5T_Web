<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    
    if ($user === "admin" && $pass === "1234") {
        $_SESSION['usuario'] = $user; 
        header("Location: index.html");
        exit();
    } else {
        $error = "Erabiltzaile edo pasahitz okerra";
    }
}
?>


<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pantaila</title>
</head>
<body>
    <h2>Saioa hasi</h2>
    
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST" action="">
        <input type="text" name="username" placeholder="Erabiltzailea" required>
        <input type="password" name="password" placeholder="Pasahitza" required>
        <button type="submit">Sartu</button>
    </form>
</body>
</html>