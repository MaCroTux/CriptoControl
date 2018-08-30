<?php
/**
 * Created by PhpStorm.
 * User: macro
 * Date: 4/8/18
 * Time: 16:44
 */

namespace CriptoControl\Infrastructure\Persistence\Api;


use CriptoControl\Domain\Exceptions\ExchangeException;
use CriptoControl\Domain\Exchange\ExchangeAmount;
use CriptoControl\Domain\Exchange\ExchangeReadRepository;
use CriptoControl\Domain\Investment\Investment;

class CoinMarketCapExchangeReadRepository implements ExchangeReadRepository
{
    /** @var string */
    private $url;
    /** @var string */
    private $apiKey;

    private $compatibilityTableCurrency = [
        'IOTA' => 'MIOTA'
    ];

    public function __construct(string $url, string $apiKey)
    {
        $this->url    = $url;
        $this->apiKey = $apiKey;
    }

    /**
     * @throws ExchangeException
     */
    public function find(Investment $investment, string $currency): ExchangeAmount
    {
        $criptoCurrency = $this->compatibilityTableCurrency(strtoupper($investment->code()));
        $currencyCode = strtoupper($currency);

        $response = $this->sendQuery($criptoCurrency, $currencyCode);

        if (($response['status']['error_code'] ?? 1) > 0) {
            throw new ExchangeException($response['status']['error_messages']);
        }

        return new ExchangeAmount(
            $investment,
            $currency,
            $response['data'][$criptoCurrency]['quote'][$currencyCode]['price'] ?? 0
        );
    }

    private function sendQuery(string $criptoCurrency, string $currencyCode): array
    {
        $url = $this->url.'cryptocurrency/quotes/latest?symbol='.$criptoCurrency.','.$currencyCode.'&'.$this->apiKey;

        return json_decode(file_get_contents($url), true);
    }

    private function compatibilityTableCurrency(string $criptoCurrency): string
    {
        return $this->compatibilityTableCurrency[$criptoCurrency] ?? $criptoCurrency;
    }
}