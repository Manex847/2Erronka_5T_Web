<?php
session_start();

include "Konexioa.php";
include "Menua.php";

if (!$konexioa) {
    die("Konexio errorea");
}

if (isset($_POST['erosi']) && !empty($_SESSION['saskia'])) {
    
    
    echo "<pre style='background: #f0f0f0; padding: 10px; margin: 20px;'>";
    echo "SASKIAREN EDUKIA:\n";
    print_r($_SESSION['saskia']);
    echo "</pre>";
    
    $erabiltzailea = $_SESSION['erabiltzailea'] ?? '';
    $data = date("Y-m-d");

    
    $stmt = mysqli_prepare($konexioa, "SELECT bezero_id FROM bezeroak WHERE izena = ?");
    mysqli_stmt_bind_param($stmt, "s", $erabiltzailea);
    mysqli_stmt_execute($stmt);
    $emaitza = mysqli_stmt_get_result($stmt);
    $fila = mysqli_fetch_assoc($emaitza);
    $bezero_id = $fila ? $fila['bezero_id'] : 0;
    mysqli_stmt_close($stmt);

    if ($bezero_id == 0) {
        die("Errorea: Bezeroa ez da aurkitu");
    }

    
    $res_max = mysqli_query($konexioa, "SELECT MAX(eskaera_id) AS max_id FROM eskaerak");
    $fila_max = mysqli_fetch_assoc($res_max);
    $eskaera_id = (int)($fila_max['max_id'] ?? 0) + 1;

    
    $stmt = mysqli_prepare($konexioa,
        "INSERT INTO eskaera_produktuak (eskaera_id, produktu_id, kantitatea)
         VALUES (?, ?, ?)"
    );

    $produktu_kopurua = 0;
    
    foreach ($_SESSION['saskia'] as $gakoa => $balioa) {
        
        if (is_array($balioa)) {
            $produktu_id = isset($balioa['id']) ? (int)$balioa['id'] : 
                          (isset($balioa['produktu_id']) ? (int)$balioa['produktu_id'] : 0);
            $kantitatea = isset($balioa['kantitatea']) ? (int)$balioa['kantitatea'] : 1;
        }
        
        else if (is_numeric($gakoa)) {
            $produktu_id = (int)$gakoa;
            $kantitatea = (int)$balioa;
        }
        
        else {
            echo "<p style='color: red;'>Errorea: Saskiaren egitura ez da ezagutzen</p>";
            continue;
        }

        if ($produktu_id > 0) {
            mysqli_stmt_bind_param($stmt, "iii", 
                $eskaera_id,
                $produktu_id, 
                $kantitatea
            );
            
            if (mysqli_stmt_execute($stmt)) {
                $produktu_kopurua++;
            } else {
                echo "<p style='color: red;'>Errorea produktua txertatzerakoan (ID: $produktu_id): " . mysqli_error($konexioa) . "</p>";
            }
        }
    }

    mysqli_stmt_close($stmt);

    if ($produktu_kopurua > 0) {
        
        unset($_SESSION['saskia']);
        
        echo "<div style='text-align: center; padding: 50px;'>
                <h2 style='color: #48bb78;'>✅ Eskaera ondo gorde da!</h2>
                <p>Eskaera zenbakia: <strong>$eskaera_id</strong></p>
                <p>Produktuak: <strong>$produktu_kopurua</strong></p>
                <a href='index.php' style='display: inline-block; margin-top: 20px; padding: 10px 20px; 
                       background: #667eea; color: white; text-decoration: none; border-radius: 5px;'>
                    Hasierara itzuli
                </a>
              </div>";
    } else {
        echo "<div style='text-align: center; padding: 50px;'>
                <h2 style='color: #f56565;'>❌ Errorea</h2>
                <p>Ez da produkturik gorde</p>
                <a href='Saskia.php' style='display: inline-block; margin-top: 20px; padding: 10px 20px; 
                       background: #667eea; color: white; text-decoration: none; border-radius: 5px;'>
                    Saskira itzuli
                </a>
              </div>";
    }

} else {
    header("Location: Saskia.php");
}

mysqli_close($konexioa);
?>