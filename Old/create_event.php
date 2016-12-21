<?php

require 'vendor/autoload.php';

use Aws\DynamoDb\DynamoDbClient;

$db = DynamoDbClient::factory(array(
    'profile' => 'default',
    'region'  => 'us-west-2',
    'version' => 'latest'
));

$str = $_POST['event_name'] . date('Y.m;d/H...i^s');
$hash = hash('md5', $str, false);

$result = $db->putItem(array(
  'TableName' => 'events',
  'Item' => array(
    'hash' => array('S' => $hash),
    'event' => array('S' => $_POST['event_name'])
  )
));

echo 'Voici le lien de l\'évènement :<br/>';
echo '<a href=./' . $hash . '>Cliquez ici</a>';
