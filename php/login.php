<?php
    require_once 'session_Manager.php';
    //$username = createSession();
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <link rel="icon" type="image/x-icon" href="../img/2061866.png"/>
        <title>Eventi - Auto Asta</title>
        <link rel="stylesheet" type="text/css" media="screen" href="../css/styleAlternative.css"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width:600px), only screen and (max-width:600px)"  href="../css/mobile.css"/>
        <meta charset="UTF-8"/>
        <meta name="description" content="Homepage di Auto Asta"/>
        <meta name="keywords" content="auto, asta, homepage, principale, veicoli"/>
        <meta name="author" content="Carlesso Niccolò, Pillon Matteo, Soldà Matteo, Veronese Andrea"/>       
    </head>
    <body>
        <div class="globalDiv">
        <?php require_once ('header.php')?>
        <div id="content">
        <form action="../php/login.php">
        <div class="login_form">
            <h2>FORM LOGIN</h2>
            <p>Compila i campi seguenti per completare il login </p>
            <hr>
        
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Inscerisci la tua email" name="email" id="email" required>
        
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Inscerisci la tua  password" name="psw" id="psw" required>
        
            <button type="submit" class="register_btn">ACCEDI</button>
            </div>
        </form>
        </div>
        <?php require_once ('../html/footer.html')?>
        <div class="globalDiv">
    </body>
</html>