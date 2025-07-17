<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user_id,
            'total_price' => $this->total_price,
            'status' => $this->status,
            'orderProducts' => $this->whenLoaded('orderProducts', function () {
                return OrderProductResource::collection($this->orderProducts);
            })
        ];
    }
}
