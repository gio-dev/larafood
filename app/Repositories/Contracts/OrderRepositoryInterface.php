<?php

namespace App\Repositories\Contracts;

interface OrderRepositoryInterface
{

    public function createNewOrder(
        string $identify,
        float $total,
        string $status,
        int $tenant_id,
        $clientId = '',
        $tableId = '',
        string $comment = ''
    );
    public function getOrderByIdentify(int $idTenant,string $identify);
    public function getOrderByIdentifyRecursive(string $identify);
    public function getOrdersByClientId(int $idClient);
    public function registerProductsOrder(int $orderId, array $products);
}
