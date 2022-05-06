<!DOCTYPE html>
<html lang="it">
    <head>
        <link rel="icon" type="image/x-icon" href="../img/2061866.png"/>
        <title>Home Page - Auto Asta</title>
        <link rel="stylesheet" type="text/css" media="screen" href="../css/styleAlternative.css"/>
        <link rel="stylesheet" type="text/css" media="screen and (max-width:1200px), only screen and (max-width:1200px)"  href="../css/mobile.css"/>
        <link rel="stylesheet" type="text/css" media="print" href="../css/print.css"/>
        <meta charset="UTF-8"/>
        <meta name="description" content="Homepage di Auto Asta"/>
        <meta name="keywords" content="auto, asta, homepage, principale, veicoli"/>
        <meta name="author" content="Carlesso Niccolò, Pillon Matteo, Soldà Matteo, Veronese Andrea"/>       
    </head>
    <body>
        <div class="globalDiv">     
<?php
require_once("header.php");
require_once("Backend/sql_wrapper.php");
require_once("Backend/htmlMaker.php");

$search = $_POST['search'];


$connessione = SqlWrap::connect();
$modelloAuto = SqlWrap::query("SELECT Targa FROM veicolo WHERE marca = '$search';",true);
$descrizioneAuto = SqlWrap::query("SELECT descrizione FROM veicolo WHERE Targa='$search';",true);
$descrizioneEvento = SqlWrap::query("SELECT descrizione from evento where nome='$search';",true);


if ($modelloAuto) {
    foreach($modelloAuto as $auto) {
        echo $auto;
        echo "\r\n";
    }
  }

if ($descrizioneAuto) {
    foreach($descrizioneAuto as $descrizione) {
        echo $descrizione;
        echo "\t";
    }
}
if ($descrizioneEvento) {
    foreach($descrizioneEvento as $evento) {
        echo $evento;
        echo "\t";
    }
}
?>
            <div id="content" tabindex="8">
                
            </div>   
        <?php require_once ('../html/footer.html')?>
        </div>
    </body>
</html>