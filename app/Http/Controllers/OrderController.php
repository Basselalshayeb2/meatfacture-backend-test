<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function getMyOrders()
    {
        return response()->success(OrderResource::collection(OrderService::getOrders(['user_id' => Auth::id(), 'with' => ['orderProducts']])));
    }

    public function createOrder(Request $request)
    {
        $data = $request->validate([
            'products' => 'required|array|min:1',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.product_id' => 'required|exists:products,id',
        ]);

        return response()->success(new OrderResource(OrderService::createOrder($data)));
    }
}
