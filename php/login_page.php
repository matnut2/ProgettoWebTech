<?php
    require_once 'session_Manager.php';
    require_once 'page.php';
    $username = createSession();
    $page = new page();

    if($username->isReg()){
        $_SESSION['errorMSG'] = "Hai gi&agrave; effettuato l\'accesso";
        header("Location: pagina_avvisi.php");
        exit();
    } else {
        if (!empty($_POST)){
            $user = login($_POST['email'], $_POST['psw']);
            $page->setErrors(!$user->isReg());
            if (!$page->hasErrors()){
                header("Location: index.php");
                exit();
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <link rel="icon" type="image/x-icon" href="../img/2061866.png"/>
        <title>Login Utente - Auto Asta</title>
        <link rel="stylesheet" type="text/css" media="screen" href="../css/styleAlternative.css"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width:1200px), only screen and (max-width:1200px)"  href="../css/mobile.css"/>
        <meta charset="UTF-8"/>
        <meta name="description" content="Login Utente di Auto Asta"/>
        <meta name="keywords" content="auto, asta, homepage, principale, veicoli"/>
        <meta name="author" content="Carlesso Niccolò, Pillon Matteo, Soldà Matteo, Veronese Andrea"/>       
    </head>
    <body>
        <div class="globalDiv">
        <?php require_once ('header.php')?>
        <div id="content">
        <form action="../php/login_page.php" method="post">
            <div class="login_form">
            <h2>FORM LOGIN</h2>
            <p>Compila i campi seguenti per completare il login </p>
            <hr>
        
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Inserisci la tua email" name="email" id="email" required>
        
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Inserisci la tua  password" name="psw" id="psw" required>

            <?php 
                if ($page->hasErrors())
                $page->printMessagge('Username o password errati',false);
            ?>
        
            <button type="submit" class="register_btn">ACCEDI</button>
            </div>
        </form>
        </div>
        <?php require_once ('../html/footer.html')?>
        <div class="globalDiv">
    </body>
</html>