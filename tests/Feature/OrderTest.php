<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_order_placement()
    {
        // Create a user and authenticate them
        $user = User::factory()->create();

        // Create a product with stock using the factory
        $product = Product::factory()->create([
            'stock' => 10
        ]);

        // Simulate the user placing an order for the product
        $response = $this->actingAs($user, 'sanctum')->post('/api/orders', [
            'products' => [
                ['id' => $product->id, 'quantity' => 2]
            ]
        ]);

        // Assert that the order was created successfully (status 201)
        $response->assertStatus(201);

        // Check if the order and order_product pivot table were updated correctly
        $this->assertDatabaseHas('order_product', [
            'product_id' => $product->id,
            'quantity' => 2
        ]);
    }
}
