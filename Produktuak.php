<!DOCTYPE html>
<html lang="eu">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BirtekIndex</title>
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  </head>
  <body>
    <?php
    include "Menua.html";
    ?>
    <?php
    $konexioa = new mysqli("localhost", "root", "1MG32025", "bigarrenerronka");

    $q        = $_GET['q'] ?? "";
    $sekzioa  = $_GET['sekzioa'] ?? "";
    $marka    = $_GET['marka'] ?? "";
    $min      = $_GET['min'] ?? "";
    $max      = $_GET['max'] ?? "";

    $sql = "SELECT * FROM produktuak WHERE 1=1";

    if ($q !== "") {
        $sql .= " AND (izena LIKE '%$q%' OR modeloa LIKE '%$q%' OR marka LIKE '%$q%')";
    }
    if ($sekzioa !== "") {
        $sql .= " AND sekzioa = $sekzioa";
    }
    if ($marka !== "") {
        $sql .= " AND marka = '$marka'";
    }
    if ($min !== "") {
        $sql .= " AND prezioa >= $min";
    }
    if ($max !== "") {
        $sql .= " AND prezioa <= $max";
    }

    $ema = $konexioa->query($sql);
    ?>

    <div class="eduki_nagusia">
      <aside class="filtro">
        <h3>Filtratu</h3>
        <form method="GET">
          <label>Bilatu</label>
          <input type="text" name="q" placeholder="Izena, modeloa..." value="<?= htmlspecialchars($q) ?>">

          <label>Sekzioa</label>
          <select name="sekzioa">
            <option value="">Guztiak</option>
            <option value="1" <?= $sekzioa=="1"?"selected":"" ?>>Ordenagailuak</option>
            <option value="2" <?= $sekzioa=="2"?"selected":"" ?>>Kamarak</option>
            <option value="3" <?= $sekzioa=="3"?"selected":"" ?>>Kontsolak</option>
            <option value="4" <?= $sekzioa=="4"?"selected":"" ?>>Audiobisualak</option>
            <option value="5" <?= $sekzioa=="5"?"selected":"" ?>>Teklatuak</option>
          </select>

          <label>Marka</label>
          <select name="marka">
            <option value="">Guztiak</option>
            <option value="Sony" <?= $marka=="Sony"?"selected":"" ?>>Sony</option>
            <option value="Dell" <?= $marka=="Dell"?"selected":"" ?>>Dell</option>
            <option value="Logitech" <?= $marka=="Logitech"?"selected":"" ?>>Logitech</option>
            </select>

          <label>Prezio max</label>
          <input type="number" name="max" value="<?= $max ?>">

          <button type="submit">Aplikatu</button>
        </form>
      </aside>

      <main class="main-produktuak">
        <section class="SekzioarenTitulua">
          <div class="SekzioTitulua">
            <h2>
                <?php 
                    if ($q != "") echo "EMAITZAK: " . htmlspecialchars($q);
                    else echo "PRODUKTUAK";
                ?>
            </h2>
          </div>
        </section>

        <div class="ProduktuZerrenda">
          <?php if ($ema->num_rows > 0): ?>
              <?php while($row = $ema->fetch_assoc()): ?>
                  <div class="Produktuak">
                    <div class="produktu_argazkia">
                      <img class="" src="Argazkiak/<?= $row['argazkia'] ?>" alt="<?= $row['izena'] ?>" />
                      </div>
                      <div class="produktu-titulua">
                      <h3><?= $row['izena'] ?></h3>
                      <p><strong><?= $row['prezioa'] ?> €</strong></p>
                      <button class="ErosiBotoia"><strong>GEHITU SASKIRA</strong></button>
                    </div>
                  </div>
              <?php endwhile; ?>
          <?php else: ?>
              <p style="color: black; grid-column: span 2; padding: 20px;">
                  Ez da produkturik aurkitu bilaketa horrekin.
              </p>
          <?php endif; ?>
        </div>
      </main>
    </div>
  </body>
</html>