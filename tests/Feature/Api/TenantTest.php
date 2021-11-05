<?php

namespace Tests\Feature\Api;

use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TenantTest extends TestCase
{
//    /**
//     * A basic feature test example.
//     *
//     * @return void
//     */
//    public function test_example()
//    {
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
//    }

    /**
     * Test Get All Tenants.
     *
     * @return void
     */
    public function test_get_all_tenants()
    {
        $tenants = Tenant::factory()->count(10)->create();

        $response = $this->getJson('/api/v1/tenants');

        $response->assertStatus(200)
                        ->assertJsonCount(10, 'data');
    }

    /**
     * Test Error Single Tenant.
     *
     * @return void
     */
    public function test_error_get_tenant()
    {
        $tenant = 'fake';

        $response = $this->getJson("/api/v1/tenants/{$tenant}");

        $response->assertStatus(404);
    }

    /**
     * Test Get Tenant.
     *
     * @return void
     */
    public function test_get_tenant_by_identify()
    {
        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/tenants/{$tenant->uuid}");

        $response->assertStatus(200);
    }

}
