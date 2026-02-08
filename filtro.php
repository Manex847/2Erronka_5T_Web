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

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Produktuak - Filtroa</title>
</head>
<body>

<form method="GET">
    <input type="text" name="q" placeholder="Bilatu izena, marka edo modeloa..." value="<?= $q ?>">

    <select name="sekzioa">
        <option value="">Sekzio guztiak</option>
        <option value="1" <?= $sekzioa=="1"?"selected":"" ?>>Ordenagailuak</option>
        <option value="2" <?= $sekzioa=="2"?"selected":"" ?>>Kamerak</option>
        <option value="3" <?= $sekzioa=="3"?"selected":"" ?>>Kontsolak</option>
        <option value="4" <?= $sekzioa=="4"?"selected":"" ?>>Audio / periferikoak</option>
        <option value="5" <?= $sekzioa=="5"?"selected":"" ?>>Teklatuak</option>
    </select>

    <select name="marka">
        <option value="">Marka guztiak</option>
        <option value="Sony" <?= $marka=="Sony"?"selected":"" ?>>Sony</option>
        <option value="Dell" <?= $marka=="Dell"?"selected":"" ?>>Dell</option>
        <option value="Logitech" <?= $marka=="Logitech"?"selected":"" ?>>Logitech</option>
        <option value="Microsoft" <?= $marka=="Microsoft"?"selected":"" ?>>Microsoft</option>
        <option value="Samsung" <?= $marka=="Samsung"?"selected":"" ?>>Samsung</option>
        <option value="Apple" <?= $marka=="Apple"?"selected":"" ?>>Apple</option>
        <option value="Asus" <?= $marka=="Asus"?"selected":"" ?>>Asus</option>
        <option value="Lenovo" <?= $marka=="Lenovo"?"selected":"" ?>>Lenovo</option>
    </select>

    <input type="number" name="min" placeholder="Prezio min" value="<?= $min ?>">
    <input type="number" name="max" placeholder="Prezio max" value="<?= $max ?>">

    <button type="submit">Filtratu</button>
</form>

<br>

<table>
    <tr>
        <th>ID</th>
        <th>Izena</th>
        <th>Modeloa</th>
        <th>Prezioa</th>
        <th>Marka</th>
        <th>Stock</th>
        <th>Sekzioa</th>
    </tr>

    <?php while($row = $ema->fetch_assoc()): ?>
    <tr>
        <td><?= $row['produktu_id'] ?></td>
        <td><?= $row['izena'] ?></td>
        <td><?= $row['modeloa'] ?></td>
        <td><?= $row['prezioa'] ?> €</td>
        <td><?= $row['marka'] ?></td>
        <td><?= $row['stock'] ?></td>
        <td><?= $row['sekzioa'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>