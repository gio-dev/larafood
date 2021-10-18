<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TenantResource;
use App\Services\TenantService;
use Illuminate\Http\Request;

class TenantApiController extends Controller
{
    private $tenantService;
    public function __construct(TenantService $service)
    {
        $this->tenantService = $service;
    }

    public function index(Request $request){
        $perPage = (int)$request->get('per_page', 25);
        $tenants = $this->tenantService->getAllTenants(
            $perPage
        );
        return TenantResource::collection($tenants);
    }
    public function show($uuid){

        $tenant = $this->tenantService->getTenantByUuid($uuid);

        if(!$tenant)
            return response()->json(['message'=>'Not found'], 404);

        return new TenantResource($tenant);
    }
}
