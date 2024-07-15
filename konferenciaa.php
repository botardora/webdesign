<?php
session_start();
$_SESSION;
include("functions.php");
include("database.php");
$userdata = check_login($conn);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="EMIK, konferencia, erdélyi informatikus, informatika, Kezdőoldal">
    <title>17. EMIK</title>
    <link rel="icon" type="image/x-icon" href="fsharp-logo.png">
    <link rel="stylesheet" href="konferencia2.css">
    <link rel="stylesheet" href="countdown.css">
    <!-- <link rel="stylesheet" href="konf.css"> -->
    <style>
        .sponsor-container {
  display: flex;
  flex-wrap: wrap;
}

.sponsor-logo {
  flex-basis: 33%;
  max-width: 33%;
  box-sizing: border-box;
  padding: 5px;
  text-align: center;
}

@media (max-width: 800px) {
  .sponsor-logo {
    flex-basis: 100%;
    max-width: 100%;
  }
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
            <li><a href="konferencia.php">Kezdőoldal</a></li>
            <li><a href="rolunk.php">Rólunk</a></li>
            <li><a href="informaciok.php">Információk</a></li>
            <li><a href="eloadok.php">Előadók</a></li>
            <li><a href="logout.php">Kijelentkezés</a></li>
            <li><p>Hello, <?php echo $userdata['KNev']; ?>!</p></li>
        </ul>
    </nav>
</div>
<main class="container">
    <img src="fsharp-logo.png" alt="logo" class="center2">
        <h1>XVII. ERDÉLYI MAGYAR INFORMATIKUSOK KONFERENCIÁJA</h1>
        <h2></h2>
        <h2>Június 23-25, kolozsvár</h2>
        <div class="panel" style="text-align: center;">
            <h4 style="color: rgb(175, 219, 245); font-size: 3vw; padding-left: 100px;padding-top: 100px; padding-right: 100px;text-align: center;">Újra találkozunk!</h4>
            <header id="showcase">
        
                <div class="showcont">
        
                    <div class="container">
                        <div id="countdown">
                            <ul>
                                <li1><span id="days"></span>Nap</li1>
                                <li1><span id="hours"></span>Óra</li1>
                                <li1><span id="minutes"></span>Perc</li1>
                                <li1><span id="seconds"></span>Másodperc</li1>
                            </ul>
                        </div>
                    </div>
        
                </div>
        
            </header>
            <h5 style="color: rgb(175, 219, 245); font-size: 2vw; padding-left: 150px;  padding-right: 150px;text-align: center;">
                2023-ban ismét megrendezésre kerül az Erdélyi Magyar Informatikusok konferenciája! Idén, ahogy előző években is, 
                meghívott előadóink mellett a te kutatásodra is kiváncsiak vagyunk! Vegyél részt Erdély legnevesebb informatikus konferenciáján és tudj meg 
                többet az elmúlt év újításairól egy barátságos környezetben!

            </h5>
        <a href="jelentkezes.html" style="text-decoration: none;">
            <button class="butt" style="display: block; margin: 0 auto; margin-top: 60px; margin-bottom: 100px;">Jelentkezz itt!</button>
        </a>
        
        <!-- <div class="panel" > -->
        <div class="bottom">
      
    <h3 style="text-align: center;">Támogatóink</h3>
    <div class="sponsor-container">
        <div class="sponsor-logo">
          <img src="bitstone.png" alt="Sponsor Logo 1" class="center">
        </div>
        <div class="sponsor-logo">
          <img src="accenture.png" alt="Sponsor Logo 2" class="center">
        </div>
        <div class="sponsor-logo">
          <img src="Bosch_logo.png" alt="Sponsor Logo 3" class="center">
        </div>
        <div class="sponsor-logo">
          <img src="Nagarro_logo.png" alt="Sponsor Logo 4" class="center">
        </div>
        <div class="sponsor-logo">
          <img src="rebeldot.png" alt="Sponsor Logo 5" class="center">
        </div>
        <div class="sponsor-logo">
          <img src="Wolters_Kluwer.png" alt="Sponsor Logo 6" class="center">
        </div>
      </div>
</div>
</div>
</main>
</body>

<script src="hamburger.js"></script>
<p id="countdown"></p>
<script src="countdown.js"></script>

</html>
