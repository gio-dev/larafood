<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use TenantTrait;
    protected $fillable = ['identify','tenant_id','client_id','table_id', 'total', 'comment', 'status'];

    public function tenant(){
        return $this->belongsTo(Tenant::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function table(){
        return $this->belongsTo(Table::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class, 'order_product');
    }
    public function evaluations(){
        return $this->hasMany(Evaluation::class);
    }
}
