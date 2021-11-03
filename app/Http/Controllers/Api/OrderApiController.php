<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOrder;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\OrderResource;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderApiController extends Controller
{
    protected
        $orderService;
    public function __construct(
        OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(StoreOrder $request){

        $order = $this->orderService->createNewOrder($request->all());
        return new OrderResource($order);
    }

    public function myOrders(){
        $orders = $this->orderService->ordersByClient();

        return OrderResource::collection($orders);
    }
    public function show(TenantFormRequest $request, $identify){
        $order = $this->orderService->getOrderByIdentify($request->token_company, $identify);
        if(!$order)
            return response()->json(['message'=>'Order not found'], 404);

        return new OrderResource($order);
    }
}
