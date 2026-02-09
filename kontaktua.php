<!doctype html>
<html lang="eus">

<body class="kontaktua_gorputza">

    <?php
    include "Menua.php";
    ?>
  <section class="kontaktua_sekzioa">

    <div class="kontaktua_edukia">
      <h3>JARRI GUREKIN HARREMANETAN</h3>
      
      <form class="kontaktua_formularioa">
        <div class="input_taldea">
            <label for="izena">Izena</label>
            <input type="text" id="izena" name="izena" required>
        </div>

        <div class="input_taldea">
            <label for="emaila">Emaila</label>
            <input type="email" id="emaila" name="emaila" required>
        </div>

        <div class="input_taldea">
            <label for="mezua">Mezua</label>
            <textarea id="mezua" name="mezua" required></textarea>
        </div>

        <button type="submit" class="btn">Bidali</button>
      </form>

      <div class="kontaktua_mapa">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2902.7554972745347!2d-1.9705!3d43.3183!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDPCsDE5JzA1LjkiTiAxwrA1OCcxMy44Ilc!5e0!3m2!1ses!2ses!4v1645450000000!5m2!1ses!2ses"
          width="100%"
          height="350"
          style="border:0;"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </div>
  </section>

  <footer class="azpioina">
    <p>© 2025 BirTek. Eskubide guztiak erreserbatuak.</p>
    <ul>
      <a href="baldintzak.html">Lege-Oharra eta Baldintzak</a>
      <a href="pribatutasuna.html">Pribatutasun Politika</a>
      <a href="kontaktua.html">Gunearen Mapa</a>
    </ul>
    <div class="kontaktua_info">
      <p>Kontaktua: info@birtek.eus | Telefonoa: +34 943 123 123</p>
    </div>
  </footer>

</body>
</html>