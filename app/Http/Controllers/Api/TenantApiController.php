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

    public function index(){
        return TenantResource::collection($this->tenantService->getAllTenants());
    }
}
