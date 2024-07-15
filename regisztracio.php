        <?php
        session_start();
        include("functions.php");
        include("database.php");
        use PHPMailer\PHPMailer\PHPMailer;
        

        $errors = array();
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            
        
            $VNev = mysqli_real_escape_string($conn, $_POST["VNev"]);
            $KNev = mysqli_real_escape_string($conn, $_POST["KNev"]);
            $Email = mysqli_real_escape_string($conn, $_POST["Email"]);
            $Intezmeny = mysqli_real_escape_string($conn, $_POST["Intezmeny"]);
            $Orszag = mysqli_real_escape_string($conn, $_POST["Orszag"]);
            $jelszo = mysqli_real_escape_string($conn, $_POST["jelszo"]);
            $jelszo2 = mysqli_real_escape_string($conn, $_POST["jelszo2"]);
        
            if ($jelszo != $jelszo2) {
                function_alert("Nem egyezik a ket jelszo!");
            } else {
                $kodoltjelszo = sha1($jelszo);
        
                $sql = "INSERT INTO `eloado` (`Email`, `KNev`, `VNev`, `Intezmeny`, `Jelszo`, `Orszag`) 
                        VALUES ('$Email', '$KNev', '$VNev', '$Intezmeny', '$kodoltjelszo', '$Orszag')";
                mysqli_query($conn,$sql);
                mysqli_select_db($conn,$dbname);
        
                $sql = "SELECT Email, Jelszo FROM eloado WHERE Email = '$username'";
        
               
        //function_alert("Sikeres regisztracio!");

            //     if (mysqli_query($conn, $sql)) {
            //         function_alert("Sikeres regisztracio!");
            //     } else {
            //         function_alert("Hiba az adatbázisba való beillesztéskor: " . mysqli_error($conn));
            //     }
            //     header("Location: login.php");
            // }
        }
        // if(isset($_POST['Email'])){
           
        //     define('GUSER', 'botardoraphp@gmail.com'); // GMail username
        //     define('GPWD', 'odclitlugrbrjhgc'); // GMail password
        //         // if (smtpmailer('botardoraphp@gmail.com', 'botardoraphp@gmail.com', 'Botar Dora', 'Sikeres regisztracio', 'Sikeresen regisztráltál a Erdélyi Magyar Informatikusok konferenciájának honlapjára. Itt minden információt megkapsz, ami az eseménnyel kapcsolatos. <br> Üdvözlettel, a szervező csapat.')){
        // // 	echo "Mail sent";
        // $subject="Sikeres regisztracio";
        // $body="Sikeresen regisztráltál a Erdélyi Magyar Informatikusok konferenciájának honlapjára. Itt minden információt megkapsz, ami az eseménnyel kapcsolatos. <br> Üdvözlettel, a szervező csapat.";
        // require_once 'PHPMailer/PHPMailer.php';
        // require_once 'PHPMailer/Exception.php';
        // require_once 'PHPMailer/SMTP.php';
    
        // $mail = new PHPMailer();
    
        // $mail->isSMTP();
        // $mail->Host='smtp.gmail.com';
        // $mail->SMTPAuth=true;
        // $mail->Username = 'GUSER';
        // $mail->Port = 587; 
        // $mail->Password = 'GPWD';
        // $mail->SMTPSecure = 'tls';
        // $mail->isHTML(true);
        // $mail->SetFrom($Email, $KNev.$VNev);
        // $mail->Subject = $subject;
        // $mail->Body = $body;
        // $mail->AddAddress("botardoraphp@gmail.com");
    
        // if ($mail->send()){
        //     echo "Email elkuldve!";
        // }
        // else{
        //     echo "Az emailt nem sikerult elkuldeni!". $mail->ErrorInfo;
        // }
        // }
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
            <form action="regisztracio.php" method="post">
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
                <label>Ország:</label>
            <input type="text" id="orszag" name="Orszag" placeholder="Ország" >
                </div>
                <div class="form-group">
                <label>Jelszó:</label>
            <input type="password" id="password" name="jelszo" placeholder="Jelszó" required>
                </div>
                <div class="form-group">
                <label>Jelszó megerősítése:</label>
            <input type="password" id="password2" name="jelszo2" placeholder="Jelszó megerősítése" required>
                </div>
                <div class="form-group">
                    <br><input class="button" type="submit" value="Regisztralok" name="submit">
                    <input type="button" value="Mégse" onclick="window.location.href='konferencia.php'">
                </div>
                <div class="form-group">
                <h3>Van már felhasználó fiókod? Jelentkezz be<a href="jelentkezes2.php">itt.</a></h3><br>
                </div>
            <!-- <label>Vezetéknév:</label>
            <input type="text" id="VNev" name="VNev" placeholder="pl. Kovacs" required>
            <label>Keresztnév:</label>
            <input type="text" id="KNev" name="KNev" placeholder="pl. Anna" required>
            <label>Email cím:</label>
            <input type="email" id="Email" name="Email" placeholder="regisztralok@pelda.com" required>
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
            <label>Ország:</label>
            <input type="text" id="orszag" name="Orszag" placeholder="Ország" >
            <label>Jelszó:</label>
            <input type="password" id="password" name="jelszo" placeholder="Jelszó" required>
            <label>Jelszó megerősítése:</label>
            <input type="password" id="password2" name="jelszo2" placeholder="Jelszó megerősítése" required>
            <h3>Van már felhasználó fiókod? Jelentkezz be<a href="bejelentkezes.html">itt.</a></h3>
            <button type="submit" name="submit">Regisztrálok</button>
            <button type="button" onclick="goToHomePage()">Mégse</button>
     -->
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
       location.href = "konferencia.html";
    // }

    function goToHomePage() {
        location.href = "konferencia.html";
        href='konferencia.html';
    }

  
  </script>
  <script src="hamburger.js"></script>
</html>