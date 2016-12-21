<?php

require 'vendor/autoload.php';

use Aws\DynamoDb\DynamoDbClient;

$db = DynamoDbClient::factory(array(
    'profile' => 'default',
    'region'  => 'us-west-2',
    'version' => 'latest'
));

$result = $db->getItem(array(
    'ConsistentRead' => true,
    'TableName' => 'events',
    'Key'       => array(
        'hash' => array('S' => $url)
    )
));

$event_name = $result['Item']['event']['S'];

if($event_name == '') {
    include 'errors/error_event.php';
}
else {
    if(isset($_FILES['filename']) && isset($_POST['event'])){
        include 'controllers/upload_files.php';
    }
    include 'views/manage_event.php';
}