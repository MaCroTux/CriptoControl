<?php

namespace CriptoControl\Application\Query;

class GetInvestmentByAddressHandler
{
    /** @var AddressInfoRepository */
    private $addressInfoRepository;

    public function __construct(AddressInfoRepository $addressInfoRepository)
    {
        $this->addressInfoRepository = $addressInfoRepository;
    }

    public function handle(string $address): int
    {
        return $this->addressInfoRepository->balance($address);
    }
}