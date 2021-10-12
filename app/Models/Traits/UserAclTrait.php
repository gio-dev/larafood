<?php

namespace App\Models\Traits;

use App\Models\Tenant;

trait UserAclTrait
{
    public function permissions(){

        $permissionsPlan = $this->permissionsPlan();
        $permissionsRole = $this->permissionsRole();
        $permissions = [];
        foreach ($permissionsPlan as $permissionPlan){
            if(in_array($permissionPlan, $permissionsRole)){
                array_push($permissions, $permissionPlan);
            }
        }

        return $permissions;
    }

    public function permissionsPlan(): array{
//        $tenant = $this->tenant()->first();
//        $plan = $tenant->plan()->first();

        $tenant = Tenant::with('plan.profiles.permissions')->where('id', $this->tenant_id)->first();
        $plan = $tenant->plan;


        $permissions = [];
        foreach ($plan->profiles as $profile){
            foreach ($profile->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }

        return $permissions;
    }
    public function permissionsRole(): array{

        $roles = $this->roles()->with('permissions')->get();

        $permissions = [];
        foreach ($roles as $role){
            foreach ($role->permissions as $permission) {
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
