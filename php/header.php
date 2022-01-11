<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include_once('page.php');
    $header = new page();
?>

<header>
    <h1>AUTO ASTA</h1>
    <form action="cerca" id="searchForm">
        <input type="text" placeholder="Digita qui quello che cerchi" name="search" tabindex="1" autocomplete="off">
        <button id="btnSearchForm" type="submit" form="searchForm" tabindex="2" >CERCA</button>    
    </form>

    <div id="accesso" tabindex="3">
        <?php $header->printLogin(); ?>
    </div>
</header>  

<nav id="breadcrumb" tabindex="4">
    <?php $header->printBreadcrumb();?>
</nav>

<div id="menu" tabindex="5">
    <ul>
        <?php $header->printMenu(); ?>
    </ul>
</div>