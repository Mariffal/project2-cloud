<?php

require 'vendor/autoload.php';
require 'ressources/S3.php';

use Aws\Sqs\SqsClient;
use Aws\S3\S3Client;

$file = $_FILES['filename']['tmp_name'];
$folder= $_POST['event'];
$content_type = mime_content_type($file);

// TODO: Modify it in function of the bucket name and the new queue
$bucket = 'oknowitworks';
$queueUrl = 'https://sqs.us-west-2.amazonaws.com/829489956151/bclassep2';


$s3 = S3Client::factory(array(
    'profile' => 'default',
    'region' => 'us-west-2',
    'version' => 'latest'
));

$client = SqsClient::factory(array(
    'profile' => "default",
    'region' => 'us-west-2',
    'version' => 'latest'
));



$succeed = false;

if($content_type == 'application/zip') {

    $zip = new ZipArchive;
    $res = $zip->open($file);

    if($res == true) {
        $zip->extractTo('./zip_tmp');
        $zip->close();
    }
    else {
        die("ERROR");
    }

    $files = scandir('./zip_tmp');
    foreach ($files as $file) {

        if($file == '.' || $file == '..') {
            continue;
        }

        $filename = './zip_tmp/'.$file;
        $uploadName = md5_file($file);

        $result = $s3->putObject(array(
            'Bucket'     => $bucket,
            'Key'        => $uploadName,
            'SourceFile' => $filename
        ));


        $message= $folder.':'.$uploadName;
        $client->sendMessage(array(
            'QueueUrl' => $queueUrl,
            'MessageBody' => $message
        ));

        unlink($filename);
    }

}
else if(preg_match('#^image/#', $content_type)) {

    $uploadName = md5_file($_FILES['filename']['name']);
    $result = $s3->putObject(array(
        'Bucket'     => $bucket,
        'Key'        => $uploadName,
        'SourceFile' => $file
    ));

    $message= $folder.':'.$uploadName;
    $client->sendMessage(array(
        'QueueUrl' => $queueUrl,
        'MessageBody' => $message
    ));

}
else {
    echo "Wrong content type !";
    die("Wrong content type !");
}
