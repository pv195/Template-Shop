<?php

namespace App\Repositories;

use App\Interfaces\CheckoutdRepositoryInterface;
use App\Interfaces\CheckoutRepositoryInterface;
use App\Models\Order;
use App\Models\OrderProduct;

class CheckoutRepository implements CheckoutRepositoryInterface
{
    /**
     * add data in order table
     *
     * @return void
     */
    public function checkoutOrder(array $order)
    {
        return Order::create($order);
    }

    /**
     * add data in orderproduct table
     *
     * @return void
     */
    public function checkoutOrderProduct(array $order)
    {
        return OrderProduct::create($order);
    }
}
