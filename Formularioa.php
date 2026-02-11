<?php
session_start();
include "Konexioa.php";
include "Menua.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!$konexioa) {
    die("Konexio errorea: " . mysqli_connect_error());
}

echo "<pre>DEBUG INFO:</pre>";
echo "<pre>POST erosi: " . (isset($_POST['erosi']) ? 'BAI' : 'EZ') . "</pre>";
echo "<pre>Saskia hutsik: " . (empty($_SESSION['saskia']) ? 'BAI' : 'EZ') . "</pre>";
if (!empty($_SESSION['saskia'])) {
    echo "<pre>Saskiaren edukia: " . print_r($_SESSION['saskia'], true) . "</pre>";
}

if (isset($_POST['erosi']) && !empty($_SESSION['saskia'])) {

    $erabiltzailea = $_SESSION['erabiltzailea'] ?? '';
    echo "<pre>Erabiltzailea: $erabiltzailea</pre>";
    
    $data = date("Y-m-d");

    $stmt = mysqli_prepare($konexioa, "SELECT id FROM bezeroak WHERE izena = ?");
    mysqli_stmt_bind_param($stmt, "s", $erabiltzailea);
    mysqli_stmt_execute($stmt);
    $emaitza = mysqli_stmt_get_result($stmt);
    $fila = mysqli_fetch_assoc($emaitza);
    $bezero_id = $fila ? $fila['id'] : 0;
    mysqli_stmt_close($stmt);

    echo "<pre>Bezero ID: $bezero_id</pre>";

    if ($bezero_id == 0) {
        die("<div style='text-align: center; padding: 50px;'>
                <h2 style='color: #e53e3e;'>❌ Errorea</h2>
                <p>Bezeroa ez da aurkitu. Mesedez, saioa hasi lehenik.</p>
                <p>Erabiltzailea: $erabiltzailea</p>
                <a href='Login.php' style='display: inline-block; margin-top: 20px; padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 5px;'>Login-era itzuli</a>
              </div>");
    }

    $prezioa_totala = 0;
    $produktu_izenak = [];

    foreach ($_SESSION['saskia'] as $gakoa => $balioa) {
        if (is_array($balioa)) {
            $produktu_id = $balioa['id'] ?? $balioa['produktu_id'] ?? 0;
            $kantitatea = $balioa['kantitatea'] ?? 1;
        } else {
            $produktu_id = (int)$gakoa;
            $kantitatea = (int)$balioa;
        }

        echo "<pre>Produktu ID: $produktu_id, Kantitatea: $kantitatea</pre>";

        if ($produktu_id > 0) {
            $stmt_prezioa = mysqli_prepare($konexioa, "SELECT prezioa, izena, stock FROM produktuak WHERE id = ?");
            mysqli_stmt_bind_param($stmt_prezioa, "i", $produktu_id);
            mysqli_stmt_execute($stmt_prezioa);
            $emaitza_prezioa = mysqli_stmt_get_result($stmt_prezioa);
            $fila_prezioa = mysqli_fetch_assoc($emaitza_prezioa);

            if ($fila_prezioa) {
                echo "<pre>Produktua aurkitua: {$fila_prezioa['izena']}, Stock: {$fila_prezioa['stock']}</pre>";
                
                if ($fila_prezioa['stock'] < $kantitatea) {
                    mysqli_stmt_close($stmt_prezioa);
                    die("<div style='text-align: center; padding: 50px;'>
                            <h2 style='color: #e53e3e;'>❌ Errorea</h2>
                            <p>Produktu hau ez dago stock nahikoarekin: <strong>{$fila_prezioa['izena']}</strong></p>
                            <p>Stock-a: {$fila_prezioa['stock']}, Eskatutakoa: {$kantitatea}</p>
                            <a href='Saskia.php' style='display: inline-block; margin-top: 20px; padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 5px;'>Saskira itzuli</a>
                          </div>");
                }

                $prezioa_totala += $fila_prezioa['prezioa'] * $kantitatea;
                $produktu_izenak[] = $fila_prezioa['izena'] . " (x" . $kantitatea . ")";
            }
            mysqli_stmt_close($stmt_prezioa);
        }
    }

    $produktu_izena_guztiak = implode(", ", $produktu_izenak);
    
    echo "<pre>Prezio totala: $prezioa_totala</pre>";
    echo "<pre>Produktu izenak: $produktu_izena_guztiak</pre>";

    mysqli_begin_transaction($konexioa);

    try {
        echo "<pre>INSERT prestatzen eskaerak taulan...</pre>";
        
        $stmt_eskaera = mysqli_prepare($konexioa, "INSERT INTO eskaerak (bezero_id, data, prezioa, bezero_izena, produktu_izena) VALUES (?, ?, ?, ?, ?)");
        
        if (!$stmt_eskaera) {
            throw new Exception("Prepare errorea: " . mysqli_error($konexioa));
        }
        
        mysqli_stmt_bind_param($stmt_eskaera, "isdss", $bezero_id, $data, $prezioa_totala, $erabiltzailea, $produktu_izena_guztiak);
        
        echo "<pre>Exekutatzen INSERT...</pre>";
        
        if (!mysqli_stmt_execute($stmt_eskaera)) {
            throw new Exception("Execute errorea: " . mysqli_stmt_error($stmt_eskaera));
        }
        
        $eskaera_id = mysqli_insert_id($konexioa);
        echo "<pre>Eskaera ID lortu: $eskaera_id</pre>";
        mysqli_stmt_close($stmt_eskaera);

        $stmt_prod = mysqli_prepare($konexioa, "INSERT INTO eskaera_produktuak (eskaera_id, produktu_id, kantitatea) VALUES (?, ?, ?)");
        $stmt_stock = mysqli_prepare($konexioa, "UPDATE produktuak SET stock = stock - ? WHERE id = ?");
        $produktu_kopurua = 0;

        foreach ($_SESSION['saskia'] as $gakoa => $balioa) {
            if (is_array($balioa)) {
                $produktu_id = $balioa['id'] ?? $balioa['produktu_id'] ?? 0;
                $kantitatea = $balioa['kantitatea'] ?? 1;
            } else {
                $produktu_id = (int)$gakoa;
                $kantitatea = (int)$balioa;
            }

            if ($produktu_id > 0) {
                mysqli_stmt_bind_param($stmt_prod, "iii", $eskaera_id, $produktu_id, $kantitatea);
                if (!mysqli_stmt_execute($stmt_prod)) {
                    throw new Exception("Errorea produktuak sartzerakoan: " . mysqli_stmt_error($stmt_prod));
                }
                
                mysqli_stmt_bind_param($stmt_stock, "ii", $kantitatea, $produktu_id);
                if (!mysqli_stmt_execute($stmt_stock)) {
                    throw new Exception("Errorea stock-a eguneratzerakoan: " . mysqli_stmt_error($stmt_stock));
                }
                
                $produktu_kopurua++;
                echo "<pre>Produktua txertatu: ID $produktu_id</pre>";
            }
        }
        
        mysqli_stmt_close($stmt_prod);
        mysqli_stmt_close($stmt_stock);

        echo "<pre>COMMIT egiten...</pre>";
        mysqli_commit($konexioa);
        echo "<pre>COMMIT egin da!</pre>";

        unset($_SESSION['saskia']);

        echo "<div style='text-align: center; padding: 50px; font-family: Arial, sans-serif;'>
                <h2 style='color: #48bb78; font-size: 2em;'>✅ Eskaera ondo gorde da!</h2>
                <div style='background: #f7fafc; padding: 20px; border-radius: 10px; margin: 20px auto; max-width: 500px;'>
                    <p style='margin: 10px 0;'><strong>Eskaera zenbakia:</strong> <span style='color: #667eea; font-size: 1.2em;'>#{$eskaera_id}</span></p>
                    <p style='margin: 10px 0;'><strong>Data:</strong> {$data}</p>
                    <p style='margin: 10px 0;'><strong>Produktu kopurua:</strong> {$produktu_kopurua}</p>
                    <p style='margin: 10px 0;'><strong>Prezio totala:</strong> <span style='color: #48bb78; font-size: 1.5em; font-weight: bold;'>{$prezioa_totala}€</span></p>
                    <p style='margin: 10px 0; color: #718096; font-size: 0.9em;'><strong>Produktuak:</strong> {$produktu_izena_guztiak}</p>
                </div>
                <a href='index.php' style='display: inline-block; margin-top: 20px; padding: 12px 30px; background: #667eea; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; transition: 0.3s;'>Hasierara itzuli</a>
              </div>";

    } catch (Exception $e) {
        echo "<pre>ERROREA GERTATU DA!</pre>";
        echo "<pre>Mezua: " . $e->getMessage() . "</pre>";
        mysqli_rollback($konexioa);
        echo "<div style='text-align: center; padding: 50px;'>
                <h2 style='color: #e53e3e;'>❌ Errorea gertatu da</h2>
                <p style='color: #718096;'>{$e->getMessage()}</p>
                <a href='Saskia.php' style='display: inline-block; margin-top: 20px; padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 5px;'>Saskira itzuli</a>
              </div>";
    }

} else {
    echo "<pre>Ez dago POST erosi edo saskia hutsik dago</pre>";
    header("Location: Saskia.php");
    exit();
}

mysqli_close($konexioa);
?>