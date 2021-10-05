<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $repository;

    public function __construct(User $user)
    {
        $this->repository = $user;
    }

    public function index(){
        $users = $this->repository->latest()->tenantUser()->paginate();

        return view('admin.pages.users.index', [
            'users' => $users
        ]);
    }
    public function create(){
        return view('admin.pages.users.create');
    }

    public function store(StoreUpdateUser $request){

        $data = $request->all();
        $data['tenant_id'] = auth()->user()->tenant_id;

        $this->repository->create($data);

        return redirect()->route('users.index');
    }
    public function show($iduser){
        $user = $this->repository->tenantUser()->find($iduser);

        if(!$user)
            return redirect()->back();

        return view('admin.pages.users.show', [
            'user' => $user
        ]);
    }
    public function destroy($iduser){
        $user = $this->repository->tenantUser()->find($iduser);

        if(!$user)
            return redirect()->back();

        $user->delete();

        return redirect()->route('users.index');
    }
    public function search(Request $request){

        $filters = $request->except('_token');
        $users = $this->repository->search($request->filter);

        return view('admin.pages.users.index', [
            'users' => $users,
            'filters' => $filters
        ]);

    }

    public function edit($iduser){
        $user = $this->repository->tenantUser()->find($iduser);

        if(!$user)
            return redirect()->back();

        return view('admin.pages.users.edit', [
            'user' => $user
        ]);
    }

    public function update(StoreUpdateUser $request, $iduser){

        $user = $this->repository->tenantUser()->find($iduser);

        if(!$user)
            return redirect()->back();
        $data = $request->only(['name','email']);

        if($request->password)
            $data['password'] = bcrypt($request->password);

        $user->update($data);

        return redirect()->route('users.index');
    }
}
