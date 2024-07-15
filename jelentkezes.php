<?php
session_start();
include("database.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
  if ($_POST['tipus'] == 'nezo') {
    header("Location: nezo.php");
    exit();
  } else if ($_POST['tipus'] == 'eloado') {
    header("Location: regisztracio.php");
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="EMIK, konferencia, erdélyi informatikus, informatika, jelentkezés, előadó, kutatás">
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
        input[type="tel"],
        select,
        textarea {
          width: 100%;
          padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      margin-bottom: 10px;
    }

    input[type="radio"],
    input[type="checkbox"] {
      margin-right: 5px;
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
      input[type="tel"],
      select,
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
            <li><a href="regisztracio.php" >Regisztráció</a></li>
            <li><a href="login.php">Bejelentkezés</a></li>
            
            </ul>
        </nav>
    </div>
    <div class="container">
  <h2>Regisztráció</h2>

  <form action="jelentkezes.php" method="post">
    <label for="tipus">Válasszon:</label><br>
    <select id="tipus" name="tipus" required>
        <option value="eloado">Előadónak jelentkezem</option>
        <option value="nezo">Néző vagyok</option>
      </select><br><br>
      <br><input class="button" type="submit" value="Regisztralok" name="submit">
      <input type="button" value="Mégse" onclick="window.location.href='konferencia.php'">
    </form>
    </div>
    


  <script>

    function loadForm(role) {
    const formContainer = document.getElementById('registrationForm');
    const xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {
        formContainer.innerHTML = this.responseText;
      }
    };

    if (role === 'Előadó') {
      xhttp.open('GET', 'eloado.html', true);
    } else if (role === 'Néző') {
      xhttp.open('GET', 'nezo.html', true);
    }
    
    xhttp.send();
  }

    function cancelRegistration() {
      location.href = "konferencia.html";
    }
    
    document.getElementById("registrationForm").addEventListener("submit", function(event) {
      event.preventDefault();
      if (validateForm()) {
        alert("Sikeres regisztráció!");
        location.href = "konferencia.html";
      }
    });
    
    function validateForm() {
      var name = document.getElementById("name").value;
      var email = document.getElementById("email").value;
      var phone = document.getElementById("phone").value;
      var presentationTitle = document.getElementById("presentationTitle").value;
      var presentationDescription = document.getElementById("presentationDescription").value;
      
      // Név validáció (minimum 3 karakter)
      if (name.length < 3) {
        alert("Kérjük, adja meg a nevét!");
        return false;
      }
      // Email validáció
      if (!validateEmail(email)) {
        alert("Kérjük, adjon meg érvényes email címet!");
        return false;
      }
      
      // Telefonszám validáció (10-15 számjegy)
      if (!validatePhone(phone)) {
        alert("Kérjük, adjon meg érvényes telefonszámot!");
        return false;
      }
      
      // Előadás cím és leírás validáció, ha az előadó
      var eventType = document.querySelector('input[name="role"]:checked').value;
      if (eventType === "Előadó") {
        if (presentationTitle.trim().length === 0 || presentationDescription.trim().length === 0) {
          alert("Kérjük, adja meg az előadás címét és leírását!");
          return false;
        }
      }
      
      return true;
    }
    
    function validateEmail(email) {
      var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      return emailRegex.test(email);
    }
    
    function validatePhone(phone) {
      var phoneRegex = /^\d{10,15}$/;
      return phoneRegex.test(phone);
    }

    
  </script>
</body>
<script src="hamburger.js"></script>
</html>
