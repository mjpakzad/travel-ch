<?php

namespace App\Services\Providers;

interface ProviderInterface
{
    public function getTours();
    public function getTourDetails($id);
    public function getTourPrices($date);
    public function getAvailability($id, $date);
}
