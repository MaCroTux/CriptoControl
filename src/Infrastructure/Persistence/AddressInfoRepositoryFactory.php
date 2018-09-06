<?php

namespace CriptoControl\Infrastructure\Persistence;

use CriptoControl\Application\Query\AddressInfoRepository;
use CriptoControl\Domain\Crypto\CryptoTypeEnum;
use CriptoControl\Domain\Exceptions\AddressNotFound;

class AddressInfoRepositoryFactory
{
    /**
     * @throws AddressNotFound
     */
    static public function build(string $type): AddressInfoRepository
    {
        switch ($type) {
            case CryptoTypeEnum::btc():
                return new BTCAddressInfoRepository();
            default:
                throw new AddressNotFound($type);
        }
    }
}