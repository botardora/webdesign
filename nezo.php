<?php
        session_start();
        include("functions.php");
        include("database.php");
        

        $errors = array();
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            
        
            $VNev = mysqli_real_escape_string($conn, $_POST["VNev"]);
            $KNev = mysqli_real_escape_string($conn, $_POST["KNev"]);
            $Email = mysqli_real_escape_string($conn, $_POST["Email"]);
            $Intezmeny = mysqli_real_escape_string($conn, $_POST["Intezmeny"]);
            
                $sql = "INSERT INTO `resztvevo` ( `VNev`,`KNev`, `Intezmeny`, `Email`) 
                        VALUES ( '$VNev','$KNev', '$Intezmeny', '$Email')";
                    function_alert("Sikeres regisztracio!");
                if (mysqli_query($conn, $sql)) {
                    function_alert("Sikeres regisztracio!");
                } else {
                    function_alert("Hiba az adatbázisba való beillesztéskor: " . mysqli_error($conn));
                }
                header("Location: login2.php");
            }
            
            mysqli_close($conn);
        
?> 


<!DOCTYPE html>
<html lang="hu">
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="EMIK, konferencia, erdélyi informatikus, informatika, regisztráció">
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
            
            <li><a href="jelentkezes.php" >Regisztráció</a></li>
            <li><a href="jelentkezes2.php">Bejelentkezés</a></li>
            </ul>
        </nav>
        <div class="container">
            <h2>Regisztráció</h2>
            <form action="nezo.php" method="post">
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
                <label for="intezmeny">Intézmény:</label>
            <select id="Intezmeny" name="Intezmeny" required>
                <option value="babes">Babes-Bolyai Tudomanyegyetem</option>
                <option value="sapientia">Sapientia</option>
                <option value="obudai">Obudai egyetem</option>
                <option value="elte">ELTE</option>
                <option value="corvinus">Corvinus egyetem</option>
                <option value="debreceni">Debreceni egyetem</option>
                <option value="Egyéb">Egyéb</option>
            </select>
                </div>
                
                <div class="form-group">
                    <br><input class="button" type="submit" value="Regisztralok" name="submit">
                    <input type="button" value="Mégse" onclick="window.location.href='konferencia.php'">
                </div>
            </form>
                
    </div>
        
    </body>
    <script>

    // function registerUser(event) {
    //   event.preventDefault();

    //   // Űrlap mezőinek ellenőrzése
       var VNev = document.getElementById('VNev').value;
       var KNev = document.getElementById('KNev').value;
       var Email = document.getElementById('Email').value;
       var Intezmeny = document.getElementById('Intezmeny').value;
       var Orszag = document.getElementById('Orszag').value;
       var jelszo = document.getElementById('jelszo').value;
       var jelszo = document.getElementById('jelszo').value;

    //   // email cím validáció
       var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

       if (!emailRegex.test(Email)) {
         alert('Helytelen email cím formátum!');
         return;
       }

    //   // Jelszó megerősítésének ellenőrzése
       if (jelszo !== jelszo2) {
         alert('A jelszavak nem egyeznek!');
         return;
       }
    //   // Sikeres regisztráció üzenet és átirányítás
       alert('Sikeres regisztráció!');
       location.href = "konferenciaa.php";
    // }

  
  </script>
  <script src="hamburger.js"></script>
</html>