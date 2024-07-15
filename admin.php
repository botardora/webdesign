<?php
session_start();
include("functions.php");
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $ujAdat = mysqli_real_escape_string($conn, $_POST["ujAdat"]);
    $leiras = mysqli_real_escape_string($conn, $_POST["leiras"]);
    $sqlLastValue = "SELECT SzekcioID FROM szekcio ORDER BY SzekcioID DESC LIMIT 1";
    $result = $conn->query($sqlLastValue);
    $lastValue = ($result->num_rows > 0) ? $result->fetch_assoc()['SzekcioID'] : 0;
    $newLastValue = $lastValue + 1;

    $sqlCheck = "SELECT * FROM szekcio WHERE Nev = '$ujAdat'";
    $result = $conn->query($sqlCheck);

    if ($result->num_rows > 0) {
        echo "Az adat már létezik az adatbázisban.";
    } else {
    $sql = "INSERT INTO szekcio (Nev,SzekcioID) VALUES ('$ujAdat','$newLastValue')";

    if ($conn->query($sql) === TRUE) {
        echo "Sikeresen hozzáadva az adatbázishoz.";
    } else {
        echo "Hiba: " . $sql . "<br>" . $conn->error;
    }
}
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit1'])) {
    $torlendoAdat = mysqli_real_escape_string($conn, $_POST["ujadat2"]);
    //$idToDelete = "SELECT SZID FROM szekcio WHERE Nev='$ujAdat2'";
    
    $sql = "DELETE FROM szekcio WHERE Nev = '$torlendoAdat'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Sikeresen törölve az adatbázisból.";
    } else {
        echo "Hiba: " . $sql . "<br>" . $conn->error;
    }
}

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
            <h2>Admin felület</h2>
            <form action="admin.php" method="post">
            <label for="szekcio">Szekciók</label>
            <select name="szekcio" id="szekcio">
                    <?php
                
                
                    $sql= "SELECT Nev FROM szekcio";
                    $result = mysqli_query($conn, $sql);
                    foreach ($result as $szekcio) {
                        echo "<option value=\"{$szekcio['Nev']}\">{$szekcio['Nev']}</option>";
                    }
                    ?>
            </select>
                    <br>
                    <br>
                    <h3>Új szekció beszúrása</h3>
                    <div class="form-group">
                        <label for="ujAdat">Új szekció</label>
                        <input id="ujAdat" name="ujAdat" type="text" class="input" required>
                    </div>
                    <div class="form-group">
                        <label for="leiras">Leírás</label>
                        <textarea id="leiras" name="leiras" type="text" rows="5" ></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name=submit value="Beszúrás" class="btn">
                    </div>
                    </div>
                    
                </form>
                <br>
                <br>
                <div class="container">
            <form action="admin.php" method="post">
                <h3>Szekció törlése</h3>
                <div class="form-group">
                    <label for="ujadat2">Szekció kiválasztása</label>
                    <select name="ujadat2" id="ujadat2">
                        <?php
                
                
                $sql= "SELECT Nev FROM szekcio";
                $result = mysqli_query($conn, $sql);
                foreach ($result as $szekcio) {
                    echo "<option value=\"{$szekcio['Nev']}\">{$szekcio['Nev']}</option>";
                }
                ?>
            </select>
        </div>
        
        <div class="form-group">
            <input type="submit" name=submit1 value="Törlés" class="btn">
        </div>
    </form>
</div>
<br>
<br>
<div class="container">
    <form action="admin.php" method="post">
        <h3>Kiválasztott szekcióba jelentkezők</h3>
                <div class="form-group">
                    <label for="ujadat3">Szekció:</label>
                    <select name="ujadat3" id="ujadat3">
                        <?php
                
                
                $sql= "SELECT Nev FROM szekcio";
                $result = mysqli_query($conn, $sql);
                foreach ($result as $szekcio) {
                    echo "<option value=\"{$szekcio['Nev']}\">{$szekcio['Nev']}</option>";
                }
                ?>
            </select>
        </div>
        
        <div class="form-group">
            <input type="submit" name="irdki" value="jelentkezők" class="btn">
        </div>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['irdki'])) {
            $kivalasztottSzekcio = mysqli_real_escape_string($conn, $_POST["ujadat3"]);
        
            $sql = "SELECT eloado.VNev as eloado_neve, eloado.KNev as eloado_nev FROM eloado
                    INNER JOIN dolgozat ON eloado.DID = dolgozat.DolgozatID 
                    INNER JOIN szekcio ON dolgozat.SZID = szekcio.SzekcioID
                    WHERE szekcio.Nev = '$kivalasztottSzekcio'";
            
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0){
        
                echo "<h4>A kiválasztott szekcióba jelentkezettek:</h4>";
                echo "<ul>";
                while ($row = $result->fetch_assoc()) {
                    echo "<li>{$row['eloado_neve']} {$row['eloado_nev']}</li>";
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