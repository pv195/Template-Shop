<?php

namespace App\Interfaces;

interface CheckoutRepositoryInterface
{
    public function checkoutOrder(array $order);
    public function checkoutOrderProduct(array $order);
}
