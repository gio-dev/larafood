<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use TenantTrait;
    protected $fillable = ['title', 'flag','price','description','image'];
    protected $table = "products";


    public function categories(){
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function search($filter = null){
        $results = $this
            ->where('title', 'LIKE', "%{$filter}%")
            ->orWhere('description', 'LIKE', "%{$filter}%")
            ->paginate();

        return $results;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categoriesAvaliable($filter = null){

        $permissions = Category::whereNotIn('categories.id', function ($query){
            $query->select('category_product.category_id');
            $query->from('category_product');
            $query->whereRaw("category_product.product_id = {$this->id}");
        })
            ->where(function ($queryFilter) use ($filter){
                if(!is_null($filter)){
                    $queryFilter->where('categories.name', 'LIKE', "%{$filter}%");
                }
            })
            ->paginate();
        return $permissions;
    }
}
