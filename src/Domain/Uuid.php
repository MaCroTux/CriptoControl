<?php

namespace CriptoControl\Domain;

use CriptoControl\Domain\Exceptions\InvalidUuidException;
use Ramsey\Uuid\Uuid as UuidRamsey;

abstract class Uuid
{
    /** @var string */
    protected $value;

    /**
     * @throws InvalidUuidException
     */
    protected function __construct(string $value)
    {
        if (!UuidRamsey::isValid($value)) {
            throw new InvalidUuidException('Uuid ' . $value . ' is not valid');
        }

        $this->value = $value;
    }

    /**
     * @throws InvalidUuidException
     */
    public static function create(): self
    {
        return new static(UuidRamsey::uuid4()->toString());
    }

    /**
     * @throws InvalidUuidException
     */
    public static function fromString(string $uuid): self
    {
        return new static($uuid);
    }

    public function equals(Uuid $other): bool
    {
        return (string) $other === (string) $this;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
