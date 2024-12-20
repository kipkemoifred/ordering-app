<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
// use Redis;
use Illuminate\Support\Facades\Redis;


class OrderController extends Controller
{
    public function place(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|integer',
            'items.*.quantity' => 'required|integer|min:1'
        ]);

        // Generate a unique cart identifier
        $cartId = uniqid('cart_', true); 

        // Save the order to the database
        $order = Order::create([
            'cart_id' => $cartId,
            'items' => json_encode($validated['items']),
            'order_name' => 'Order_' . uniqid(),
            'total_price' => $this->calculateTotalPrice($validated['items']),
        ]);

        echo "order " ;

           // Clear the cart in Redis
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
        // Calculate the total price of the order
        $total = 0;
        foreach ($items as $item) {
            // Assuming each item has a fixed price (you might fetch this from a database)
            $price = 10; // Replace with actual price lookup
            $total += $item['quantity'] * $price;
        }
        return $total;
    }

}