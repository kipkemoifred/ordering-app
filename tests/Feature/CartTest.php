<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    public function testAddItemToCart()
    {
        $response = $this->postJson('/api/cart/add', [
            'product_id' => 1,
            'quantity' => 2,
        ]);
        $response->assertStatus(200);
    }
}
