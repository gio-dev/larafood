<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionRoleController extends Controller
{
    protected $role, $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->middleware('can:roles');
        $this->role = $role;
        $this->permission = $permission;
    }


    public function permissions($idRole){
        $role = $this->role->find($idRole);

        if(!$role)
            return redirect()->back();
        $permissions = $role->permissions()->paginate();

        return view('admin.pages.roles.permissions.permissions', compact(['role', 'permissions']));
    }

    public function permissionsAvaliable(Request $request, $idRole){
        /** @var Roles $role */
        $role = $this->role->find($idRole);

        if(!$role)
            return redirect()->back();

        $filters = $request->except('_token');

        $permissions = $role->permissionsAvaliable($request->filter);
        return view('admin.pages.roles.permissions.avaliable', compact(['role', 'permissions', 'filters']));
    }

    public function attachPermissionsRole(Request $request, $idRole){
        /** @var Roles $role */
        $role = $this->role->find($idRole);

        if(!$role)
            return redirect()->back();

        if(!is_array($request->permissions) || count($request->permissions) < 1)
            return redirect()->back()->with('error', 'Escolha pelo menos uma validação');

        $role->permissions()->attach($request->permissions);

        return redirect()->route('roles.permissions.index', $idRole);
    }

    public function detachPermissionsRole($idRole, $idPermission){
        /** @var Roles $role */
        $role = $this->role->find($idRole);
        $permission = $this->permission->find($idPermission);
        if(!$role || !$permission)
            return redirect()->back();

        $role->permissions()->detach($permission);
        return redirect()->route('roles.permissions.index', $idRole);

    }

//    public function roles($idPermission){
//        /** @var Permission $permission */
//        $permission = $this->permission->find($idPermission);
//
//        if(!$permission)
//            return redirect()->back();
//        $roles = $permission->roles()->paginate();
//
//        return view('admin.pages.permission.roles.roles', compact(['roles', 'permission']));
//    }
}
