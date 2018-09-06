<?php

namespace CriptoControl\Infrastructure\Persistence;

use CriptoControl\Application\Query\AddressInfoRepository;
use CriptoControl\Domain\Crypto\CryptoTypeEnum;

class BTCAddressInfoRepository implements AddressInfoRepository
{
    private $type;

    public function __construct()
    {
        $this->type = CryptoTypeEnum::btc();;
    }

    public function balance($address): int
    {
        return $this->getBalanceFromWallet($address);
    }

    private function getBalanceFromWallet(string $address): int
    {
        $dataWallet = json_decode($this->sendRequestToBlockChainInfo($address), true);

        return $dataWallet['final_balance'] ?? 0;
    }

    private function sendRequestToBlockChainInfo(string $address): string
    {
        $ch = curl_init('https://blockchain.info/rawaddr/'.$address);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $jsonData = curl_exec($ch);
        curl_close($ch);

        return $jsonData;
    }
}