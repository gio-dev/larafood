<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
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
        return $this->belongsToMany(Permission::class, 'permission_role');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'role_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissionsAvaliable($filter = null){
        $permissions = Permission::whereNotIn('permissions.id', function ($query){
            $query->select('permission_role.permission_id');
            $query->from('permission_role');
            $query->whereRaw("permission_role.role_id = $this->id");
        })
            ->where(function ($queryFilter) use ($filter){
                if(!is_null($filter)){
                    $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
                }
            })
            ->paginate();
        return $permissions;
    }

    public function usersAvaliable($filter = null){
        $users = User::whereNotIn('users.id', function ($query){
            $query->select('role_user.user_id');
            $query->from('role_user');
            $query->whereRaw("role_user.role_id = $this->id");
        })
            ->where(function ($queryFilter) use ($filter){
                if(!is_null($filter)){
                    $queryFilter->where('users.name', 'LIKE', "%{$filter}%");
                }
            })
            ->paginate();
        return $users;
    }
}

