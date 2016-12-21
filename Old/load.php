<?php

require 'vendor/autoload.php';
require 'S3.php';

use Aws\Sqs\SqsClient;

$file = $_FILES['filename']['tmp_name'];
$content_type = mime_content_type($file);

// TODO: Modify it in function of the bucket name and the new queue
$bucket = 'oknowitworks';
$queueUrl = 'https://sqs.us-west-2.amazonaws.com/153270437974/queue-cloud';

S3::setAuth('AKIAICXILZ6LMT6WHF3Q', 'vjULjKEMP/mp/psJbvAiSe+N6UkjswIICG5C6koP');

$client = SqsClient::factory(array(
  'profile' => "default",
  'region' => 'us-west-2',
  'version' => 'latest'
));

if($content_type == 'application/zip') {

  echo "Zip";
  $zip = new ZipArchive;
  $res = $zip->open($file);

  if($res == true) {
    $zip->extractTo('./zip_tmp');
    $zip->close();
    echo "woop woop";
  }
  else {
    echo "Loser !";
    die("ERROR");
  }

  $files = scandir('./zip_tmp');
  foreach ($files as $file) {

    if($file == '.' || $file == '..') {
      continue;
    }

    $filename = './zip_tmp/'.$file;
    $uploadName = 'test_zip_'.$file;

    S3::putObject(S3::inputFile($filename, false), $bucket, $uploadName, S3::ACL_PUBLIC_READ_WRITE);

    $message='trololol:'.$uploadName;
    $client->sendMessage(array(
      'QueueUrl' => $queueUrl,
      'MessageBody' => $message
    ));

    unlink($filename);
  }

}
else if(preg_match('#^image/#', $content_type)) {
  echo "Image";

  $uploadName = $_FILES['filename']['name'];
  S3::putObject(S3::inputFile($file, false), $bucket, $uploadName, S3::ACL_PUBLIC_READ_WRITE);

  $message='trololol:'.$uploadName;
  $client->sendMessage(array(
    'QueueUrl' => $queueUrl,
    'MessageBody' => $message
  ));
}
else {
  echo "Wrong content type !";
}
