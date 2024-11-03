<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function getAvailableProducts($startDate, $endDate);
}
