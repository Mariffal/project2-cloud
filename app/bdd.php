<?php

require 'vendor/autoload.php';

use Aws\DynamoDb\DynamoDbClient;

class Bdd {

    private static $db;

    public static function initialize() {
        self::$db = DynamoDbClient::factory(array(
            'profile' => 'default',
            'region'  => 'us-west-2',
            'version' => 'latest'
        ));
    }

    public static function getEvent($hash) {
        return self::$db->getItem(array(
            'ConsistentRead' => true,
            'TableName' => 'events',
            'Key'       => array(
                'hash' => array('S' => $hash)
            )
        ));
    }

    public function putEvent($name) {

        $str = $name . date('Y.m;d/H...i^s');
        $hash = hash('md5', $str, false);

        self::$db->putItem(array(
            'TableName' => 'events',
            'Item' => array(
                'hash' => array('S' => $hash),
                'event' => array('S' => $name)
            )
        ));
    }
}