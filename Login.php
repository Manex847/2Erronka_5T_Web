<?php
session_start();
require_once "Konexioa.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT izena, pasahitza FROM bezeroak WHERE email = ?";
    $stmt = $konexioa->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($pass === $row['pasahitza']) {
            $_SESSION['erabiltzailea'] = $row['izena'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Pasahitz okerra";
        }
    } else {
        $izena = explode("@", $email)[0];
        $nan = substr(md5(time()), 0, 9);
        $sql_ins = "INSERT INTO bezeroak (izena, email, pasahitza, nan, helbidea, telefonoa, abizenak) VALUES (?, ?, ?, ?, '', '', '')";
        $stmt_ins = $konexioa->prepare($sql_ins);
        $stmt_ins->bind_param("ssss", $izena, $email, $pass, $nan);
        
        if ($stmt_ins->execute()) {
            $_SESSION['erabiltzailea'] = $izena;
            header("Location: index.html");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="formularioa">
    <?php include "Menua.php"; ?>
    <div class="formulario-container">
        <h3>Sartu</h3>
        <?php if(isset($error)) echo "<p style='color:red; text-align:center;'>$error</p>"; ?>
        <form method="POST" action="" class="kontaktua_formularioa">
            <label>Emaila</label>
            <input type="email" name="username" required>
            <label>Pasahitza</label>
            <input type="password" name="password" required>
            <button type="submit" class="btn">SARTU</button>
        </form>
    </div>
</body>
</html>