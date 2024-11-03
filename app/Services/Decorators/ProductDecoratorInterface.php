<?php

namespace App\Services\Decorators;

interface ProductDecoratorInterface
{
    public function decorate(array $product): array;
}
