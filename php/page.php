<?php 
include_once("database_Manager.php");
include_once("session_Manager.php");
class page {

    public $errors = null;

    private static function checkFileName($name){
        return ($_SERVER['SCRIPT_NAME'] == "/Github/ProgettoWebTech/php/". $name);
    }

    public function inserimentoNuovoUtente ($post, utente_Non_Registrato $utente){
        $utente -> iscrizione($post['email'],$post['username'], $post['psw'], 0,$post['nome'],$post['cognome']
        ,$post['url_immagine'],$post['data_nascita']);
        if($utente){
            return true;
        }
        else return false;
    }

    public function printBreadcrumb(){
        if($this->checkFileName("index.php")){
            echo "<p lang=\"en\">Home</p>";
        }
        else if($this->checkFileName("chisiamo.php")){
            echo "<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt Chi Siamo </p>";
        }
        else if($this->checkFileName("eventi.php")){
            echo "<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt Eventi </p>";
        }
        else if($this->checkFileName("veicoli.php")){
            echo "<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt Veicoli </p>";
        }
        else if($this->checkFileName("login_page.php")){
            echo "<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt
                    <a href=\"registrazione.php\">Registrazione Utente</a> &gt &gt
                <span lang=\"en\">Login </span> </p>";
        }
        else if($this->checkFileName("registrazione.php")){
            echo"<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt
                Registrazione Utente
            ";
        }
        else if($this->checkFileName("pagina_avvisi.php")){
            echo"<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt
                Pagina Avvisi
            ";
        }
    }

    public function printMenu() {
        if ($this->checkFileName("index.php")){
            echo "<li lang=\"en\">Home</li>";
            echo "<li><a href=\"chisiamo.php\">Chi Siamo</a></li>";
            echo "<li><a href=\"eventi.php\">Eventi</a></li>";
            echo "<li><a href=\"veicoli.php\">Veicoli</a></li>";
        } 
        else if ($this->checkFileName("chisiamo.php")){
            echo "<li><a href=\"index.php\" lang=\"en\">Home</a></li>";
            echo "<li>Chi Siamo</li>";
            echo "<li><a href=\"eventi.php\">Eventi</a></li>";
            echo "<li><a href=\"veicoli.php\">Veicoli</a></li>";
        } 
        else if ($this->checkFileName("eventi.php")){
            echo "<li><a href=\"index.php\" lang=\"en\">Home</a></li>";
            echo "<li><a href=\"chisiamo.php\">Chi Siamo</a></li>";
            echo "<li>Eventi</li>";
            echo "<li><a href=\"veicoli.php\">Veicoli</a></li>";
        } 
        else if ($this->checkFileName("veicoli.php")){
            echo "<li><a href=\"index.php\" lang=\"en\">Home</a></li>";
            echo "<li><a href=\"chisiamo.php\">Chi Siamo</a></li>";
            echo "<li><a href=\"eventi.php\">Eventi</a></li>";
            echo "<li>Veicoli</li>";
        }
        else{
            echo "<li><a href=\"index.php\" lang=\"en\">Home</a></li>";
            echo "<li><a href=\"chisiamo.php\">Chi Siamo</a></li>";
            echo "<li><a href=\"eventi.php\">Eventi</a></li>";
            echo "<li><a href=\"veicoli.php\">Veicoli</a></li>";
        } 
        /*
            TO DO: 
            Controllo se l'utente è loggato o meno
                - IF FALSE: non cambio la struttura del menu
                - IF TRUE: 
                    - AREA PROFILO (in cui si possono modificare i dati utente inseriti)
                    - SE AMMINISTRATORE --> mostrare area per modifica/inserimento/cancellazione auto
        */
    }

    public function printMessagge($msg,$success){
        if($success){
            echo"<div class=\"success-msg\">";
        }
        else{
            echo"<div class=\"failed-msg\">";
        }
        echo"
            <p>$msg</p>
            </div>";
    }

    public function printLogin(){
        

        echo "<a href=\"registrazione.php\">ACCEDI/REGISTRATI</a>";
    }

    public function setErrors($errors){
        $this->errors = $errors;
    }

    public function hasErrors(){
        if($this->errors == null) return false;
        if(!is_array($this->errors)) return !empty($this->errors);
        $checkErr = false;
        foreach($this->errors as $error){
            $checkErr = $checkErr || !empty($error);
        }
        return $checkErr;
    }
}
?>