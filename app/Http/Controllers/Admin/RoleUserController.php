<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    protected $role, $user;

    public function __construct(Role $role, User $user)
    {
        $this->role = $role;
        $this->user = $user;
        $this->middleware('can:roles');
    }


    public function users($idRole){
        /** @var Role $role */
        $role = $this->role->find($idRole);

        if(!$role)
            return redirect()->back();
        $users = $role->users()->paginate();

        return view('admin.pages.roles.users.users', compact(['role', 'users']));
    }

    public function usersAvaliable(Request $request, $idRole){
        /** @var Role $role */
        $role = $this->role->find($idRole);

        if(!$role)
            return redirect()->back();

        $filters = $request->except('_token');

        $users = $role->usersAvaliable($request->filter);
        return view('admin.pages.roles.users.avaliable', compact(['role', 'users', 'filters']));
    }

    public function attachUsersRole(Request $request, $idRole){
        /** @var Role $role */
        $role = $this->role->find($idRole);

        if(!$role)
            return redirect()->back();

        if(!is_array($request->users) || count($request->users) < 1)
            return redirect()->back()->with('error', 'Escolha pelo menos uma validação');

        $role->users()->attach($request->users);

        return redirect()->route('roles.users.index', $idRole);
    }

    public function detachUsersRole($idRole, $idUser){
        /** @var Role $role */
        $role = $this->role->find($idRole);
        $permission = $this->user->find($idUser);
        if(!$role || !$permission)
            return redirect()->back();

        $role->users()->detach($permission);
        return redirect()->route('roles.users.index', $idRole);

    }

    public function usersProf($idUser){
        /** @var User $user */
        $user = $this->user->find($idUser);

        if(!$user)
            return redirect()->back();
        $roles = $user->roles()->paginate();

        return view('admin.pages.users.roles.roles', compact(['roles', 'user']));
    }
}
