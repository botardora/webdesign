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
        <meta name="keywords" content="EMIK, konferencia, erdélyi informatikus, informatika, kérdések">
        <title>17. EMIK</title>
        <link rel="icon" type="image/x-icon" href="fsharp-logo.png">
        <link rel="stylesheet" href="konferencia2.css">
        <style>
            body {
                font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
                background-color: #f2f2f2;
                margin: 0;
                padding: 20px;
            }
    
            h2 {
                text-align: center;
            }
    
            form {
                max-width: 500px;
                margin: 0 auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            }
            label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
        }
        button[type="button"] {
            background-color: #f44336;
        }

        @media screen and (max-width: 700px) {
            form {
                padding: 10px;
            }

            input[type="text"],
            input[type="email"],
            textarea {
                padding: 6px;
            }

            button {
                padding: 8px 16px;
                font-size: 14px;
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
            <li><a href="kerdesek.php">Kérdések</a></li>
            <li><a href="regisztracio.php" >Regisztráció</a></li>
            <li><a href="login.php">Jelentkezés</a></li>
            <li><a href="logout.php">Kijelentkezés</a></li>
            <li><p>Hello, <?php echo $userdata['KNev']; ?>!</p></li>
            </ul>
        </nav>
        <main class="container">
        <h2>Kérdés küldése</h2>
    <form id="questionForm">
        <label for="fullName">Teljes név:</label>
        <input type="text" id="fullName" name="fullName" required>

        <label for="email">Email cím:</label>
        <input type="email" id="email" name="email" required>

        <label for="question">Kérdés:</label>
        <textarea id="question" name="question" rows="5" required></textarea>

        <button type="submit">Küldés</button>
    </form>
</main>
    <script>
        document.getElementById("questionForm").addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent form submission

            // Process the form data here
            var fullName = document.getElementById("fullName").value;
            var email = document.getElementById("email").value;
            var question = document.getElementById("question").value;

            // You can perform further validation or send the data to a server using AJAX

            // Show a confirmation message
            alert("Köszönjük a kérdésed!");

            // Redirect back to the conference page
            window.location.href = "konferencia.html";
        });
    </script>
</body>
<script src="hamburger.js"></script>

</html>







