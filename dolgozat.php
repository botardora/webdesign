<?php
session_start();
$_SESSION;
include("functions.php");
include("database.php");
$userdata = check_login($conn);
if($conn){
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){

        $cim = mysqli_real_escape_string($conn, $_POST["cim"]);
        $tars = mysqli_real_escape_string($conn, $_POST["tars"]);
        $absztrakt = mysqli_real_escape_string($conn, $_POST["absztrakt"]);
        $kulcs = mysqli_real_escape_string($conn, $_POST["kulcs"]);
        $szekcio = mysqli_real_escape_string($conn, $_POST["szekcio"]);
        $szekcioid = "SELECT SzekcioID FROM szekcio WHERE Nev = '$szekcio'";
        $resultszid = mysqli_query($conn, $szekcioid);

    if ($resultszid && mysqli_num_rows($resultszid) > 0) {
        $row = mysqli_fetch_assoc($resultszid);
        $szekcio_id = $row['SzekcioID'];
    if (isset($_FILES['dolgozat'])) {
        $file = $_FILES['dolgozat'];

        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];

        if ($file_tmp == ""){
        
        function_alert('Add meg a feltöltendő fájlt.');
        

        }else {
       
        $file_ext = explode('.',$file_name);
        $file_ext = strtolower(end($file_ext));

        $allowed = array('pdf', 'ppt', 'pptx');
        if (in_array($file_ext, $allowed)){
            if($file_error == 0){
                if ($file_size <= 2097152){

                   $Email=$userdata['Email'];  
                     $sql = "SELECT VNev, KNev FROM eloado WHERE Email='$Email'";

                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                       
                        while($row = mysqli_fetch_assoc($result)) {
                            $VNev=$row["VNev"];
                            $KNev=$row["KNev"];
                            
                             }
                    // echo $V_nev." ".$K_nev." ".$NrMatricol;
                    $vnev1=preg_replace('/^(.{1}).*/','\1', $VNev);
                      //    echo $V_nev1;
                    $knev1=preg_replace('/^(.{1}).*/','\1', $KNev);
                     //     echo $K_nev1;
                    
                    $str='EMIK_'.$vnev1."_".$knev1. "_" . uniqid().".".$file_ext;
                    $new_name=strtolower($str);
                   // echo "new name: ".$new_name."<br>";
                                        
                    
                    $file_destination = 'fajlok/'.$new_name;

                    if (!file_exists("fajlok/".$new_name)) {
                        
                        $sql1 = "INSERT INTO dolgozat (Cim, Absztrakt, PDF, Kulcsszavak, Tarsszerzok, SZID, Email) VALUES ( '$cim', '$absztrakt', '$new_name', '$kulcs', '$tars', '$szekcio_id', '$Email')";
                        $result1=mysqli_query($conn,$sql1);
                        if ($result1) {
                            if (move_uploaded_file($file_tmp, $file_destination)) {
                                //$dolgozat_id = mysqli_insert_id($conn);
                                //echo "<br>"."Sikeres fájlfeltöltés"."<br>"."Fájl neve: ".$new_name;
                                // $email = $userdata['Email'];
                                // $update_sql = "UPDATE eloado SET DID='$dolgozat_id' WHERE Email='$email'";
                                // $update_result = mysqli_query($conn, $update_sql);
            
                                // if ($update_result) {
                                    function_alert("Sikeres fájlfeltöltés!");
                                    header("Location: konferencia.php");
                                    exit();
                                } else {
                                    echo "Hiba az eloadok tábla frissítésekor: " . mysqli_error($conn);
                                }
                                if ($result_check_file && mysqli_num_rows($result_check_file) > 0) {
                                    // Ha talált már ilyen fájlt, kérdezd meg, hogy felül szeretné írni vagy sem
                                    $delete_previous_file = 'fajlok/'.$new_name;
                                    
                                } else {
                                    $error = mysqli_error($conn);
                                    echo $error;
                                }
                            } else {
                                echo "Hiba az adatbázisba való beszúrásnál: " . mysqli_error($conn);
                            }
                        }  
                    } else {
                    echo "A fájl már létezik!";
                }

                    
                }
            }
        }
    }
}}}}

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
            
            <li><a href="logout.php">Kijelentkezés</a></li>
            <h4>Hello, <?php echo $userdata['KNev']; ?>!</h4>
            </ul>
        </nav>
        <div class="container">
            <h2>Dolgozat feltöltése</h2>
            <form action="dolgozat.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Dolgozat címe:</label>
                    <input type="text" id="cim" name="cim"  required>
                    </div>
                    <div class="form-group">
                        <label>Társszerzők:</label>
                        <input type="text" id="tars" name="tars">
                        </div>
                        <div class="form-group">
                            <label for="szekcio">Szekció:</label>
                            <select name="szekcio" id="szekcio" required>
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
                    <label>Abstrakt:</label>
                    <textarea id="absztrakt" name="absztrakt" rows="5" required></textarea>
                    </div>
                <div class="form-group">
                <label>Kulcsszavak:</label>
            <input type="text" id="kulcs" name="kulcs" >
                </div>
                <div class="form-group">
                <label>Fájl feltöltése:</label>
                <input type="file" name="dolgozat" id="dolgozat">
                </div>
                <div class="form-group">
                    <br><input class="button" type="submit" value="Feltöltés" name="submit">
                    <input type="button" value="Mégse" onclick="window.location.href='konferencia.php'">

                </div>
        
            </form>
                
    </div>
        
    </body>
    <script>

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