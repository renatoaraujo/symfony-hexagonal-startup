<?php
declare(strict_types=1);

namespace App\Domain\Service;

use App\Domain\Command\CreateProduct;
use App\Domain\Product;
use App\Domain\Repository\ProductRepository;

final class ProductCreateHandler
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(CreateProduct $command): void
    {
        $product = new Product();
        $this->productRepository->save($product);
    }
}
