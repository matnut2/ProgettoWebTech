<?php
    include_once("database_Manager.php");
    include_once("session_Manager.php");

    $dbManager = database_Manager::getInstance();
    $output = file_get_contents("../html/layout.html");

    switch ($_GET['page']) {
        case 'eventi':
            $breadcrumb = "<a href=\"" . SessionManager::BASE_URL . 'home' . "\">HOME</a> &gt;&gt; Eventi";
            $page = file_get_contents("../html/eventi.html");
            $output = str_replace("{breadcrumb}",$breadcrumb,$output);
            $output = str_replace("{content}", $page, $output);
            $output = str_replace("{currentPage}", "Prossimi - Eventi", $output);
            break;

        default:
            $breadcrumb = "<a href=\"" . SessionManager::BASE_URL . 'home' . "\">HOME</a> &gt;&gt; ERRORE 404";
            $page = file_get_contents("../html/404.html");
            $output = str_replace("{breadcrumb}",$breadcrumb,$output);
            $output = str_replace("{content}", $page, $output);
            $output = str_replace("{currentPage}", "ERROR 404", $output);
            break;
    }

    echo $output;
