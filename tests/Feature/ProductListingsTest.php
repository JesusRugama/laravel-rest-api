<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductListingsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_shows_ok_response(): void
    {
        $this->getJson(route('product-listing'))
            ->assertOk();
    }

    /**
     * @test
     * @return void
     */
    public function it_list_products()
    {
        Product::factory()
            ->count(5)
            ->create();

        $this->getJson(route('product-listing'))
            ->assertJsonCount(5, 'data');
    }

    /**
     * @test
     * @return void
     */
    public function it_matches_products_schema()
    {
        Product::factory()
            ->hasVersions(3)
            ->count(3)
            ->create();

        $this->getJson(route('product-listing'))
            ->assertSchemaCollection('product.json')
            ->assertOk();
    }

    /**
     * @test
     * @return void
     */
    public function it_includes_the_product_available_versions()
    {
        Product::factory()->create();
        $productWithVersions = Product::factory()->hasVersions(3)->create();

        $response = $this->getJson(route('product-listing'));

        // Assert 3 versions are present for $productWithVersions.
        foreach ($response->json('data') as $product) {
            $this->assertCount(
                $product['id'] === $productWithVersions->id ? 3 : 0,
                $product['versions']
            );
        }
    }
}
