<?php
    include_once 'database_Manager.php';

    $username = $_POST['email'];
    
    //Quantomeno proviamo a mascherare sta password, altrimenti cosa ho fatto cybersecurity a fare
    $encPWD = MD5($_POST['psw']);

    $connessione = new database_Manager();
    $connessione->connectDB();

    $query = "SELECT email FROM account WHERE password == '$encPWD' ";
    $queryResult = mysqli_query($connessione->connection, $query) or die("Errore nella ricerca dell'utente:" . mysqli_error($this->connection));
?>