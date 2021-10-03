<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();
        $plan->tenants()->create([
            'name' => 'GD Soluções Inteligentes',
            'cnpj' => '28570773000122',
            'email' => 'giovan.bnu@gmail.com',
            'url' => 'gds'
        ]);
    }
}
