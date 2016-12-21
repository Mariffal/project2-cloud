<?php

require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

$bucket = 's3://oknowitworks';
$keyname = 'test1';

// Instantiate the client.
// $s3 = S3Client::factory(array(
//   'version' => 'latest',
//   'region' => 'us-west-2',
//   'credential' => array(
//     'key' => 'AKIAICXILZ6LMT6WHF3Q',
//     'secret' => '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'
//   )
// ));

// $credential = new Credentials('AKIAICXILZ6LMT6WHF3Q', 'vjULjKEMP/mp/psJbvAiSe+N6UkjswIICG5C6koP');
//
// $s3 = S3Client::factory(array(
//   'version' => 'latest',
//   'region' => 'us-west-2',
//   'credential' => $credential
// ));
// $aws = Aws::factory(array(
//   'profile' => 'default',
//   'region' => 'us-west-2'
// ));
//
// $s3 = $aws->get('S3');

$s3 = S3Client::factory(array(
  'profile' => 'thomas',
  'version' => 'latest',
  'region' => 'us-west-2'
));

try {
    // Upload data.

    $content = 'Hello world !';
    $result = $s3->PutObject(array(
        'Bucket' => $bucket,
        'Key'    => utf8_encode($keyname),
        'Content-Type' => 'text/plain',
        //'Content-Length' => strlen($content),
        'Body'   => utf8_encode($content)
    ));

    // Print the URL to the object.
    echo $result['ObjectURL'] . "\n";

} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}
