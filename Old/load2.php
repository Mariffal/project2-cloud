<?php

$file = $_FILES['filename']['tmp_name'];

$zip = new ZipArchive;

$res = $zip->open($file);

if($res == true) {
  $zip->extractTo('./zip_tmp');
  $zip->close();
  echo "woop woop";
}
else {
  echo "Loser !";
}
