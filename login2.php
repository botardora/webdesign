<?php
session_start();
include("functions.php");
include("database.php");


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    

    $VNev = mysqli_real_escape_string($conn, $_POST["VNev"]);
    $KNev = mysqli_real_escape_string($conn, $_POST["KNev"]);
    $Email = mysqli_real_escape_string($conn, $_POST["Email"]);

        $sql = "SELECT * FROM resztvevo WHERE Email='$Email' LIMIT 1";
        function_alert("Sikeres bejelentkezes!");
        $result=mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $userdata = mysqli_fetch_assoc($result);
            if ($userdata['Email'] == $Email) {
                $_SESSION['Email'] = $userdata['Email'];
                header("Location: konferenciaa.php");
                die;
            } else {
                function_alert("Nem megfelelő név, e-mail cím vagy jelszó!");
                // You may want to redirect or handle this failure scenario accordingly
            }
        } else {
            function_alert("Nem található felhasználó ilyen e-mail címmel!");
            // You may want to redirect or handle this failure scenario accordingly
        }
    } 
        // if($result)
        // {
        //     if($result && mysqli_num_rows($result)>0){
        //         $userdata = mysqli_fetch_assoc($result);
        //         if($userdata['jelszo'] == $jelszo){
        //             $_SESSION['Email'] = $userdata['Email'];
        //             header("Location: konferencia.php");
        //             die;
        //         }
        //     }
        //     else{
        //         $result = mysqli_query($conn,$query1);
        //         if($result && mysqli_num_rows($result)>0){
        //             $userdata = mysqli_fetch_assoc($result);
        //             return $userdata;
        //         }
        //     }
    
        // }
        // echo "Nem megfelelo nev, emailcim vagy jelszo!";
        // if (mysqli_query($conn, $sql)) {
        //     function_alert("Sikeres regisztracio!");
        // } else {
        //     function_alert("Hiba az adatbázisba való beillesztéskor: " . mysqli_error($conn));
        // }
        //header("Location: konferencia.php");
    
    
    //mysqli_close($conn);

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
                <li><a href="jelentkezes.php">Regisztráció</a></li>
                <li><a href="jelentkezes2.php">Bejelentkezés</a></li>
            </ul>
        </nav>
        <main class="container">
        <h2>Bejelentkezés</h2>
        <form action="login2.php" method="post">
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
                    <br><input class="button" type="submit" value="Bejelentkezem" name="submit">
                    <input type="button" value="Mégse" onclick="window.location.href='konferencia.php'">
                </div>
                <div class="form-group">
                <h3>Még nincs felhasználó fiókod? Regisztrálj <a href="jelentkezes.php">itt.</a></h3><br>
                </div>
          </form>
          </main>
          </body>
          <script>
    //         // Bejelentkezési űrlap eseménykezelő
    // document.getElementById("loginform").addEventListener("submit", function(event) {
    //   event.preventDefault(); // Űrlap küldésének megakadályozása
    //   var login_username = document.getElementById("login_username").value;
    //   var login_password = document.getElementById("login_password").value;
      
    //   // Felhasználónév és jelszó ellenőrzése (példa szerint itt mindig sikeres a bejelentkezés)
    //   alert("Sikeres bejelentkezés!");
    //   location.href = "konferencia.html";
    // });
          </script>
          <script src="hamburger.js"></script>
          </div>
          </html>