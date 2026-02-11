<?php
session_start();
include "Menua.php";
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Zure Saskia</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="saskia-gorputza">
        <div class="saskia">
            <h2>Zure Saskia</h2>

            <?php if (!empty($_SESSION['saskia'])): ?>
                <table border="1" style="width:100%; color: black; background: white; margin-top: 20px;">
                    <thead>
                        <tr>
                            <th>Produktua</th>
                            <th>Prezioa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($_SESSION['saskia'] as $artikulua):
                            $total += $artikulua['prezioa'];
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($artikulua['izena']) ?></td>
                                <td><?= $artikulua['prezioa'] ?> €</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>GUZTIRA</strong></td>
                            <td><strong><?= $total ?> €</strong></td>
                        </tr>
                    </tfoot>
                </table>
                <br>
                <form action="gorde_eskaera.php" method="POST">
                    <div class="erosibotoia">
                        <button type="submit" name="erosi">Erosketa Amaitu</button>
                    </div>
                </form>
            <?php else: ?>
                <p style="color: black;">Saskia hutsik dago.</p>
            <?php endif; ?>

            <br>
            <a href="Produktuak.php">Dendara itzuli</a>
        </div>
    </div>
</body>
</html>