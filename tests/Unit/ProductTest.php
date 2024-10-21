<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase; // Import the trait
use Tests\TestCase; // Extend Laravel's TestCase
class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_product_creation()
    {
        $product = Product::create([
            'name' => 'Test Product',
            'price' => 100,
            'stock' => 10
        ]);

        $this->assertDatabaseHas('products', ['name' => 'Test Product']);
   }
}
