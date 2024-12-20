<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    // public function testAddItemToCart()
    // {
    //     $response = $this->postJson('/api/cart/add', [
    //         'product_id' => 1,
    //         'quantity' => 2,
    //     ]);
    //     $response->assertStatus(200);
    // }


    // use RefreshDatabase;

    /**
     * Test adding an item to the cart
     *
     * @return void
     */
    public function test_add_item_to_cart()
    {
        // Mock the Redis interaction to avoid actual Redis calls during tests
        Redis::shouldReceive('hset')
            ->once()
            ->with('cart:cart_123456', 'item:1', 2)
            ->andReturn(true);

        $response = $this->postJson('/api/cart/add', [
            'id' => 7,
            'quantity' => 8,
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Item added to cart',
                 ]);
    }
}
