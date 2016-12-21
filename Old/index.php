<?php
//require 'vendor/autoload.php';

/*if(isset($_FILES['filename'])) {
  header('Content-Type: text/plain; charset=utf-8');
  include 'load.php';
}
else if(isset($_POST['event_name'])) {
  include 'create_event.php';
}
else {
  include 'page_event.html';
}*/
$url = ltrim($_SERVER['REQUEST_URI'], '/');

if($url == '') {
  if(isset($_POST['event_name'])) {
    include 'create_event.php';
  }
  else {
    include 'page_event.html';
  }
}
else {
  include 'event_controller.php';
}
