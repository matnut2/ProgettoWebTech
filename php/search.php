<?php
if(!empty($_GET)){
    $input = $_GET['search'];
    strtolower($input);

    if(checkVeicoli($input)){
        header('Location: veicoli.php');
        exit;
    }
    elseif(checkEventi($input)){
        header('Location: eventi.php');
        exit;
    }
    else {
        header('Location: err-404.php');
        exit;
    }
}

function checkVeicoli($input){
    $words  = array('auto','veicoli','veicolo','moto',
                    'motocicletta','motociclette','automobile','vettura','autovettura','mezzo','quad','motorino');

    // no shortest distance found, yet
    $shortest = -1;

    // loop through words to find the closest
    foreach ($words as $word) {

        // calculate the distance between the input word,
        // and the current word
        $lev = levenshtein($input, $word);

        // check for an exact match
        if ($lev == 1) {

            // closest word is this one (exact match)
            $closest = $word;
            $shortest = 0;

            // break out of the loop; we've found an exact match
            break;
        }

        // if this distance is less than the next found shortest
        // distance, OR if a next shortest word has not yet been found
        if ($lev <= $shortest || $shortest < 0) {
            // set the closest match, and shortest distance
            $closest  = $word;
            $shortest = $lev;
        }
    }

    if ($shortest == 0) {
        return true;
    } else return false;
}


function checkEventi($input){
    $words  = array('eventi','evento','asta','manifestazione',
                    'aste','prossimi');

    // no shortest distance found, yet
    $shortest = -1;

    // loop through words to find the closest
    foreach ($words as $word) {

        // calculate the distance between the input word,
        // and the current word
        $lev = levenshtein($input, $word);

        // check for an exact match
        if ($lev == 1) {

            // closest word is this one (exact match)
            $closest = $word;
            $shortest = 0;

            // break out of the loop; we've found an exact match
            break;
        }

        // if this distance is less than the next found shortest
        // distance, OR if a next shortest word has not yet been found
        if ($lev <= $shortest || $shortest < 0) {
            // set the closest match, and shortest distance
            $closest  = $word;
            $shortest = $lev;
        }
    }

    if ($shortest == 0) {
        return true;
    } else return false;
}
?>