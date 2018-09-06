<?php

namespace CriptoControl\Application\Query;

interface AddressInfoRepository
{
    public function balance($address): int;
}