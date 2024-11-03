<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Services\Decorators\PriceDecorator;
use App\Services\Decorators\ThumbnailDecorator;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Cache;

class SearchService
{
    protected $productRepository;
    protected $providerContext;

    public function __construct(ProductRepositoryInterface $productRepository, ProviderContext $providerContext)
    {
        $this->productRepository = $productRepository;
        $this->providerContext = $providerContext;
    }

    public function searchProducts($startDate, $endDate)
    {
        $cacheKey = "search:{$startDate}-{$endDate}";

        return Cache::remember($cacheKey, 5, function () use ($startDate, $endDate) {
            $travelloProducts = collect($this->productRepository->getAvailableProducts($startDate, $endDate));

            $thirdPartyProducts = collect($this->providerContext->getTours())->map(function ($tour) use ($startDate, $endDate) {
                if (!$this->isAvailableOnStartDate($tour['id'], $startDate)) {
                    return null;
                }

                $product = (new ThumbnailDecorator($this->providerContext))->decorate($tour);
                $product = (new PriceDecorator($this->providerContext))->decorate($product);

                return [
                    'title' => $product['title'],
                    'minimumPrice' => $product['minimumPrice'],
                    'thumbnail' => $product['thumbnail'],
                ];
            })->filter();

            return $travelloProducts->merge($thirdPartyProducts);
        });
    }

    protected function isAvailableOnStartDate($tourId, $startDate)
    {
        $availability = $this->providerContext->getAvailability($tourId, $startDate);
        return $availability && $availability['available'];
    }

    protected function isAvailableInRange($tourId, $startDate, $endDate)
    {
        $period = CarbonPeriod::create($startDate, $endDate);

        foreach ($period as $date) {
            $availability = $this->providerContext->getAvailability($tourId, $date->toDateString());
            if (!$availability || !$availability['available']) {
                return false;
            }
        }

        return true;
    }
}
