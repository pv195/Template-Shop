<?php

namespace App\Repositories;

use App\Interfaces\OrderManagementRepositoryInterface;
use App\Models\Order;

class OrderManagementRepository implements OrderManagementRepositoryInterface
{
    /**
     * get all orders by status and id
     *
     * @param int $status
     * @param int $userId
     * @return void
     */
    public function getAllByStatusAndUserId(array $conditions, $orderBy, $isAsc, $offset, $limit)
    {
        return Order::where($conditions)
            ->orderBy($orderBy, $isAsc)
            ->offset($offset)
            ->limit($limit)
            ->paginate(10);
    }

    /**
     * update order by id
     *
     * @param array $attributes
     * @param int $id
     * @return void
     */
    public function update(array $attributes, array $conditions)
    {
        return Order::where($conditions)->update($attributes);
    }

    /**
     * Get Order by id
     *
     * @param int $id
     * @return void
     */
    public function getById($id)
    {
        return Order::join('order_product', 'order_id', '=', 'orders.id')
            ->join('products', 'product_id', '=', 'products.id')
            ->select('orders.id', 'status', 'note', 'fullname', 'address', 'name', 'price', 'image', 'phone', 'order_product.quantity', 'discount')
            ->selectRaw("order_product.quantity*products.price*22000*((100-order_product.discount)/100) as total")
            ->findOrFail($id);
    }
}
