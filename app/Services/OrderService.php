<?php

namespace App\Services;

use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class OrderService
{
    protected $orderRepository;
    protected $tenantRepository;
    protected $tableRepository;
    protected $productRepository;

    public function __construct(
        TenantRepositoryInterface $tenantRepository,
        OrderRepositoryInterface $orderRepository,
        TableRepositoryInterface $tableRepository,
        ProductRepositoryInterface $productRepository
    ){
        $this->tenantRepository = $tenantRepository;
        $this->orderRepository = $orderRepository;
        $this->tableRepository = $tableRepository;
        $this->productRepository = $productRepository;
    }

    public function createNewOrder(array $orderData){
        $tenantId = $this->getTenantOrder($orderData['token_company']);
        $productsOrder = $this->getProductsByOrder($tenantId,$orderData['products'] ?? []);
        $identify = $this->getIdentifyOrder(8);
        $total = $this->calcTotalOrder($productsOrder ?? []);
        $status = 'open';
        $tenant = $tenantId;
        $clientId = $this->getClientOrder();
        $tableId = $this->getTableOrder($tenantId,$orderData['table'] ?? '');
        $comment = $orderData['comment'] ?? '';


        $order = $this->orderRepository->createNewOrder($identify,$total,$status,$tenant,$clientId,$tableId,$comment);

        $this->orderRepository->registerProductsOrder($order->id, $productsOrder);

        return $order;
    }
    private function getIdentifyOrder(int $qtyChars = 8){
        $smallLetters = str_shuffle(mb_strtoupper('abcdefghijklmnopqrstuvwxyz'));

        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 123456789;

//        $specialChars = str_shuffle('!@#$%&*-');

//        $characters = $smallLetters.$numbers.$specialChars;
        $characters = $smallLetters.$numbers;

        $identify = substr(str_shuffle($characters), 0, $qtyChars);

        if($this->orderRepository->getOrderByIdentifyRecursive($identify)){
            $identify = $this->getIdentifyOrder($qtyChars +1);
        }

        return $identify;
    }
    private function getProductsByOrder($tenantId,array $productsOrder):array {
        $products = [];
        foreach ($productsOrder as $productOrder){
            $product = $this->productRepository->getProductByUuid($tenantId,$productOrder['identify']);
            array_push($products,[
               'id' => $product->id,
               'qtd' => $productOrder['qtd'],
               'price' => $product->price,
            ]);
        }
        return $products;
    }
    private function calcTotalOrder(array $products):float{
        $total = 0.00;
        foreach ($products as $product) {
            $total += $product['price'] * $product['qtd'];
        }
        return $total;
    }
    private function getTenantOrder(string $uuid){
        return $this->tenantRepository->getTenantByUuid($uuid)->id;
    }
    private function getTableOrder($tenantId,string $uuid = ''){
        if($uuid)
            return $this->tableRepository->getTableByUuid($tenantId,$uuid)->id;

        return '';
    }
    private function getClientOrder(){
        $client = auth()->check() ? auth()->user()->id : '';
        return $client;
    }
    public function getOrderByIdentify($tenantUuid, $identify){
        $tenantId = $this->getTenantOrder($tenantUuid);
        return $this->orderRepository->getOrderByIdentify($tenantId,$identify);
    }

    public function ordersByClient(){
        $client = $this->getClientOrder();
        if(!$client)
            return [];

        return $this->orderRepository->getOrdersByClientId($client);
    }
}
