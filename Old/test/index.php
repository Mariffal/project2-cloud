<?php

require 'vendor/autoload.php';

if(isset($_FILES['filename'])) {
  header('Content-Type: text/plain; charset=utf-8');
  include 'load.php';
}
else {
  include 'page.html';
}
