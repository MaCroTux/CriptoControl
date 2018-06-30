<?php

namespace CriptoControl\Domain\Investment;

class Investment
{
    /** @var string */
    private $code;
    /** @var float */
    private $amount;

    public function __construct(string $code, float $amount)
    {
        $this->code = $code;
        $this->amount = $amount;
    }

    public static function build(string $code, float $amount): self
    {
        return new self($code, $amount);
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
