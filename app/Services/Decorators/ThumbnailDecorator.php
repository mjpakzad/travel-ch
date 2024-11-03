<?php

namespace App\Services\Decorators;

use App\Services\Providers\ProviderInterface;

class ThumbnailDecorator implements ProductDecoratorInterface
{
    protected $provider;

    public function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function decorate(array $product): array
    {
        $tourDetails = $this->provider->getTourDetails($product['id']);

        $thumbnail = collect($tourDetails['photos'])->firstWhere('type', 'thumbnail')['url'] ?? "https://picsum.photos/300/200";

        $product['thumbnail'] = $thumbnail;

        return $product;
    }
}
