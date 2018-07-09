<?php

namespace CriptoControl\Infrastructure\Persistence\Api;

use CriptoControl\Application\Query\InvestmentReadRepository;
use CriptoControl\Domain\Exceptions\InvestmentNotFound;
use CriptoControl\Domain\Investment\Investment;
use CriptoControl\Domain\Investment\InvestmentCollection;
use CriptoControl\Domain\Investment\InvestmentId;
use Hitbtc\Model\BalanceTrading;
use Hitbtc\ProtectedClient;

class HitBTCInvestmentRepository implements InvestmentReadRepository
{
    private $hitBtcProtectedClient;

    public function __construct(ProtectedClient $hitBtcProtectedClient)
    {
        $this->hitBtcProtectedClient = $hitBtcProtectedClient;
    }

    /**
     * @throws \Collections\Exceptions\InvalidArgumentException
     * @throws \CriptoControl\Domain\Exceptions\InvalidUuidException
     * @throws \Hitbtc\Exception\InvalidRequestException
     */
    public function all(): InvestmentCollection
    {
        return $this->createCollectionToBalanceGreaterThanZero(
            ...$this->hitBtcProtectedClient->getBalanceTrading()
        );
    }

    /**
     * @throws InvestmentNotFound
     * @throws \Collections\Exceptions\InvalidArgumentException
     * @throws \CriptoControl\Domain\Exceptions\InvalidUuidException
     * @throws \Hitbtc\Exception\InvalidRequestException
     */
    public function byCurrencyCode(string $currency): Investment
    {
        $investmentCollection = $this->all();
        /** @var Investment $investment */
        foreach ($investmentCollection as $investment) {
            if ($investment->code() === $currency) {
                return $investment;
            }
        }

        throw new InvestmentNotFound($currency);
    }

    /**
     * @throws \Collections\Exceptions\InvalidArgumentException
     * @throws \CriptoControl\Domain\Exceptions\InvalidUuidException
     */
    private function createCollectionToBalanceGreaterThanZero(BalanceTrading ...$balances): InvestmentCollection
    {
        $balanceGreaterThanZero = [];
        /** @var BalanceTrading $balance */
        foreach ($balances as $balance) {
            if ($balance->getAvailable() > 0) {
                $balanceGreaterThanZero[] = Investment::build(
                    InvestmentId::create(),
                    $balance->getCurrency(),
                    $balance->getAvailable() + $balance->getReserved()
                );
            }
        }

        return new InvestmentCollection($balanceGreaterThanZero, Investment::class);
    }
}
