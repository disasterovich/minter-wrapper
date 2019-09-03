<?php
require_once('./vendor/autoload.php');
require_once('./config.php');
require_once('./Minter.php');

use Minter\SDK\MinterTx;
use Minter\SDK\MinterCoins\MinterSendCoinTx;
use Minter\SDK\MinterCoins\MinterMultiSendTx;
use Minter\SDK\MinterCheck;
use Minter\MinterAPI;

//Edit config
$config = require(__DIR__ . '/config.php');

$api = new MinterAPI($config['nodeUrl']);
$minter = new Minter($config, $api);

//Example send coin
$minter->createTx(MinterTx::class, [
    'gasPrice'      => 1,
    'gasCoin'       => 'MNT',
    'type'          => MinterSendCoinTx::TYPE,
    'data'          => [
        'coin'  => 'MNT',
        'to'    => 'Mxab7c94687456659a1fd5a9111db2fe8e799676c7',
        'value' => '1'
    ],
    'payload'       => '',
    'serviceData'   => '',
    'signatureType' => MinterTx::SIGNATURE_SINGLE_TYPE // or SIGNATURE_MULTI_TYPE
]);

$res = $minter->sendTx();
var_dump($res);


/*
//Example multi send coin
$minter->createTx(MinterTx::class, [
    'gasPrice' => 1,
    'gasCoin' => 'MNT',
    'type' => MinterMultiSendTx::TYPE,
    'data' => [
        'list' => [
            [
                'coin' => 'MNT',
                'to' => 'Mxab7c94687456659a1fd5a9111db2fe8e799676c7',
                'value' => '10'
            ], [
                'coin' => 'MNT',
                'to' => 'Mxab7c94687456659a1fd5a9111db2fe8e799676c7',
                'value' => '15'
            ]
        ]
    ],
    'payload' => '',
    'serviceData' => '',
    'signatureType' => MinterTx::SIGNATURE_SINGLE_TYPE // or SIGNATURE_MULTI_TYPE
]);

$res = $minter->sendTx();
var_dump($res);
*/

/*
//Example createcheck
$check = $minter->createCheck(MinterCheck::class, [
    'dueBlock' => 999999,
    'coin' => 'MNT',
    'value' => '1'
], 'your pass phrase');

var_dump($check);
*/

