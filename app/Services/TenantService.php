<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\Tenant;
use App\Repositories\Contracts\TenantRepositoryInterface;
use Illuminate\Support\Str;

class TenantService
{
    private $plan, $data;
    private $repository;
//    public function __construct(Plan $plan, array $data)
//    {
//        $this->plan = $plan;
//        $this->data = $data;
//    }

    public function __construct(TenantRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    public function getAllTenants(int $perPage)
    {
        return $this->repository->getAllTenants($perPage);
    }
    public function getTenantByUuid(string $uuid){
        return $this->repository->getTenantByUuid($uuid);
    }

    public function make(Plan $plan, array $data){

        $this->plan = $plan;
        $this->data = $data;

        $tenant = $this->storeTenant();
        $user = $this->storeUser($tenant);
        return $user;
    }

    /**
     *
     *
     * @return \App\Models\Tenant
     */
    public function storeTenant(){
        $data = $this->data;
        return $this->plan->tenants()->create([
            'name' => $data['empresa'],
            'cnpj' => $data['cnpj'],
            'email' => $data['email'],
            'url' => Str::kebab($data['empresa']),
            'subscription' => now(),
            'expires_at' => now()->addDays(7)
        ]);
    }

    public function storeUser(Tenant $tenant){
        $data = $this->data;
        return $tenant->users()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
    }
}
