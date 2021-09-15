<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfilePermissionController extends Controller
{
    protected $profile, $permission;

    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;
    }


    public function permissions($idProfile){
        $profile = $this->profile->find($idProfile);

        if(!$profile)
            return redirect()->back();
        $permissions = $profile->permissions()->paginate();

        return view('admin.pages.profiles.permissions.permissions', compact(['profile', 'permissions']));
    }

    public function permissionsAvaliable(Request $request, $idProfile){
        /** @var Profile $profile */
        $profile = $this->profile->find($idProfile);

        if(!$profile)
            return redirect()->back();

        $filters = $request->except('_token');

        $permissions = $profile->permissionsAvaliable($request->filter);
        return view('admin.pages.profiles.permissions.avaliable', compact(['profile', 'permissions', 'filters']));
    }

    public function attachPermissionsProfile(Request $request, $idProfile){
        /** @var Profile $profile */
        $profile = $this->profile->find($idProfile);

        if(!$profile)
            return redirect()->back();

        if(!is_array($request->permissions) || count($request->permissions) < 1)
            return redirect()->back()->with('error', 'Escolha pelo menos uma validação');

        $profile->permissions()->attach($request->permissions);

        return redirect()->route('profiles.permissions.index', $idProfile);
    }

    public function detachPermissionsProfile($idProfile, $idPermission){
        /** @var Profile $profile */
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);
        if(!$profile || !$permission)
            return redirect()->back();

        $profile->permissions()->detach($permission);
        return redirect()->route('profiles.permissions.index', $idProfile);

    }

    public function profiles($idPermission){
        /** @var Permission $permission */
        $permission = $this->permission->find($idPermission);

        if(!$permission)
            return redirect()->back();
        $profiles = $permission->profiles()->paginate();

        return view('admin.pages.permission.profiles.profiles', compact(['profiles', 'permission']));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
