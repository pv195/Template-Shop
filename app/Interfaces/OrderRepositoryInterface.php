<?php

namespace App\Interfaces;

interface OrderRepositoryInterface
{
    public function getOrderDetails($orderId);
    public function getOrders($status);
    public function updateOrder(array $attributes, $id);
}
