<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductService
{
    static public function getProducts(): Collection
    {
        return Product::all();
    }
}
