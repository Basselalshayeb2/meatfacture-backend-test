<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductService
{
    /**
     * @return Collection
     */
    static public function getProducts($filters = []): Collection
    {
        $data = Product::query();
        if (!empty($filters['ids'])) {
            $data->whereIn('id', $filters['ids']);
        }
        return $data->get();
    }
}
