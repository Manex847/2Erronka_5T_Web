<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HornitzaileFormularioa</title>
</head>

<body class="formularioa">
    <?php
    include "Menua.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servidor = "localhost";
        $usuario = "root";
        $password = "1MG32025";
        $base_datos = "bigarrenerronka";

        $conn = new mysqli($servidor, $usuario, $password, $base_datos);

        if ($conn->connect_error) {
            die("Errorea: " . $conn->connect_error);
        }

        $izena = $_POST['izena'];
        $abizenak = $_POST['abizenak'];
        $helbidea = $_POST['helbidea'];
        $nan = $_POST['nan'];
        $telefonoa = $_POST['telefonoa'];
        $email = $_POST['email'];

        $stmt = $conn->prepare("INSERT INTO hornitzaileak (izena, abizenak, helbidea, nan, telefonoa, email) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $izena, $abizenak, $helbidea, $nan, $telefonoa, $email);

        if ($stmt->execute()) {
            echo "<p>Datuak ondo gorde dira!</p>";
        } else {
            echo "<p>Errorea: Ezin izan daira datuak sartu, saiatu berriro beranduago" . $stmt->error . "</p>";
        }

        $stmt->close();
        $conn->close();
    }

    ?>
    <div class="formulario-container">
        <form action="Formularioa.php" method="POST">

        <h2>Hornitzaile Berria</h2><br>

            <label>Izena:</label><br>
            <input class="formulario-datuak" type="text" name="izena" maxlength="30" required><br><br>

            <label>Abizenak:</label><br>
            <input class="formulario-datuak" type="text" name="abizenak" maxlength="150" required><br><br>

            <label>Helbidea:</label><br>
            <input class="formulario-datuak" type="text" name="helbidea" maxlength="100" required><br><br>

            <label>NAN:</label><br>
            <input class="formulario-datuak" type="text" name="nan" maxlength="10" required><br><br>

            <label>Telefonoa:</label><br>
            <input class="formulario-datuak" type="text" name="telefonoa" maxlength="12" required><br><br>

            <label>Emaila:</label><br>
            <input class="formulario-datuak" type="email" name="email" maxlength="100" required><br><br>

            <button type="submit">Gorde Hornitzailea</button>

        </form>
    </div>

</body>

</html>