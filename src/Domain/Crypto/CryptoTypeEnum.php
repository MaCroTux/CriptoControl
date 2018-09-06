<?php

namespace CriptoControl\Domain\Crypto;

class CryptoTypeEnum
{
    private const CRYPTO_BTC = 'BTC';

    static public function btc(): string
    {
        return self::CRYPTO_BTC;
    }
}