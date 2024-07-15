<?php
session_start();
include("functions.php");
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $VNev = mysqli_real_escape_string($conn, $_POST["VNev"]);
    $KNev = mysqli_real_escape_string($conn, $_POST["KNev"]);
    $Email = mysqli_real_escape_string($conn, $_POST["Email"]);

    // Check if it's a participant login
    if (isset($_POST["jelszo"])) {
        $jelszo = mysqli_real_escape_string($conn, $_POST["jelszo"]);
        $kodoltjelszo = sha1($jelszo);

        $sql = "SELECT * FROM eloado WHERE Email='$Email' LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if ($Email === "admin@yahoo.com" && $_POST["jelszo"] === "adminjelszo") {
            $_SESSION['Email'] = $Email;
            header("Location: admin.php");
            die;
        }
        
        if ($result && mysqli_num_rows($result) > 0) {
            $userdata = mysqli_fetch_assoc($result);
            if ($userdata['Jelszo'] == $kodoltjelszo) {
                $_SESSION['Email'] = $userdata['Email'];
                header("Location: konferencia.php");
                die;
            } else {
                function_alert("Nem megfelelő név, e-mail cím vagy jelszó!");
            }
        } else {
            function_alert("Nem található felhasználó ilyen e-mail címmel!");
        }
    } else { // Otherwise, it's a presenter login
        $sql = "SELECT * FROM resztvevo WHERE Email='$Email' LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $userdata = mysqli_fetch_assoc($result);
            if ($userdata['Email'] == $Email) {
                $_SESSION['Email'] = $userdata['Email'];
                header("Location: konferenciaa.php");
                die;
            } else {
                function_alert("Nem megfelelő név, e-mail cím vagy jelszó!");
            }
        } else {
            function_alert("Nem található felhasználó ilyen e-mail címmel!");
        }
    }
}
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
                <li><a href="kerdesek.php">Kérdések</a></li>
                <li><a href="regisztracio.php">Regisztráció</a></li>
                <li><a href="login.php">Jelentkezés</a></li>
            </ul>
        </nav>
        <div class="container">
<h2>Bejelentkezés</h2>
<?php if (!isset($_POST["jelszo"])) { // Show participant login form ?>
    <form action="login.php" method="post">
        <div class="form-group">
                <label>Vezetéknév:</label>
            <input type="text" id="VNev" name="VNev" placeholder="pl. Kovacs" required>
                </div>
                <div class="form-group">
                <label>Keresztnév:</label>
            <input type="text" id="KNev" name="KNev" placeholder="pl. Anna" required>
                </div>
                <div class="form-group">
                <label>Email cím:</label>
            <input type="email" id="Email" name="Email" placeholder="regisztralok@pelda.com" required>
                </div>
                
                <div class="form-group">
                <label>Jelszó:</label>
            <input type="password" id="password" name="jelszo" placeholder="Jelszó" required>
                </div>
                
                <div class="form-group">
                    <br><input class="button" type="submit" value="Bejelentkezem" name="submit">
                    <input type="button" value="Mégse" href="konferencia.php">
                </div>
                <div class="form-group">
                <h3>Még nincs felhasználó fiókod? Regisztrálj <a href="regisztracio.php">itt.</a></h3><br>
                </div>
    </form>
<?php } else { // Show presenter login form ?>
    <form action="login.php" method="post">
    <label>Vezetéknév:</label>
            <input type="text" id="VNev" name="VNev" placeholder="pl. Kovacs" required>
                </div>
                <div class="form-group">
                <label>Keresztnév:</label>
            <input type="text" id="KNev" name="KNev" placeholder="pl. Anna" required>
                </div>
                <div class="form-group">
                <label>Email cím:</label>
            <input type="email" id="Email" name="Email" placeholder="regisztralok@pelda.com" required>
                </div>
                <div class="form-group">
                    <br><input class="button" type="submit" value="Bejelentkezem" name="submit">
                    <input type="button" value="Mégse" href="konferencia.php">
                </div>
                <div class="form-group">
                <h3>Még nincs felhasználó fiókod? Regisztrálj <a href="nezo.php">itt.</a></h3><br>
                </div>
    </form>
<?php } ?>
