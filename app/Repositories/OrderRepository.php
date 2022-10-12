<?php

namespace App\Repositories;

use App\Models\Order;
use App\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * Get orders by status
     *
     * @param Request $request
     * @return void
     */
    public function getOrders($status)
    {
        return Order::where('user_id', auth()->id())
            ->when($status != '-1', function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->orderBy('id', 'desc')
            ->paginate(config('const.order.pages'));
    }

    /**
     * Update order by attributes
     *
     * @param array $attributes
     * @param int $id
     * @return void
     */
    public function updateOrder(array $attributes, $id)
    {
        return Order::whereId($id)->update($attributes);
    }

    /**
     * Get order detail by orderId
     *
     * @param int $orderId
     * @return void
     */
    public function getOrderDetails($orderId)
    {
        return Order::with('orderProducts')->find($orderId);
    }
}
