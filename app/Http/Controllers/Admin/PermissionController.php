<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePermission;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    private $repository;

    public function __construct(Permission $permission)
    {
        $this->middleware('can:permissions');
        $this->repository = $permission;
    }

    public function index(){
        $permission = $this->repository->latest()->paginate();
        return view('admin.pages.permission.index', [
            'permissions' => $permission
        ]);
    }
    public function create(){
        return view('admin.pages.permission.create');
    }

    public function store(StoreUpdatePermission $request){

        $this->repository->create($request->all());

        return redirect()->route('permissions.index');
    }
    public function show($idpermission){
        $permission = $this->repository->find($idpermission);

        if(!$permission)
            return redirect()->back();

        return view('admin.pages.permission.show', [
            'permission' => $permission
        ]);
    }
    public function destroy($idpermission){
        $permission = $this->repository->find($idpermission);

        if(!$permission)
            return redirect()->back();

        $permission->delete();

        return redirect()->route('permissions.index');
    }
    public function search(Request $request){

        $filters = $request->except('_token');
        $permission = $this->repository->search($request->filter);

        return view('admin.pages.permission.index', [
            'permissions' => $permission,
            'filters' => $filters
        ]);

    }

    public function edit($idpermission){
        $permission = $this->repository->find($idpermission);

        if(!$permission)
            return redirect()->back();

        return view('admin.pages.permission.edit', [
            'permission' => $permission
        ]);
    }

    public function update(StoreUpdatePermission $request, $idpermission){

        $permission = $this->repository->find($idpermission);

        if(!$permission)
            return redirect()->back();

        $permission->update($request->all());

        return redirect()->route('permissions.index');
    }
}
