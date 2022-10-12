<?php

namespace App\Repositories;

use App\Models\Rate;
use App\Interfaces\RateRepositoryInterface;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;

class RateRepository implements RateRepositoryInterface
{
    /**
     * Create rate 
     *
     * @param array $attributes
     * @return mixed
     */
    public function createRate(array $attributes)
    {
        return Rate::create($attributes);
    }

    /**
     * check user buy product 
     *
     * @param array $attributes
     * @return mixed
     */
    public function checkUserBuyProduct($productId,  $userId)
    {
        return Order::join('order_product', 'order_id', '=', 'orders.id')
            ->where('orders.user_id', $userId)
            ->where('order_product.product_id', $productId)
            ->get();
    }

    /**
     * check user buy product 
     *
     * @param array $attributes
     * @return mixed
     */
    public function checkUserRated($productId,  $userId)
    {
        return Rate::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();
    }

    /**
     * get Avg rate of product
     *
     * @param $productId
     * @return mixed
     */
    public function getAvgRate($productId)
    {
        return Rate::where('product_id', $productId)
            ->avg('rate');
    }

    /**
     * Get Rate by id 
     *
     * @param int
     * @return mixed
     */
    public function getRateById($rateId)
    {
        return Rate::findOrFail($rateId);
    }

    /**
     * Update rate by id
     *
     * @param array $conditions
     * @param array $attributes
     * @return mixed
     */
    public function updateRate(array $conditions, array $attributes)
    {
        return Rate::where($conditions)->update($attributes);
    }
}
