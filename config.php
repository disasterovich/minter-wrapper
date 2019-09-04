<?php

use Minter\SDK\MinterTx;

$config = [

    'nodeUrl' => 'https://minter-node-1.testnet.minter.network:8841', // example of a node url

    'chainId' => MinterTx::TESTNET_CHAIN_ID, // or MinterTx::MAINNET_CHAIN_ID

    'walletInfo' => [
        'seed'          => 'SEED_HERE',
        'address'       => 'MX_ADDRESS_HERE',
        'mnemonic'      => 'MNEMONIC_HERE',
        'public_key'    => 'PUBLIC_KEY_HERE',
        'private_key'   => 'PRIVATE_KEY_HERE',
    ]

];

if (file_exists('config-local.php')) {
    $config = array_merge($config, require(__DIR__ . '/config-local.php'));
}

return $config;