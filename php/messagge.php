<?php 
    require_once 'session_Manager.php';
    require_once 'page.php';
    $username = createSession();
    $page = new page();

    if (!$_SESSION['errorMsg'] && !$_SESSION['successMsg']){
        header('Location: err-404.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <link rel="icon" type="image/x-icon" href="../img/2061866.png"/>
        <title>Home Page - Auto Asta</title>
        <link rel="stylesheet" type="text/css" media="screen" href="../css/styleAlternative.css"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width:1200px), only screen and (max-width:1200px)"  href="../css/mobile.css"/>
        <link rel="stylesheet" type="text/css" media="print" href="../css/print.css"/>
        <meta charset="UTF-8"/>
        <meta name="description" content="Pagina messaggi di Auto Asta"/>
        <meta name="keywords" content="auto, asta, messaggi, avviso, veicoli"/>
        <meta name="author" content="Carlesso Niccolò, Pillon Matteo, Soldà Matteo, Veronese Andrea"/>       
    </head>
    <body>
        <div class="globalDiv">     

        <?php require_once ('header.php')?>

            <div id="content" tabindex="8">
                <?php
                    if (isset($_SESSION['errorMsg']))
                        $page->printFeedback($_SESSION['errorMsg'],false);
                     elseif(isset($_SESSION['successMsg']))
                        $page->printFeedback($_SESSION['successMsg'],true);
                    unset($_SESSION['errorMsg']);
                    unset($_SESSION['successMsg']);
                ?>
            </div>   
        <?php require_once ('../html/footer.html')?>
        </div>
    </body>
