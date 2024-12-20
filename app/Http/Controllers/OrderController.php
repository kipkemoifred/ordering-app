<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

use Illuminate\Support\Facades\Redis;


class OrderController extends Controller
{
    public function place(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|integer',
            'items.*.price' => 'required|integer',
            'items.*.quantity' => 'required|integer|min:1'
        ]);

      
        $cartId = uniqid('cart_', true); 

    
        $order = Order::create([
            'cart_id' => $cartId,
            'items' => json_encode($validated['items']),
            'order_name' => 'Order_' . uniqid(),
            'total_price' => $this->calculateTotalPrice($validated['items']),
        ]);
        Redis::del("cart:$cartId");

        return response()->json(['message' => 'Order placed successfully', 'order' => $order], 201);

      
    
    }

    public function index(Request $request)
    {
        $orders = Order::all();

        return response()->json(['orders' => $orders], 200);

    }

    private function calculateTotalPrice(array $items)
    {

        $total = 0;
        foreach ($items as $item) {
            $price = $item['price']; 
            $total += $item['quantity'] * $price;
        }
        return $total;
    }

}