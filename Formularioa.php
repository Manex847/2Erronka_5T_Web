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
    
    require_once "Konexioa.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $izena = $_POST['izena'];
        $abizenak = $_POST['abizenak'];
        $helbidea = $_POST['helbidea'];
        $nan = $_POST['nan'];
        $telefonoa = $_POST['telefonoa'];
        $email = $_POST['email'];

        // EL ORDEN DEBE SER: helbidea, izena, abizenak, nan, telefonoa, email
        $stmt = $konexioa->prepare("INSERT INTO hornitzaileak (helbidea, izena, abizenak, nan, telefonoa, email) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $helbidea, $izena, $abizenak, $nan, $telefonoa, $email);

        if ($stmt->execute()) {
            echo "<p>Datuak ondo gorde dira!</p>";
        } else {
            echo "<p>Errorea: Ezin izan daira datuak sartu, saiatu berriro beranduago " . $stmt->error . "</p>";
        }

        $stmt->close();
        $konexioa->close();
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