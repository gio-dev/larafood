<?php

namespace App\Repositories\Contracts;

interface EvaluationRepositoryInterface
{

    public function createEvaluationOrder(int $order_id, int $client_id, float $stars, string $comment = '');
    public function getEvaluationsByOrder(int $order_id);
    public function getEvaluationsByClient(int $client_id);
    public function getEvaluationsById(int $evaluationId);
    public function getEvaluationsByOrderAndClient(int $order_id, int $client_id);

}
