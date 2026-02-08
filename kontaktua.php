<!doctype html>
<html lang="eus">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BirTek - Kontaktua</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="icon" type="image/png" href="ikonoa_header.png">
</head>

<body class="kontaktua_gorputza">


  <header class="goiburua">
    <?php
    include "Menua.php";
    ?>
  </header>
  <section class="kontaktua_sekzioa">
    <div class="kontaktua_edukia">
      <h3>JARRI GUREKIN HARREMANETAN</h3>
      <form class="kontaktua_formularioa">
        <label for="izena">Izena</label>
        <input type="text" id="izena" name="izena" required>

        <label for="emaila">Emaila</label>
        <input type="email" id="emaila" name="emaila" required>

        <label for="mensaje">Mezua</label>
        <textarea id="mezua" name="mezua" required></textarea>

        <button type="submit" class="btn">Bidali</button>
      </form>
      <div class="kontaktua_mapa">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2915.710106222131!2d-2.185005623973569!3d43.047530571137315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd50377e2184cd6b%3A0x3019c899f4e0c303!2sGoierri%20Eskola!5e0!3m2!1ses!2ses!4v1759475524242!5m2!1ses!2ses"
          width="100%"
          height="350"
          style="border:0;"
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </div>
  </section>

  <footer class="azpioina">
        <p>&copy; 2025 BirTek. Eskubide guztiak erreserbatuak.</p>
        <ul>
            <a href="baldintzak.html">Lege-Oharra eta Baldintzak</a></li>
            <a href="pribatutasuna.html">Pribatutasun Politika</a></li>
            <a href="kontaktua.html">Gunearen Mapa</a></li>
          </ul>
        <div class="kontaktua_info">
            <p>Kontaktua: info@birtek.eus | Telefonoa: +34 943 123 123</p>
          </div>
      </footer>

</body>

</html>