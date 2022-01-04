<?php
    $list = Eventi::generateEventiList(Eventi::getEvento());
    $output = str_replace("{event-list}", $list, $output);
?>