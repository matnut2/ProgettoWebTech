<?php 

    class Veicolo 
    {
        private $targa = null;
        private $modello = null;
        private $cilindrata = null;
        private $anno = null;
        private $posti = null;
        private $cambio = null;
        private $carburante = null;
        private $colori_Esterni = null;
        private $url_Immagine = null;
        private $descrizione = null;
        private $chilometri_Percorsi = null;
        private $disponibile = true;
        private $data_Aggiunta = null;

        public function __construct(){
            try {
                $this->$targa = $targa;

            } catch (Exception $exc) {
                header('Location: '.$_SERVER['PATH_INFO'].'html/404.html');
                exit();
            }
        }

        public function aggiunta(){
        }
    }
?>