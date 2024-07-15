DOCTYPE html>
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
                     $register=$valid=$fnameErr=$lnameErr=$emailErr=$passErr=$cpassErr='';
                     $set_firstName=$set_lastName=$set_email='';
                     extract($_POST);
                    if (isset($_POST['submit'])) {
                        $validName="/^[a-zA-Z ]*$/";
                        $validEmail="/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
                        $uppercasePassword = "/(?=.*?[A-Z])/";
                        $lowercasePassword = "/(?=.*?[a-z])/";
                        $digitPassword = "/(?=.*?[0-9])/";
                        $spacesPassword = "/^$|\s+/";
                        $symbolPassword = "/(?=.*?[#?!@$%^&*-])/";
                        $minEightPassword = "/.{8,}/";
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
                         if($fnameErr==1 && $lnameErr==1 && $emailErr==1 && $passErr==1 && $cpassErr==1)
{
                       $VNev = legal_input($VNev);
                       $KNev = legal_input($KNev);
                       //$Email = legal_input($Email);
                       $Intezmeny = legal_input($Intezmeny);
                       $Orszag =  legal_input($Orszag);
                       $jelszo =  legal_input($jelszo);
                       $jelszo2 =  legal_input($jelszo2);
                       $Jelszo = sha1($jelszo);
                       $checkEmail=unique_email($Email);
                       if($checkEmail)
                       {
                         $register=$Email." is already exist";
                       }else{
                          // Insert data
                         $register=register($VNev,$KNev,$Email,$Intezmeny,$Orszag,$Jelszo);
                       }}else{
                        // set input values is empty until input field is invalid
                       $set_firstName=$VNev;
                       $set_lastName= $KNev;
                       $set_email= $Email;
                   }
                    //   $errors = array();

                      
                    function legal_input($value) {
                        $value = trim($value);
                        $value = stripslashes($value);
                        $value = htmlspecialchars($value);
                        return $value;
                      }
                      function unique_email($Email){
  
                        global $conn;
                        $sql = "SELECT Email FROM eloado WHERE Email='".$Email."'";
                        $check = $conn->query($sql);
                       if ($check->num_rows > 0) {
                         return true;
                       }else{
                         return false;
                       }
                      }
                      function register($VNev,$KNev,$Email,$Intezmeny,$Orszag,$Jelszo){
                        global $db;
                        $sql="INSERT INTO eloado (KNev, VNev, Email, Intezmeny, Orszag, Jelszo) VALUES(?,?,?,?,?,?)";
                        $query=$db->prepare($sql);
                        $query->bind_param('ssssss',$VNev,$KNev,$Email,$Intezmeny,$Orszag,$Jelszo);
                        $exec= $query->execute();
                         if($exec==true)
                         {
                          return "You are registered successfully";
                         }
                         else
                         {
                           return "Error: " . $sql . "<br>" .$db->error;
                         }
                     }
                    // $username = mysqli_real_escape_string($conn, $_POST['username']);
                    // $password = mysqli_real_escape_string($conn, $_POST['password']);
                }
                
                
            ?>
            <form action="regisztracio.php" method="post">
            <label>Vezetéknév:</label>
            <input type="text" id="VNev" name="VNev" placeholder="pl. Kovacs"  required>
            <p class="err-msg">
            
            <?php if($fnameErr!=1){ echo $fnameErr; }?>
                       </p>
            <label>Keresztnév:</label>
            <input type="text" id="KNev" name="KNev" placeholder="pl. Anna"  required>
            <p class="err-msg"> 
    
    <?php if($lnameErr!=1){ echo $lnameErr; } ?>
                </p>
            <label>Email cím:</label>
            <input type="email" id="Email" name="Email" placeholder="regisztralok@pelda.com" required>
            <p class="err-msg">
    
<?php if($emailErr!=1){ echo $emailErr; } ?>
            </p>
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
            <input type="text" id="Orszag" name="Orszag" placeholder="Ország" >
            <label>Jelszó:</label>
            <input type="password" id="jelszo" name="jelszo" placeholder="Jelszó" required>
            <p class="err-msg">
                
                <?php if($passErr!=1){ echo $passErr; } ?>
                            </p>
            <label>Jelszó megerősítése:</label>
            <input type="password" id="jelszo2" name="jelszo2" placeholder="Jelszó megerősítése" required>
            <p class="err-msg">
                
                <?php if($cpassErr!=1){ echo $cpassErr; } ?>
                            </p>
            <h3>Van már felhasználó fiókod? Jelentkezz be<a href="bejelentkezes.html">itt.</a></h3>
            <button type="submit">Regisztrálok</button>
            <button type="button" onclick="goToHomePage()">Mégse</button>
    
            </form>
        </main>
    </body>
    <script>
    function goToHomePage() {
        location.href = "konferencia.html";
        href='konferencia.html';
    }

  
  </script>
  <script src="hamburger.js"></script>
</html>