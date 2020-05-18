<?php
declare(strict_types=1);

namespace App\Domain;

final class Product
{
    private ProductId $productId;

    private Name $name;

    private Price $price;

    private ImageLink $imageLink;

    private Description $description;
}
