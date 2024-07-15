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
                <li><a href="konferencia.html">Kezdőoldal</a></li>
                <li><a href="rolunk.html">Rólunk</a></li>
                <li><a href="informaciok.html">Információk</a></li>
                <li><a href="eloadok.html">Előadók</a></li>
                <li><a href="kerdesek.html">Kérdések</a></li>
                <li><a href="regisztracio.html" >Regisztráció</a></li>
                <li><a href="jelentkezes.html" >Jelentkezés</a></li>
            </ul>
        </nav>
        <main class="container">
            <h2>Regisztráció</h2>
            <form action="regisztracio.php" method="post">
            <label>Vezetéknév:</label>
            <input type="text" id="VNeev" name="VNev" placeholder="pl. Kovacs" required>
            <label>Keresztnév:</label>
            <input type="text" id="KNeev" name="KNev" placeholder="pl. Anna" required>
            <label>Email cím:</label>
            <input type="email" id="Emaail" name="Email" placeholder="regisztralok@pelda.com" required>
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
            <input type="password" id="jeelszo" name="jelszo" placeholder="Jelszó" required>
            <label>Jelszó megerősítése:</label>
            <input type="password" id="jeelszo2" name="jelszo2" placeholder="Jelszó megerősítése" required>
            <h3>Van már felhasználó fiókod? Jelentkezz be<a href="bejelentkezes.html">itt.</a></h3>
            <button type="submit" name="submit">Regisztrálok</button>
            <button type="button" onclick="goToHomePage()">Mégse</button>
    
            </form>
            <?php
                session_start();
                // Adatbázis kapcsolódás
                 $dbServer = 'localhost'; // Adatbázis szerver neve
                 $username = "root";
                 $password = "";
                 $dbName = 'konferencia'; // Adatbázis neve
                
                     $conn = new mysqli($dbServer, $username, $password, $dbName);
                     mysqli_set_charset($conn, "utf8");
                  
                     
                     if (!$conn) {
                         die("Sikertelen csatlakozás: " . mysqli_connect_error());
                     }
                     if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST['submit'])) {
                      $validName="/^[a-zA-Z ]*$/";
                        $validEmail="/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
                        $uppercasePassword = "/(?=.*?[A-Z])/";
                        $lowercasePassword = "/(?=.*?[a-z])/";
                        $digitPassword = "/(?=.*?[0-9])/";
                        $spacesPassword = "/^$|\s+/";
                        $symbolPassword = "/(?=.*?[#?!@$%^&*-])/";
                        $minEightPassword = "/.{8,}/";
                        $fnameErr = $lnameErr = $emailErr = $passErr = $cpassErr = '';
                        if(empty($VNev)){
                            $fnameErr="First Name is Required"; 
                         }
                         else if (!preg_match($validName,$VNev)) {
                            $fnameErr="Digits are not allowed";
                         }else{
                            $fnameErr=true;
                         }
                         //  Last Name Validation
                         if(empty($KNev)){
                            $lnameErr="Last Name is required"; 
                         }
                         else if (!preg_match($validName,$KNev)) {
                            $lnameErr="Digit are not allowed";
                         }
                         else{
                            $lnameErr=true;
                         }
                         //Email Address Validation
                         if(empty($Email)){
                           $emailErr="Email is Required"; 
                         }
                         else if (!preg_match($validEmail,$Email)) {
                           $emailErr="Invalid Email Address";
                         }
                         else{
                           $emailErr=true;
                         }
                             
                         // password validation 
                         if(empty($jelszo)){
                           $passErr="Password is Required"; 
                         } 
                         elseif (!preg_match($uppercasePassword,$jelszo) || !preg_match($lowercasePassword,$jelszo) || !preg_match($digitPassword,$jelszo) || !preg_match($symbolPassword,$jelszo) || !preg_match($minEightPassword,$jelszo) || preg_match($spacesPassword,$jelszo)) {
                           $passErr="Password must be at least one uppercase letter, lowercase letter, digit, a special character with no spaces and minimum 8 length";
                         }
                         else{
                            $passErr=true;
                         }
                         if($jelszo2!=$jelszo){
                            $cpassErr="Confirm Password doest Matched";
                         }
                         else{
                            $cpassErr=true;
                         }
                      $VNev = $_POST['VNev'];
                      $KNev = $_POST['KNev'];
                      $Email = $_POST['Email'];
                      $Intezmeny = $_POST['Intezmeny'];
                      $Orszag =  $_POST['Orszag'];
                      $jelszo =  $_POST['jelszo'];
                      $jelszo2 =  $_POST['jelszo2'];
                      $Jelszo = sha1($jelszo);
                      // $errors = array();
                      // if(empty($VNev) OR empty($KNev) OR empty($Email) OR empty($Intezmeny) OR empty($jelszo)){
                      //   echo "Nem töltöttél ki minden kötelező mezőt!";
                      // }
                      // if(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
                      //   echo "Nem érvényes az email cím!";
                      // }
                      // if(strlen($jelszo)<8){
                      //   echo "A jelszó legalább 8 karakterből kell álljon!";
                      // }
                      // if($jelszo!==$jelszo2){
                      //   echo "A két jelszó nem egyezik!";
                      // }
                      // if(0<count($errors)){
                      //   foreach ($errors as $error) {
                      //       echo $error;
                      //   }
                      // }else{
                        $sql = "INSERT INTO eloado ( Email, KNev, VNev, Intezmeny, Jelszo, Orszag)
                                VALUES ( ?, ?, ?, ?, ?, ?)";
                        $stmt = mysqli_stmt_init($conn);
                        $preparestmt = mysqli_stmt_prepare($stmt, $sql);
                        if($preparestmt){
                            mysqli_stmt_bind_param($stmt, "ssssss", $Email, $KNev, $VNev, $Intezmeny,$Jelszo, $Orszag);
                            mysqli_stmt_execute($stmt);
                            echo "Sikeresen regisztrált!";
                          }else{
                            echo "Sikertelen regisztráció!";
                          }
                          $result=mysqli_query($conn,$sql);
               
                      //}
                    // $username = mysqli_real_escape_string($conn, $_POST['username']);
                    // $password = mysqli_real_escape_string($conn, $_POST['password']);
                }
                mysqli_close($conn);
              }
            ?>
        </main>
    </body>
    <script>

    // function registerUser(event) {
    //   event.preventDefault();

    //   // Űrlap mezőinek ellenőrzése
    //   var VNev = document.getElementById('VNev').value;
    //   var KNev = document.getElementById('KNev').value;
    //   var Email = document.getElementById('Email').value;
    //   var Intezmeny = document.getElementById('Intezmeny').value;
    //   var Orszag = document.getElementById('Orszag').value;
    //   var jelszo = document.getElementById('jelszo').value;
    //   var jelszo = document.getElementById('jelszo').value;

    //   // email cím validáció
    //   var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    //   if (!emailRegex.test(email)) {
    //     alert('Helytelen email cím formátum!');
    //     return;
    //   }

    //   // Jelszó megerősítésének ellenőrzése
    //   if (password !== confirmPassword) {
    //     alert('A jelszavak nem egyeznek!');
    //     return;
    //   }
    //   // Sikeres regisztráció üzenet és átirányítás
    //   alert('Sikeres regisztráció!');
    //   location.href = "konferencia.html";
    // }

    function goToHomePage() {
        location.href = "konferencia.html";
        href='konferencia.html';
    }

  
  </script>
  <script src="hamburger.js"></script>
</html>