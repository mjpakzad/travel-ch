<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    /**
     * @return string
     */
    public function getModelName(): string
    {
        return Product::class;
    }

    /**
     * @param $startDate
     * @param $endDate
     * @return mixed
     */
    public function getAvailableProducts($startDate, $endDate)
    {
        return Product::whereHas('availabilities', function ($query) use ($startDate, $endDate) {
            $query->where('start_time', '<=', $endDate)
                ->where('end_time', '>=', $startDate);
        })->get()->map(function ($product) {
            return [
                'title' => $product->name,
                'minimumPrice' => $product->availabilities->min('price') . " AED",
                'thumbnail' => $product->thumbnail ?? "https://picsum.photos/300/200",
            ];
        });
    }
}
