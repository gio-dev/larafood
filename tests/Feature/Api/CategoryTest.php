<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * Error Get All Category by Tenant.
     *
     * @return void
     */
    public function test_all_error_get_category_by_tenant()
    {
        $response = $this->getJson('/api/v1/categories');

        $response->assertStatus(422);
    }

    /**
     * Get All Category by Tenant.
     *
     * @return void
     */
    public function test_get_all_category_by_tenant()
    {
        $tenant = Tenant::factory()->create();
        $categories = Category::factory()->count(5)->create();
        $response = $this->getJson("/api/v1/categories?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }

    /**
     * Error Get Category by Tenant.
     *
     * @return void
     */
    public function test_error_get_category_by_tenant()
    {
        $tenant = Tenant::factory()->create();
        $category = 'fake';
        $response = $this->getJson("/api/v1/categories/{$category}?token_company={$tenant->uuid}");

        $response->assertStatus(404);
    }

    /**
     * Get Category by Tenant.
     *
     * @return void
     */
    public function test_get_category_by_tenant()
    {
        $tenant = Tenant::factory()->create();
        $category = Category::factory()->create();

        $response = $this->getJson("/api/v1/categories/{$category->uuid}?token_company={$tenant->uuid}");
        $response->dump();

        $response->assertStatus(200);
    }
}
