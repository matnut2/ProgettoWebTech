<?php 
    class Veicolo 
    {
        const MODEL_KEY = "marca";
        const TABLE_NAME = "VEICOLO";

        var $marca;
        public function __set( $name, $value ) {
            switch ($name)
            {
                case self::MODEL_KEY: 
                    $this->marca = $value;
                    break;

                default: 
                    break;
            }
        }
        
    }
?>