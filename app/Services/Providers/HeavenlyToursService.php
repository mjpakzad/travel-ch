<?php

namespace App\Services\Providers;

use Illuminate\Support\Facades\Http;

class HeavenlyToursService implements ProviderInterface
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('suppliers.providers.heavenly_tours.base_url');
    }

    public function getTours()
    {
        return Http::get("{$this->baseUrl}tours")->json();
    }

    public function getTourDetails($id)
    {
        return Http::get("{$this->baseUrl}tours/{$id}")->json();
    }

    public function getTourPrices($date)
    {
        return Http::get("{$this->baseUrl}tour-prices", ['travelDate' => $date])->json();
    }

    public function getAvailability($id, $date)
    {
        return Http::get("{$this->baseUrl}tours/{$id}/availability", ['travelDate' => $date])->json();
    }
}
