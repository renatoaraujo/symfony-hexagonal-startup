<?php
declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Product;
use App\Domain\ProductId;
use App\Domain\ProductList;

interface ProductRepository
{
    public function save(Product $product): bool;

    public function load(ProductId $productId): ProductList ;
}
