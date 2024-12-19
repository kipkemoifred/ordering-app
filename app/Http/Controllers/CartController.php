<?php
// app/Http/Controllers/CartController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redis;


class CartController extends Controller
{
    public function add(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        // Generate a unique cart identifier
        $cartId = uniqid('cart_', true); 

        $cartKey = "cart:$cartId";

        // Add item to Redis cart
        $itemKey = "item:" . $validated['id'];
        Redis::hset($cartKey, $itemKey, $validated['quantity']);

        return response()->json(['message' => 'Item added to cart'], 200);
        
    }

    public function remove(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer',
        ]);

        // Retrieve cart ID from the request or session, in this case just generate it
        $cartId = uniqid('cart_', true); 

        $cartKey = "cart:$cartId";

        // Remove item from Redis cart
        $itemKey = "item:" . $validated['id'];
        Redis::hdel($cartKey, $itemKey);

        return response()->json(['message' => 'Item removed from cart'], 200);
    }
 
}