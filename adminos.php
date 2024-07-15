<?php
session_start();

include("database.php");

//     if ($result->num_rows > 0) {
    // }
    ?>

<!DOCTYPE html>

<html lang="hu">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <meta name="keywords" content="EMIK, konferencia, erdélyi informatikus, informatika, bejelentkezés">
        <title>17. EMIK</title>
        <link rel="icon" type="image/x-icon" href="fsharp-logo.png">
        <link rel="stylesheet" href="konferencia2.css">
        <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="toppanel">
        <nav>
            <div class="hamburger">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
            <ul class="nav-links" >
                <div class="logo">
                    <img src="fsharp-logo2.png" alt="Logo Image">
                </div>
                <li><a href="konferencia.php">Kezdőoldal</a></li>
                <li><a href="rolunk.php">Rólunk</a></li>
                <li><a href="informaciok.php">Információk</a></li>
                <li><a href="eloadok.php">Előadók</a></li>
                <li><a href="logout.php">Kijelentkezés</a></li>
            </ul>
        </nav>
        
          
<div class="container">
    <form action="adminos.php" method="post">
        <h3>Kiválasztott intézmenyből jelentkezők</h3>
                <div class="form-group">
                    <label for="ujadat3">Intézmény:</label>
                    <select name="ujadat3" id="ujadat3">
                        <?php
                
                
                $sql= "SELECT Intezmeny FROM eloado";
                $result = mysqli_query($conn, $sql);
                foreach ($result as $Intezmeny) {
                    echo "<option value=\"{$Intezmeny['Intezmeny']}\">{$Intezmeny['Intezmeny']}</option>";
                }
                ?>
            </select>
        </div>
        
        <div class="form-group">
            <input type="submit" name="irdki" value="jelentkezők" class="btn">
        </div>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['irdki'])) {
            $kivalasztottIntezmeny = mysqli_real_escape_string($conn, $_POST["ujadat3"]);
        
            $sql = "SELECT eloado.VNev as eloado_neve, eloado.KNev as eloado_nev, szekcio.Nev as szekcio, dolgozat.Cim as cim FROM eloado
                    INNER JOIN dolgozat ON eloado.DID = dolgozat.DolgozatID 
                    INNER JOIN szekcio ON dolgozat.SZID = szekcio.SzekcioID
                    WHERE eloado.Intezmeny = '$kivalasztottIntezmeny'";
            
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0){
        
                echo "<h4>A kiválasztott intezményből jelentkezettek:</h4>";
                echo "<ul>";
                while ($row = $result->fetch_assoc()) {
                    echo "<li>{$row['eloado_neve']} {$row['eloado_nev']}, {$row['szekcio']}, {$row['cim']}</li>";
                }
                echo "</ul>";
            } else {
                echo "Nincsenek jelentkezők ebben a szekcióban.";
            }
            }?>
    </form>
</div>
<br>
<br>
</div>

</div>