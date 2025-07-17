<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService
{

    /**
     * @param $filters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    static public function getOrders($filters): \Illuminate\Database\Eloquent\Collection
    {
        $data = Order::query();
        if (!empty($filters['user_id'])) {
            $data->where('user_id', $filters['user_id']);
        }
        $data->with($filters['with'] ?? []);
        return $data->get();
    }

    /**
     * @param $data
     * @return Order
     */

    static public function createOrder($data): Order
    {
        $productsIds = collect($data['products'])->pluck('product_id')->toArray();
        $products = ProductService::getProducts(['ids' => $productsIds]);
        $productQuantities = collect($data['products'])->pluck('quantity', 'product_id')->toArray();

        $totalPrice = 0;
        foreach ($products as $product) {
            $totalPrice += $product->price * $productQuantities[$product->id];
        }

        DB::beginTransaction();
        $order = new Order();
        $order->total_price = $totalPrice;
        $order->user_id = Auth::id();
        $order->save();

        $orderProductsEntries = [];
        foreach ($products as $product) {
            $orderProductsEntries[] = [
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $productQuantities[$product->id],
                'name' => $product->name,
                'price' => $product->price,
            ];
        }
        OrderProduct::insert($orderProductsEntries);

        $order->loadMissing('orderProducts');
        DB::commit();

        return $order;
    }
}
