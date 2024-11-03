<?php

namespace App\Services;

use App\Services\Providers\ProviderInterface;

class ProviderContext implements \App\Services\Providers\ProviderInterface
{
    protected $provider;

    public function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function getTours()
    {
        return $this->provider->getTours();
    }

    public function getTourDetails($id)
    {
        return $this->provider->getTourDetails($id);
    }

    public function getTourPrices($date)
    {
        return $this->provider->getTourPrices($date);
    }

    public function getAvailability($id, $date)
    {
        return $this->provider->getAvailability($id, $date);
    }
}
