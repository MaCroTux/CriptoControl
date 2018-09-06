<?php

namespace CriptoControl\Infrastructure\Persistence\InMemory;

use CriptoControl\Application\Query\AddressInfoRepository;
use CriptoControl\Domain\Crypto\CryptoTypeEnum;

class InMemoryBTCAddressInfoRepository implements AddressInfoRepository
{
    /** @var string */
    protected $type;
    /** @var int */
    private $balance;

    public function __construct()
    {
        $this->type = CryptoTypeEnum::btc();
    }

    public function balance($address): int
    {
        return $this->balance;
    }

    public function save(int $balance): void
    {
        $this->balance = $balance;
    }
}