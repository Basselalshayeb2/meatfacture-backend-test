<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function getAllProducts() {

        return response()->json(ProductService::getProducts());
    }
}
