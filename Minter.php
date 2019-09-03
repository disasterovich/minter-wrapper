<?php

class Minter
{
    protected $tx;

    protected $check;

    protected $api;

    protected $signedTx;

    protected $signedCheck;

    protected $chainId;

    private $walletInfo;

    public function __construct(array $config, $api)
    {
        $this->walletInfo = $config['walletInfo'];
        $this->chainId = $config['chainId'];
        $this->api = $api;
    }

    /**
     * Create transaction
     * @param $txClass
     * @param array $txConfig
     * @param bool $autoSign
     * @return string
     */
    public function createTx($txClass, $txConfig, $autoSign=true)
    {
        $txConfig['nonce'] = $this->api->getNonce($this->walletInfo['address']);
        $txConfig['chainId'] = $this->chainId;

        $this->tx = new $txClass($txConfig);

        if ($autoSign) {
            return $this->signTx();
        }

        return $this->tx;
    }

    /**
     * @param $checkClass
     * @param $checkConfig
     * @param $passPhrase
     * @param bool $autoSign
     * @return string
     */
    public function createCheck($checkClass, $checkConfig, $passPhrase, $autoSign=true)
    {
        $checkConfig['nonce'] = $this->api->getNonce($this->walletInfo['address']);
        $checkConfig['chainId'] = $this->chainId;

        $this->check = new $checkClass($checkConfig, $passPhrase);

        if ($autoSign) {
            return $this->signCheck();
        }

        return $this->check;
    }


    /**
     * Sign transaction
     * @return string
     */
    public function signTx()
    {
        $this->signedTx = $this->tx->sign($this->walletInfo['private_key']);
        return $this->signedTx;
    }

    /**
     * Sign check
     * @return string
     */
    public function signCheck()
    {
        $this->signedCheck = $this->check->sign($this->walletInfo['private_key']);
        return $this->signedCheck;
    }


    /**
     * Send transaction
     */
    public function sendTx()
    {
        if (!$this->signedTx) {
            throw new RuntimeException('signedTx not set');
        }

        return $this->api->send($this->signedTx);
    }

}