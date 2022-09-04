<?php 
require_once("database_Manager.php");
require_once("session_Manager.php");
class page {

    public $errors = null;

    public function __construct($errors = null){
		$this->errors = $errors;
	}

	public function addError($error) {
		if (!is_array($this->errors)) {
			$this->errors = $error;
		} else {
			if (!is_array($error)){
				array_push($this->errors,$error);
			} else {
				$this->errors = array_merge($this->errors,$error);
			}
		}
	}

    public function upload ($post,$file){
        $target_dir = "../img/";
        $target_file = $target_dir . basename($file["url_immagine"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        // Check if image file is a actual image or fake image
        if(isset($post["submit"])) {
          $check = getimagesize($file["url_immagine"]["tmp_name"]);
          if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            $_SESSION["errorMsg"] =  "File is not an image.";
            $uploadOk = 0;
          }
        }
        
        // Check if file already exists
        if (file_exists($target_file)) {
          $_SESSION["errorMsg"] =  "Sorry, file already exists.";
          $uploadOk = 0;
        }
        
        // Check file size
        if ($file["url_immagine"]["size"] > 5000000) {
          $_SESSION["errorMsg"] =  "Sorry, your file is too large.";
          $uploadOk = 0;
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
          $_SESSION["errorMsg"] =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $_SESSION["errorMsg"] =  "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($file["url_immagine"]["tmp_name"], $target_file)) {
            $_SESSION["succesMsg"] =  "The file ".  basename( $file["url_immagine"]["name"]). " has been uploaded.";
          } else {
            $_SESSION["errorMsg"] =  "Sorry, there was an error uploading your file.";
          }
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
    

    private static function checkFileName($name){
        return ($_SERVER['SCRIPT_NAME'] == "/AutoAsta/php/". $name);
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
        if($post['psw'] == $post['password-repeat']){
            $utente->updateUserInfo($post['username'],$post['psw'],$post['url_immagine'],$post['data_nascita']);
            if($utente){
                return true;
            }
        }
        return false;
    }

    public function updateVeicoloInfo($post, utente_Registrato $utente){
        $utente->updateVeicolo($post['targa'],$post['marca'],$post['modello'],$post['cilindrata'],$post['anno'],$post['posti'],$post['cambio'],$post['carburante'],$post['colori_Esterni'],$post['url_Immagine'],$post['descrizione'],$post['chilometri_Percorsi'],1,$post['prezzo_base']);
        if($utente){
            return true;
        }
        else return false;
    }
    public function updateEventoInfo($id_Evento,$post, utente_Registrato $utente){
        $utente->editEvento($id_Evento,$post['capienza'],$post['data'],$post['nome'],$post['descrizione'],$post['prezzo']);
        if($utente){
            return true;
        }
        else return false;
    }

    public function printBreadcrumb(){
        if($this->checkFileName("index.php")){
            echo "<p lang=\"en\">Home</p>";
        }
        else{
            echo "<p> <a href=\"index.php\" tabindex=\"4\" lang=\"en\">Home</a>  &gt; &gt; ";
        }
        if($this->checkFileName("chisiamo.php")){
            echo " Chi Siamo </p>";
        }
        else if($this->checkFileName("eventi.php")){
            echo " Eventi </p>";
        }
        else if($this->checkFileName("veicoli.php")){
            echo "Veicoli </p>";
        }
        else if($this->checkFileName("login_page.php")){
            echo "<a href=\"registrazione.php\">Registrazione Utente</a> &gt; &gt;
                <span lang=\"en\">Login </span> </p>";
        }
        else if($this->checkFileName("registrazione.php")){
            echo" Registrazione Utente </p>";
        }
        else if($this->checkFileName("scheda_utente.php")){
            echo"Scheda Utente </p>"; 
        }
        else if($this->checkFileName("edit_profile.php")){
            echo"<a href=\"scheda_utente.php\">Scheda Utente</a> &gt; &gt;
                Modifica Profilo </p>";
        }
        else if($this->checkFileName("scheda_veicolo.php")){
            echo"<a href=\"veicoli.php\">Veicoli</a> &gt; &gt;
                Scheda Veicolo </p>";
        }
        else if($this->checkFileName("editorVeicoli.php")){
            echo"Modifica Veicoli </p>";
        }
        else if($this->checkFileName("editSingleVeicolo.php")){
            echo"<a href=\"editorVeicoli.php\">Modifica Veicoli</a> &gt; &gt;
                Veicolo Da Modificare </p>";
        }
        else if($this->checkFileName("addVeicolo.php")){
            echo"Aggiungi Veicolo </p>";
        }
        else if($this->checkFileName("addEvento.php")){
            echo"Aggiungi Evento </p>";
        }
        else if($this->checkFileName("pagina_avvisi.php")){
            echo"Pagina Avvisi </p>";
        }
	    
	    else if($this->checkFileName("listaBiglietti.php")){
            echo"Lista Biglietti </p>";
        }
        else if($this->checkFileName("selectEventoToEdit.php")){
            echo"Modifica Evento </p>";
        }
        else if($this->checkFileName("editorEventi.php")){
            echo"<a href=\"selectEventoToEdit.php\">Modifica evento</a> &gt; &gt;
            Modifica Singolo Evento </p>
            ";
        }
        else if($this->checkFileName("404.php")){
            echo"Errore 404 </p>";
        }
    }

    public function printMenu() {
        if ($this->checkFileName("index.php")){
            echo "<li class='shome' id='active' lang=\"en\">Home</li>";
            echo "<li class='schisiamo'><a href=\"chisiamo.php\" tabindex=\"0\" role=\"menuitem\">Chi Siamo</a></li>";
            echo "<li class='seventi'><a href=\"eventi.php\" tabindex=\"0\" role=\"menuitem\">Eventi</a></li>";
            echo "<li class='sveicoli'><a href=\"veicoli.php\" tabindex=\"0\" role=\"menuitem\">Veicoli</a></li>";
        } 
        else if ($this->checkFileName("chisiamo.php")){
            echo "<li class='shome'><a href=\"index.php\" lang=\"en\" role=\"menuitem\">Home</a></li>";
            echo "<li class='schisiamo' id='active'>Chi Siamo</li>";
            echo "<li class='seventi'><a href=\"eventi.php\" role=\"menuitem\">Eventi</a></li>";
            echo "<li class='sveicoli'><a href=\"veicoli.php\" role=\"menuitem\">Veicoli</a></li>";
        } 
        else if ($this->checkFileName("eventi.php")){
            echo "<li class='shome'><a href=\"index.php\" lang=\"en\" role=\"menuitem\">Home</a></li>";
            echo "<li class='schisiamo'><a href=\"chisiamo.php\" role=\"menuitem\">Chi Siamo</a></li>";
            echo "<li class='seventi' id='active'>Eventi</li>";
            echo "<li class='sveicoli'><a href=\"veicoli.php\" role=\"menuitem\">Veicoli</a></li>";
        } 
       else if ($this->checkFileName("veicoli.php")){
            echo "<li class='shome'><a href=\"index.php\" lang=\"en\" role=\"menuitem\">Home</a></li>";
            echo "<li class='schisiamo'><a href=\"chisiamo.php\" role=\"menuitem\">Chi Siamo</a></li>";
            echo "<li class='seventi'><a href=\"eventi.php\" role=\"menuitem\">Eventi</a></li>";
            echo "<li class='sveicoli' id='active'>Veicoli</li>";
        }

        else{
            echo "<li class='shome'><a href=\"index.php\" lang=\"en\" role=\"menuitem\">Home</a></li>";
            echo "<li class='schisiamo'><a href=\"chisiamo.php\" role=\"menuitem\">Chi Siamo</a></li>";
            echo "<li class='sevento'><a href=\"eventi.php\" role=\"menuitem\">Eventi</a></li>";
            echo "<li class='sveicoli'><a href=\"veicoli.php\" role=\"menuitem\">Veicoli</a></li>";
        } 

        if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==1){
            
            if($this->checkFileName("addVeicolo.php")){
                echo "<li>Aggiungi Veicolo</li>";
            }
            else {
                echo "<li><a href=\"addVeicolo.php\" role=\"menuitem\" >Aggiungi veicolo</a></li>";
            }
            
            if($this->checkFileName("editorVeicoli.php")){
                echo "<li>Modifica Veicolo</li>";
            }
            else {
                echo "<li><a href=\"editorVeicoli.php\" role=\"menuitem\">Modifica Veicolo</a></li>";
            }

            if($this->checkFileName("selectEventoToEdit.php")){
                echo "<li>Modifica Evento</li>";
            }
            else {
                echo "<li><a href=\"selectEventoToEdit.php\" role=\"menuitem\">Modifica Evento</a></li>";
            }


            if($this->checkFileName("addEvento.php")){
                echo "<li>Aggiungi Evento</li>";
            }
            else {
                echo "<li><a href=\"addEvento.php\" role=\"menuitem\">Aggiungi Evento</a></li>";
            }
        }
        if(isset($_SESSION['email']) && $_SESSION['email']!='-1'){
            if($this->checkFileName("listaBiglietti.php")){
                echo "<li>Lista Biglietti</li>";
            }
            else {
                echo "<li><a href=\"listaBiglietti.php\" role=\"menuitem\">Lista Biglietti</a></li>";
            }
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
                if($this->checkFileName("registrazione.php")){
                    echo "<a>ACCEDI/REGISTRATI</a>";
                } else        
                    echo "<a href=\"registrazione.php\" tabindex=\"3\">ACCEDI/REGISTRATI</a>";

            }
            else{
                echo "<a href=\"scheda_utente.php\" tabindex=\"3\">VISITA IL TUO PROFILO</a>";
            }
        }
        else {
            echo "SEI NEL TUO PROFILO";
        }   
    }

    
}
?>