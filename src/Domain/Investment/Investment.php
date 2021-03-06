<?php

namespace CriptoControl\Domain\Investment;

class Investment
{
    /** @var string */
    private $code;
    /** @var float */
    private $amount;
    /** @var string */
    private $id;

    private function __construct(InvestmentId $id, string $code, float $amount)
    {
        $this->code = $code;
        $this->amount = $amount;
        $this->id = $id;
    }

    public static function build(string $id, string $code, float $amount): self
    {
        return new self(InvestmentId::fromString($id), $code, $amount);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function amount(): float
    {
        return $this->amount;
    }
}
