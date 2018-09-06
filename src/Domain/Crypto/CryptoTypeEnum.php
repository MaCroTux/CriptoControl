<?php

namespace CriptoControl\Domain\Crypto;

class CryptoTypeEnum
{
    private const CRYPTO_BTC = 'BTC';
    private const CRYPTO_ETH = 'ETH';

    static public function btc(): string
    {
        return self::CRYPTO_BTC;
    }

    static public function eth(): string
    {
        return self::CRYPTO_ETH;
    }
}