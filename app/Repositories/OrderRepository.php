<?php

namespace App\Repositories;


use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    protected $entity;

    public function __construct(Order $order)
    {
        $this->entity = $order;
    }

    public function createNewOrder(
        string $identify,
        float $total,
        string $status,
        int $tenant_id,
        $clientId = '',
        $tableId = '',
        string $comment = ''
    ){
        $data = [
            'identify' => $identify,
            'total' => $total,
            'status' => $status,
            'tenant_id' => $tenant_id,
            'comment' => $comment,
        ];
        if($clientId)
            $data['client_id'] = $clientId;
        if($tableId)
            $data['table_id'] = $tableId;

        $order = $this->entity->create($data);
        return $order;
    }
    public function getOrderByIdentifyRecursive(string $identify){
        return $this->entity->where('identify', $identify)->first();
    }
    public function getOrderByIdentify(int $idTenant,string $identify){
        return $this->entity->where('identify', $identify)
            ->where('tenant_id', $idTenant)->first();
    }

    public function registerProductsOrder(int $orderId, array $products){
        $order = $this->entity->find($orderId);
        $entityProd = $order->products();
        foreach ($products as $product) {
            $entityProd->attach($product['id'],[
                'qtd' => $product['qtd'],
                'price' => $product['price'],
            ]);
        }

    }
    public function getOrdersByClientId(int $idClient){
        return $this->entity->where('client_id', $idClient)->paginate();
    }
}
