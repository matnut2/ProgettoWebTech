<?php 
require_once("database_Manager.php");
require_once("session_Manager.php");
class page {

    public $errors = null;

    private static function checkFileName($name){
        return ($_SERVER['SCRIPT_NAME'] == "/GitHub/ProgettoWebTech/php/". $name);
    }

    private function checkUserLog(){
        if(isset($_SESSION["ID"]) && $_SESSION["ID"]!=-1){ //se ID è istanziato ed è diverso da -1 significa che l'utente è registrato
            //echo("$_SESSION[ID]");
            return true;
        }
        else{
            //echo("$_SESSION[ID]");
            return false;
        }
    }

    public function inserimentoNuovoUtente ($post, utente_Non_Registrato $utente){
        $utente -> iscrizione($post['email'],$post['username'], $post['psw'], 0,$post['nome'],$post['cognome']
        ,$post['url_immagine'],$post['data_nascita']);
        if($utente){
            return true;
        }
        else return false;
    }

    public function updateUserInfo($post, utente_Registrato $utente){
        $utente->updateUserInfo($post['username'],$post['psw'],$post['url_immagine'],$post['data_nascita']);
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
        else if($this->checkFileName("scheda_utente.php")){
            echo"<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt
                Scheda Utente
            ";
        }
        else if($this->checkFileName("edit_profile.php")){
            echo"<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt
                <a href=\"scheda_utente.php\">Scheda Utente</a> &gt &gt
                Modifica Profilo
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
            echo "<li class='shome' id='active' lang=\"en\">Home</li>";
            echo "<li class='schisiamo'><a href=\"chisiamo.php\">Chi Siamo</a></li>";
            echo "<li class='seventi'><a href=\"eventi.php\">Eventi</a></li>";
            echo "<li class='sveicoli'><a href=\"veicoli.php\">Veicoli</a></li>";
        } 
        else if ($this->checkFileName("chisiamo.php")){
            echo "<li class='shome'><a href=\"index.php\" lang=\"en\">Home</a></li>";
            echo "<li class='schisiamo' id='active'>Chi Siamo</li>";
            echo "<li class='seventi'><a href=\"eventi.php\">Eventi</a></li>";
            echo "<li class='sveicoli'><a href=\"veicoli.php\">Veicoli</a></li>";
        } 
        else if ($this->checkFileName("eventi.php")){
            echo "<li class='shome'><a href=\"index.php\" lang=\"en\">Home</a></li>";
            echo "<li class='schisiamo'><a href=\"chisiamo.php\">Chi Siamo</a></li>";
            echo "<li class='seventi' id='active'>Eventi</li>";
            echo "<li class='sveicoli'><a href=\"veicoli.php\">Veicoli</a></li>";
        } 
       else if ($this->checkFileName("veicoli.php")){
            echo "<li class='shome'><a href=\"index.php\" lang=\"en\">Home</a></li>";
            echo "<li class='schisiamo'><a href=\"chisiamo.php\">Chi Siamo</a></li>";
            echo "<li class='seventi'><a href=\"eventi.php\">Eventi</a></li>";
            echo "<li class='sveicoli' id='active'>Veicoli</li>";
        }

        else{
            echo "<li class='shome'><a href=\"index.php\" lang=\"en\">Home</a></li>";
            echo "<li class='schisiamo'><a href=\"chisiamo.php\">Chi Siamo</a></li>";
            echo "<li class='sevento'><a href=\"eventi.php\">Eventi</a></li>";
            echo "<li class='sveicoli'><a href=\"veicoli.php\">Veicoli</a></li>";
        } 

        if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==1){
            echo "<li><a href=\"\">Modifica veicoli</a></li>";
            echo "<li><a href=\"\">Modifica eventi</a></li>";
        }
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
        if (!$this->checkFileName("scheda_utente.php")){
            if(!$this->checkUserLog()){ 
                echo "<a href=\"registrazione.php\">ACCEDI/REGISTRATI</a>";
            }
            else{
                echo "<a href=\"scheda_utente.php\">VISITA IL TUO PROFILO</a>";
            }
        }
        else {
            echo "SEI NEL TUO PROFILO";
        }   
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
