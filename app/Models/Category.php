<?php

namespace App\Models;

use App\Tenant\Observers\TenantObserver;
use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use TenantTrait;
    protected $fillable = ['name','url','description'];

    public function search($filter = null){
        $results = $this
            ->where('name', 'LIKE', "%{$filter}%")
            ->orWhere('description', 'LIKE', "%{$filter}%")
            ->paginate();

        return $results;
    }
}
