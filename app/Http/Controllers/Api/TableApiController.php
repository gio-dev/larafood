<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\TableResource;
use App\Services\TableService;
use Illuminate\Http\Request;

class TableApiController extends Controller
{
    protected $tableService;
    public function __construct(TableService $tableService)
    {
        $this->tableService = $tableService;
    }

    public function getTablesByTenant(TenantFormRequest $request)
    {
        $perPage = (int)$request->get('per_page', 25);
        $tables = $this->tableService->getTablesByUuid($request->token_company, $perPage);
        return TableResource::collection($tables);
    }
    public function show(TenantFormRequest $request, $identify){
        $table = $this->tableService->getTableByIdentify($request->token_company, $identify);
        if(!$table)
            return response()->json(['message'=>'Table not found'], 404);

        return new TableResource($table);
    }
}
