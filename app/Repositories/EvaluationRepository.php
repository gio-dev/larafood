<?php

namespace App\Repositories;

use App\Models\Evaluation;
use App\Repositories\Contracts\EvaluationRepositoryInterface;

class EvaluationRepository implements EvaluationRepositoryInterface
{
    protected $entity;

    public function __construct(Evaluation $evaluation)
    {
        $this->entity = $evaluation;
    }

    public function createEvaluationOrder(
        int $order_id,
        int $client_id,
        float $stars,
        string $comment = ''
    ){

        return $this->entity->create([
            'client_id' => $client_id,
            'order_id' => $order_id,
            'stars' => $stars,
            'comment' => $comment,
        ]);
    }

    public function getEvaluationsByOrder(int $order_id){
        return $this->entity->where('order_id',$order_id)->paginate();
    }
    public function getEvaluationsByClient(int $client_id){
        return $this->entity->where('client_id',$client_id)->paginate();
    }
    public function getEvaluationsById(int $evaluationId){
        return $this->entity->find($evaluationId);
    }
    public function getEvaluationsByOrderAndClient(int $order_id, int $client_id){
        return $this->entity
                    ->where('client_id',$client_id)
                    ->where('order_id',$order_id)
                    ->first();
    }
}
