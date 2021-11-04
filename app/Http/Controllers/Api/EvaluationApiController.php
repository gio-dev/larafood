<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreEvaluationRequest;
use App\Http\Resources\EvaluationResource;
use App\Services\EvaluationService;

class EvaluationApiController extends Controller
{
    protected $evaluationService;
    public function __construct(EvaluationService $evaluationService)
    {
        $this->evaluationService = $evaluationService;
    }

    public function store(StoreEvaluationRequest $request, $identify){
        $data = $request->only('comment','stars');

        $evaluation = $this->evaluationService->createNewEvaluation($identify,$data);

        return new EvaluationResource($evaluation);
    }
}
