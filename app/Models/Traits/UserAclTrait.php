<?php

namespace App\Models\Traits;

trait UserAclTrait
{
    public function permissions(){
        $tenant = $this->tenant()->first();
        $plan = $tenant->plan()->first();

        $permissions = [];
        foreach ($plan->profiles as $profile){
            foreach ($profile->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }

        return $permissions;
    }

    public function hasPermission(string $permissionName){
        return in_array($permissionName, $this->permissions());
    }

    public function isAdmin(){
        return in_array($this->email, config('acl.admins'));
    }

    public function isNotAdmin(){
        return !in_array($this->email, config('acl.admins'));
    }
}
