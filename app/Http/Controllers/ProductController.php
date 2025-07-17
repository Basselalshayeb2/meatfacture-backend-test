<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function getAllProducts()
    {

        return response()->success(ProductResource::collection(ProductService::getProducts()));
    }
}
