<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menua</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="sidebar" id="sidebar">
        <button class="close-btn">×</button>
        <nav class="sidebar-nav">
            <a href="Login.php">SAIOA HASI</a>
            <a href="berriak.html">BERRIAK</a>
            <a href="Produktuak.php">GURE PRODUKTUAK</a>
            <a href="Formularioa.php">KUDEAKETAK</a>
            <a href="kontaktua.html">KONTAKTUA</a>
        </nav>
    </div>

    <header>
        <button class="menu-btn">
            <i class="fas fa-bars"></i>
        </button>
        <img src="logo.png" alt="Logotipoa" width="150px" class="LogoHeader">
    </header>
    <main>

    </main>
    <script>
        $(".menu-btn").on("click", function() {
            $("#sidebar").toggleClass("active");
        });
    </script>
</body>

</html>