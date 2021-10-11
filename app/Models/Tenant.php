<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'cnpj', 'email', 'url', 'active','logo','active',
        'subscription', 'expires_at', 'subscription_id','subscription_active', 'subscription_suspended'];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function plan(){
        return $this->belongsTo(Plan::class);
    }

    public function search($filter = null){
        $results = $this
            ->where('name', 'name', "%{$filter}%")
            ->orWhere('cnpj', 'LIKE', "%{$filter}%")
            ->orWhere('email', 'LIKE', "%{$filter}%")
            ->orWhere('subscription', 'LIKE', "%{$filter}%")
            ->paginate();

        return $results;
    }

}
