<?php 
include_once("database_Manager.php");
class page {

    private static function checkFileName($name){
        return $_SERVER['SCRIPT_NAME'] == "/github/ProgettoWebTech/php/" . $name;
    }

    public function printBreadcrumb(){
        if($this->checkFileName("index.php")){
            echo "<p lang=\"en\">Home</p>";
        }
        if($this->checkFileName("chisiamo.php")){
            echo "<p> <a href=\"index.php\" lang=\"en\">Home</a> &gt &gt Chi Siamo </p>";
        }
    }

    public function printMenu() {
        if ($this->checkFileName("index.php")){
            echo "<li class=\"active\" lang=\"en\">Home</li>";
            echo "<li><a href=\"chisiamo.php\">ChiSiamo</a></li>";
            echo "<li><a href=\"eventi.php\">Eventi</a></li>";
        } 
        if ($this->checkFileName("chisiamo.php")){
            echo "<li><a href=\"index.php\" lang=\"en\">Home</li>";
            echo "<li><a href=\"chisiamo.php\">ChiSiamo</a></li>";
            echo "<li><a href=\"eventi.php\">Eventi</a></li>";
        } 
    }

    public function printEventCardList(){
        $db = database_Manager::getInstance();
        $result = $db->query("SELECT * FROM Evento ORDER BY data ASC;");

        if (!is_array($result)) {
            $result = [];
        }
        $eventList = [];
        for ($x = 0; $x < count($result); $x++) {
            $item = $this->generateEventCard(file_get_contents("../html/eventi-card.html"), $result[$x]);
            array_push($eventList, $item);
        }

    }

    public static function generateEventCard($html, $item){
            echo "<dt class=\"eventTitle\>".$item->titolo."</dt>";
    }

}
?>