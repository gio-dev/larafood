<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateTenant;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TenantController extends Controller
{
    private $repository;

    public function __construct(Tenant $tenant)
    {
        $this->middleware('can:Tenant');
        $this->repository = $tenant;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = $this->repository->latest()->paginate();

        return view('admin.pages.tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUpdateTenant  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTenant $request)
    {
        $data = $request->all();


        $tenant = auth()->user()->tenant;

        if($request->hasFile('logo') && $request->logo->isValid()){
            $data['logo'] = $request->logo->store("tentants/{$tenant->uuid}/tenants");
        }

        $this->repository->create($data);

        return redirect()->route('tenants.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idTenant
     * @return \Illuminate\Http\Response
     */
    public function show($idTenant)
    {
        $tenant = $this->repository->with('plan')->find($idTenant);

        if(!$tenant)
            return redirect()->back();

        return view('admin.pages.tenants.show', compact('tenant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idTenant
     * @return \Illuminate\Http\Response
     */
    public function edit($idTenant)
    {
        $tenant = $this->repository->find($idTenant);

        if(!$tenant)
            return redirect()->back();

        return view('admin.pages.tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreUpdateTenant  $request
     * @param  int  $idTenant
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTenant $request, $idTenant)
    {
        $tenant = $this->repository->find($idTenant);

        if(!$tenant)
            return redirect()->back();

        $data = $request->all();

        $tenant = auth()->user()->tenant;

        if($request->hasFile('logo') && $request->logo->isValid()){
            if($tenant->logo && Storage::exists($tenant->logo)){
                Storage::delete($tenant->logo);
            }
            $data['logo'] = $request->logo->store("tentants/{$tenant->uuid}/tenants");
        }
        $tenant->update($data);

        return redirect()->route('tenants.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idTenant
     * @return \Illuminate\Http\Response
     */
    public function destroy($idTenant)
    {
        $tenant = $this->repository->find($idTenant);

        if(!$tenant)
            return redirect()->back();

        if($tenant->logo && Storage::exists($tenant->logo)){
            Storage::delete($tenant->logo);
        }
        $tenant->delete();

        return redirect()->route('tenants.index');
    }

    public function search(Request $request){

        $filters = $request->except('_token');
        $tenants = $this->repository->search($request->filter);

        return view('admin.pages.tenants.index', compact([
            'tenants',
            'filters'
        ]));

    }
}
