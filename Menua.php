<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menua</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <button class="close-btn">×</button>
        <nav class="sidebar-nav">
            <?php if (isset($_SESSION['erabiltzailea'])): ?>
                <a href="Logout.php" style="color: #ff4d4d;">SAIOA ITXI (<?php echo $_SESSION['erabiltzailea']; ?>)</a>
            <?php else: ?>
                <a href="Login.php">SAIOA HASI</a>
            <?php endif; ?>
            <a href="berriak.php">BERRIAK</a>
            <a href="Produktuak.php">GURE PRODUKTUAK</a>
            <a href="Formularioa.php">BIHURTU HORNITZAILE</a>
            <a href="kontaktua.php">KONTAKTUA</a>
            <a href="Saskia.php">IKUSI SASKIA</a>
        </nav>
    </div>

    <header>
        <button class="menu-btn">
            <i class="fas fa-bars"></i>
        </button>

        <?php if (isset($_SESSION['erabiltzailea'])): ?>
            <div style="color: white; font-weight: bold; margin-left: 20px; flex-grow: 1;">
                Kaixo, <?php echo $_SESSION['erabiltzailea']; ?>!
            </div>
        <?php endif; ?>

        <img src="logo.png" alt="Logotipoa" width="150px" class="LogoHeader">
    </header>

    <script>
        $(".menu-btn, .close-btn").on("click", function() {
            $("#sidebar").toggleClass("active");
        });
    </script>
</body>
</html>