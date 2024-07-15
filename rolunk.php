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
    <meta name="keywords" content="EMIK, konferencia, erdélyi informatikus, informatika, rólunk">
    <title>17. EMIK</title>
    <link rel="icon" type="image/x-icon" href="fsharp-logo.png">
    <link rel="stylesheet" href="konferencia2.css">
    
    <style>
        .image-description-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .image {
            flex-basis: 50%;
            max-width: 50%;
            box-sizing: border-box;
            padding-top: 200px;
            padding: 10px;
            text-align: center;
        }

        .description {
            flex-basis: 50%;
            max-width: 50%;
            box-sizing: border-box;
            padding-top: 200px;
            padding: 30px;
            text-align: center;
        }

        .container{
            margin-top: 10%;
        }
        @media (max-width: 800px) {
            .image,
            .description {
                flex-basis: 90%;
                max-width: 90%;
            }
        }

        .center {
            margin-left: auto;
            margin-right: auto;
            display: block;
            width: 75%;
            margin-top: 5%;
        }

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
        <ul class="nav-links">
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
    <div class="image-description-container">
        <div class="image">
            
            <img src="konferencia.png" alt="kep" class="center">
            </div>
            <div class="description">
    <!-- <h5 style="color: rgb(175, 219, 245); font-size: 2vw; padding-left: 60%; padding-top: 100px;  padding-right: 150px;text-align: right; display: inline-block;"> -->
        <h5 style="color: rgb(175, 219, 245); font-size: 1.75vw;">
        A konferenciánknak 2004 óta hagyománya van. Két év kihagyás után tavaly ismét megszerveztük és az eddigieknél mégnagyobb népszerűségnek örvendett.
        Célunk összetartani az erdélyi magyar informatikus közösséget és évente egyszer összegyülni, hogy megosszuk egymással, megvitassuk az újításokat az informatika 
        világából. Ugyanakkor az ismerkedés, szórakozás is fontos részét képezi ezeknek az amúgy szakmai hétvégéknek. A jó hangulat minden évben garantált és 
        a visszajelzések alapján mindig hasznos információkkal térnek haza résztvevőink.
    </h5>
    </div>
    </div>
    </main>
    <script src="hamburger.js"></script>
</body>
</html>