<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    class Eventi 
    {
        const CONTENT_KEY = "descrizione";
        const TITLE_KEY = "nome";

        const TABLE_NAME = "EVENTO";

        var $descrizione, $titolo;
    
        public function __set( $name, $value ) {
            switch ($name)
            {
                case self::CONTENT_KEY: 
                    $this->descrizione = $value;
                    break;
                case self::TITLE_KEY: 
                    $this->titolo = $value;
                    break;
                default: 
                    break;
            }
        }

        public static function getEvento()
        {
            $db = database_Manager::getInstance();
            return $db->query("SELECT * FROM Evento ORDER BY data ASC;", Eventi::class);
        }

        public static function replaceEventi($html, $item)
        {
            $html = str_replace("{event-card-title}", $item->titolo, $html);
            $html = str_replace("{event-card-description}", $item->descrizione, $html);
            return $html;
        }

        public static function generateEventiList($array)
        {
            $eventList = [];
            if (!is_array($array)) {
                $array = [];
            }
            for ($x = 0; $x < count($array); $x++) {
                $item = Eventi::replaceEventi(file_get_contents("../html/eventi-card.html"), $array[$x]);
                array_push($eventList, $item);
            }
            return implode($eventList);
        }

        

    }
?>