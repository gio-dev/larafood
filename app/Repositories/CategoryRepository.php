<?php

namespace App\Repositories;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $table;

    public function __construct()
    {
        $this->table = 'categories';
    }

    public function getCategoriesByTenantUuid(string $uuid, int $perPage)
    {
        return DB::table($this->table)
                        ->join('tenants', 'tenants.id', '=', 'categories.tenant_id')
                        ->where('tenants.uuid', $uuid)
                        ->select('categories.*')
                        ->paginate($perPage);
    }
    public function getCategoriesByTenantId(int $idTenant, int $perPage)
    {
        return DB::table($this->table)
            ->where('tenant_id', $idTenant)
            ->paginate($perPage);
    }
    public function getCategoryByUuid(int $idTenant,string $uuid){
        return DB::table($this->table)
            ->where('uuid', $uuid)
            ->where('tenant_id', $idTenant)
            ->first();
    }
}
