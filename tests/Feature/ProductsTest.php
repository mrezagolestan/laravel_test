<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_table_empty(): void
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertSee(__('No Products found'));
    }
    public function test_product_table_not_empty(): void
    {
        $product = Product::create([
            'name' => 'Product 1',
            'price' => 123,
        ]);

        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertDontSee(__('No Products found'));
        $response->assertViewHas('products', function ($collection) use ($product){
            return $collection->contains($product);
        });
    }
}
