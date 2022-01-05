<?php 
include_once("database_Manager.php");
class page {

    private static function checkFileName($name){
        return ($_SERVER['SCRIPT_NAME'] == "/AutoAsta/php/". $name);
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
        else if($this->checkFileName("login.php")){
            echo "<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt Login </p>";
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
    }

    

}
?>