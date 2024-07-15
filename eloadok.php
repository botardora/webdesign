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
    <meta name="keywords" content="EMIK, konferencia, erdélyi informatikus, informatika, előadók, kutatás, Minier Zsolt, Simon Károly, Kodok Márton, W. Szabó Péter, Fülöp Botond">
    <title>17. EMIK</title>
    <link rel="icon" type="image/x-icon" href="fsharp-logo.png">
    <link rel="stylesheet" href="konferencia2.css">
    <link rel="stylesheet" href="eloadok.css">
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
       <h1></h1>
       <h1></h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="main-timeline9">
                        <div class="timeline">
                            <div class="timeline-content">
                                <div class="circle">
                                    <span class="image">
                                        <img src="minierzsolt.png" alt="Image">
                                        <i class="fa fa-globe"></i></span></div>
                                    <div class="content">
                                        <span class="year">Dr. Minier Zsolt</span>
                                        <h4 class="title">Gondolatok a szingularitásról</h4>
                                        <p class="description">
                                            Bekövetkezik-e ez az időpont, amikor az ember már nem  látja  át, tehát nem is befolyásolhatja az MI fejlődését és így gyakorlatilag
                                             egy új korszakba lép a civilizáció, és ha igen, mikorra várható?
                                        </p>
                                        <div class="icon">
                                        <span></span></div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="timeline">
                            <div class="timeline-content">
                                <div class="circle">
                                    <span class="image">
                                        <img src="Simon-Karoly.jpg" alt="Image">
                                        <i class="fa fa-rocket"></i></span></div>
                                <div class="content">
                                    <span class="year">Dr. Simon Károly</span>
                                    <h4 class="title">Mesterséges intelligencia, digitális művészetek és IT-oktatás </h4>
                                    <p class="description">
                                        Az MI már nem csupán egy szűk rétegnek szól, hiszen a mindennapi életünk részévé vált. A mesterséges intelligencia és a gépi tanulás azonban „vak” megfelelő adatok nélkül, amelyeket az embernek kell hozzárendelnie, 
                                        tehát a szaktudás és más emberi kompetenciák mindig is szükségesek lesznek az IT világában.
                                    </p>
                                    <div class="icon"><span></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="timeline">
                            <div class="timeline-content">
                                <div class="circle">
                                    <span class="image">
                                        <img src="Marton-Kodok.jpg" alt="Image">
                                        <i class="fa fa-globe"></i></span></div>
                                <div class="content">
                                    <span class="year">Kodok Márton</span>
                                    <h4 class="title">Webalkalmazások skálázhatósága a Google Cloud Platformon</h4>
                                    <p class="description">
                                        Az előadás témája hogyan építhető fel egy rugalmas, jól skálázható szolgáltatás a felhőszolgáltatók platformjain. Hogyan lehet megoldani, hogy a szolgáltatás, amelynek induláskor legfeljebb néhány tíz 
                                        vagy száz felhasználót kell kiszolgálnia, akár több ezer vagy nagyságrendekkel több felhasználót is képes legyen kiszolgálni rugalmasan? Hátradőlni és csodálni az autoscaling funkciót a Black Friday napján. 
                                    </p>
                                    <div class="icon"><span></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="timeline">
                            <div class="timeline-content">
                                <div class="circle">
                                    <span class="image">
                                        <img src="szabowpeter.jpg" alt="Image">
                                        <i class="fa fa-rocket"></i></span></div>
                                <div class="content">
                                    <span class="year">W. Szabó Péter</span>
                                    <h4 class="title">Képek újraalkotása a mesterséges intelligencia segítségével</h4>
                                    <p class="description">
                                        Néhány évtizede még nem gondoltuk, hogy létrejöhet egy olyan mesterséges intelligencia, amely számos területen kisegíti vagy éppen helyettesíti az emberek munkáját. Azt viszont mai napig is sokan állítják, hogy a művészet az a terület, 
                                        ahová egészen biztosan nem tud betörni ez a technikai újítás, hiszen az emberi kreativitás, tehetség nem pótolható. Ezt egyszerre erősíti és cáfolja is W. Szabó Péter.
                                    </p>
                                    <div class="icon"><span></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="timeline">
                            <div class="timeline-content">
                                <div class="circle">
                                    <span class="image">
                                        <img src="fulopbotond.jpg" alt="Image">
                                        <i class="fa fa-globe"></i></span></div>
                                    <div class="content">
                                        <span class="year">Fülöp Botond</span>
                                        <h4 class="title">Gépi tanulás a számítógépes kártevők ellen</h4>
                                        <p class="description">
                                            A rosszindulatú szoftverek elemzése lehetővé teszi azok működésének és lehetséges hatásainak meghatározását. A számítógépes biztonság elengedhetetlen feladata, 
                                            biztosítja a megértést a különféle rosszindulatú programok elleni hatékony ellenintézkedések és mérséklési stratégiák megtervezéséhez.
                                        </p>
                                        <div class="icon">
                                        <span></span></div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
    </main>
    </body>
    <script src="hamburger.js"></script>
    <script src="eloadok.js"></script>
</html>

<!-- https://bootsnipp.com/snippets/Q0ppE -->