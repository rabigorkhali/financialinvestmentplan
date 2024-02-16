<?php

namespace App\Repositories\System;

use App\Interfaces\OpenInterface;
use App\Interfaces\System\CountryInterface;
use App\Model\Country;
use App\Repositories\Repository;

class CountryRepository extends Repository implements CountryInterface
{
  public function __construct(private readonly Country $country)
  {
    parent::__construct($country);
  }
}
