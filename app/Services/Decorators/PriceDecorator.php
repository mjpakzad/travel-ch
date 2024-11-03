<?php

namespace App\Services\Decorators;

use App\Services\Providers\ProviderInterface;

class PriceDecorator implements ProductDecoratorInterface
{
    protected $provider;

    public function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function decorate(array $product): array
    {
        $prices = $this->provider->getTourPrices(now()->toDateString());
        $priceData = collect($prices)->firstWhere('tourId', $product['id']);
        $product['minimumPrice'] = $priceData ? $priceData['price'] . ' AED' : 'N/A';
        return $product;
    }
}
