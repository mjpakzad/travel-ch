<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Search\SearchRequest;
use App\Services\SearchService;

class SearchController extends Controller
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function search(SearchRequest $request)
    {
        $products = $this->searchService->searchProducts(
            $request->getStartDate(),
            $request->getEndDate()
        );

        return response()->json($products);
    }
}
