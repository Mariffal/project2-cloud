<?php

if(isset($_POST['event_name'])) {
    include_once 'controllers/create_event.php';
}
else {
    $url = ltrim($_SERVER['REQUEST_URI'], '/');
    if($url == '') {
        include 'controllers/accueil.php';
    }
    else {
        include 'controllers/manage_event.php';
    }
}