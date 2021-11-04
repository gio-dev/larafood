<?php

namespace App\Services;

use App\Repositories\Contracts\EvaluationRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;

class EvaluationService
{
    protected $orderRepository;
    protected $evaluationRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        EvaluationRepositoryInterface $evaluationRepository
    ){
        $this->evaluationRepository = $evaluationRepository;
        $this->orderRepository = $orderRepository;
    }

    public function createNewEvaluation(string $identifyOrder, array $arrayData){
        $clientId = $this->getClientEvaluation();
        if (!$clientId)
            return [];
        $order = $this->orderRepository->getOrderByIdentifyRecursive($identifyOrder);
        return $this->evaluationRepository->createEvaluationOrder(
            $order->id,
            $clientId,
            $arrayData['stars'],
            ($arrayData['comment'] ?? ''));
    }
    private function getClientEvaluation(){
        $client = auth()->check() ? auth()->user()->id : '';
        return $client;
    }
}
