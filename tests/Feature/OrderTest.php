<?php

namespace Tests\Feature\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_place_order()
    {
        // Assuming the 'items' data is already validated in the controller
        $response = $this->postJson('/api/order/place', [
            'items' => [
                ['id' => 1, 'quantity' => 2],
                ['id' => 2, 'quantity' => 1]
            ],
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Order placed successfully',
                 ]);

        // Verify the order was saved in the database
        $this->assertDatabaseHas('orders', [
            'total_price' => 'calculated_price_here',
        ]);
    }

    public function test_add_item_to_cart_validation_error()
{
    $response = $this->postJson('/api/cart/add', [
        'id' => 'invalid', // Invalid id type
        'quantity' => 2,
    ]);

    $response->assertStatus(422)
             ->assertJsonValidationErrors(['id']);
}



}
