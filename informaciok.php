<?php
session_start();
$_SESSION;
include("functions.php");
include("database.php");
$userdata = check_login($conn);
//$userdata = null;
    if (isset($_SESSION['jelszo'])) {
        $userdata = check_login($conn);
    }
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="EMIK, konferencia, erdélyi informatikus, informatika, Információk, kutatás">
    <title>17. EMIK</title>
    <link rel="icon" type="image/x-icon" href="fsharp-logo.png">
    <link rel="stylesheet" href="konferencia2.css">
    <link rel="stylesheet" href="infotimeline.css">
    <style>
       
    </style>
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
            <?php
            if ($userdata){
            echo '<li><a href="konferencia.php">Kezdőoldal</a></li>';
            echo '<li><a href="rolunk.php">Rólunk</a></li>';
            echo '<li><a href="informaciok.php">Információk</a></li>';
            echo '<li><a href="eloadok.php">Előadók</a></li>';
            
            echo '<li><a href="dolgozat.php" >Feltöltés</a></li>';
            echo '<li><a href="logout.php">Kijelentkezés</a></li>';
            echo "<h4>Hello, {$userdata['KNev']}!</h4>";
        } else if (isset($_SESSION['Email'])) {
            echo '<li><a href="konferencia.php">Kezdőoldal</a></li>';
            echo '<li><a href="rolunk.php">Rólunk</a></li>';
            echo '<li><a href="informaciok.php">Információk</a></li>';
            echo '<li><a href="eloadok.php">Előadók</a></li>';
            echo '<li><a href="logout.php">Kijelentkezés</a></li>';
            echo "<h4>Hello, {$userdata['KNev']}!</h4>";
        } else {
            echo '<li><a href="konferencia.php">Kezdőoldal</a></li>';
            echo '<li><a href="rolunk.php">Rólunk</a></li>';
            echo '<li><a href="informaciok.php">Információk</a></li>';
            echo '<li><a href="eloadok.php">Előadók</a></li>';
           
            echo '<li><a href="jelentkezes.php" >Regisztráció</a></li>';
            echo '<li><a href="jelentkezes2.php">Bejelentkezés</a></li>';}
            ?>
        </ul>
    </nav>
    </div>
    <main class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main-timeline">
                    <div class="timeline">
                        <a href="" class="timeline-content" style="text-decoration: none;">
                            <h3 class="title">Jelentkezz előadónak!</h3>
                            <p class="description">Egy különleges alkalom, hogy megmutasd az erdélyi magyar informatikus közösségnek a kutatásod, azt amivel az utóbbi 
                                időben foglalkoztál. A jelentkezési határidő 2023. május 31.
                            </p>
                        </a>
                    </div>
                    <div class="timeline">
                        <a href="" class="timeline-content" style="text-decoration: none;">
                            <h3 class="title">Jelentkezési feltételek</h3>
                            <p class="description">Ahhoz, hogy jelentkezésed eljusson hozzánk, regisztráláskor mindenképp add meg az előadásod címét, meg egy rövid leírást
                                róla, ahol pontosítod azt is, hogy körülbelül mennyi időt igényel ennek a bemutatása. A beérkezett jelentkezéseket elbíráljuk, annak függvényében, hogy 
                                mennyire illeszkednek egymáshoz a témák és mennyit tudunk beilleszteni a konferencia idejébe.
                            </p>
                        </a>
                    </div>
                    <div class="timeline">
                        <a href="" class="timeline-content" style="text-decoration: none;">
                            <h3 class="title">Helyszín</h3>
                            <p class="description">A konferencia Kolozsváron kerül megszervezésre, a Babeș-Bolyai Tudományegyetem Közgazdaság- és Gazdálkodáskodástudományi
                                Karának épületépen. A pontos termekkel és a programmal később fogunk jelentkezni.
                            </p>
                        </a>
                    </div>
                    <div class="timeline">
                        <a href="" class="timeline-content" style="text-decoration: none;">
                            <h3 class="title">Díjak</h3>
                            <p class="description">A kiemelkedő tudományos tevékenységgel rendelkezők között minden évben szoktunk kiosztani különdíjakat.
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
<script src="hamburger.js"></script>
</html>