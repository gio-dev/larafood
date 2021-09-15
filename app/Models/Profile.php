<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['name','description'];

    public function search($filter = null){
        $results = $this
            ->where('name', 'LIKE', "%{$filter}%")
            ->orWhere('description', 'LIKE', "%{$filter}%")
            ->paginate();

        return $results;
    }
    public function permissions(){
        return $this->belongsToMany(Permission::class, 'permission_profile');
    }

    public function plans(){
        return $this->belongsToMany(Plan::class, 'plan_profile');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissionsAvaliable($filter = null){
        $permissions = Permission::whereNotIn('permissions.id', function ($query){
            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.profile_id = $this->id");
        })
            ->where(function ($queryFilter) use ($filter){
                if(!is_null($filter)){
                    $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
                }
            })
            ->paginate();
        return $permissions;
    }

    public function plansAvaliable($filter = null){
        $plans = Plan::whereNotIn('plans.id', function ($query){
            $query->select('plan_profile.plan_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.profile_id = $this->id");
        })
            ->where(function ($queryFilter) use ($filter){
                if(!is_null($filter)){
                    $queryFilter->where('plans.name', 'LIKE', "%{$filter}%");
                }
            })
            ->paginate();
        return $plans;
    }
}
