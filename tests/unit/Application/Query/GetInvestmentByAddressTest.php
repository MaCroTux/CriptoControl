<?php

namespace CriptoControl\Tests\Unit\Application\Query;

use CriptoControl\Application\Query\GetInvestmentByAddressHandler;
use CriptoControl\Domain\Exceptions\AddressNotFound;
use CriptoControl\Infrastructure\Persistence\InMemory\InMemoryBTCAddressInfoRepository;
use PHPStan\Testing\TestCase;

class GetInvestmentByAddressTest extends TestCase
{
    private const BTC_ADDRESS = '1MNPi6xg6icAW1W4XfAtYKBDyZTL372dg4';
    private const BALANCE     = 100000000;

    /**
     * @throws AddressNotFound
     */
    public function testGetAmountWhenGiveAddress(): void
    {
        $bTCAddressInfoRepository = new InMemoryBTCAddressInfoRepository();
        $bTCAddressInfoRepository->save(self::BALANCE);

        $sut = new GetInvestmentByAddressHandler(
            $bTCAddressInfoRepository
        );
        $amount = $sut->handle(self::BTC_ADDRESS);

        $this->assertSame(self::BALANCE, $amount);
    }
}