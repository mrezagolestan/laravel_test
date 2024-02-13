<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createUser();
    }

    public function test_product_table_empty(): void
    {
        $response = $this->actingAs($this->user)->get('/products');

        $response->assertStatus(200);
        $response->assertSee(__('No Products found'));
    }
    public function test_product_table_not_empty(): void
    {
        $product = Product::create([
            'name' => 'Product 1',
            'price' => 123,
        ]);

        $response = $this->actingAs($this->user)->get('/products');

        $response->assertStatus(200);
        $response->assertDontSee(__('No Products found'));
        $response->assertViewHas('products', function ($collection) use ($product){
            return $collection->contains($product);
        });
    }

    public function test_product_table_doesnt_contain_11th_record(): void
    {
        $lastProduct = Product::factory(11)->create()->last();

        $response = $this->actingAs($this->user)->get('/products');

        $response->assertStatus(200);
        $response->assertViewHas('products', function ($collection) use ($lastProduct){
            return !$collection->contains($lastProduct);
        });
    }

    public function createUser(): User
    {
        return User::factory()->create();
    }
}
