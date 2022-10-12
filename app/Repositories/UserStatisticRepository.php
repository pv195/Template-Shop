<?php

namespace App\Repositories;

use App\Interfaces\UserStatisticRepositoryInterface;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class UserStatisticRepository implements UserStatisticRepositoryInterface
{
    /**
     * Statistic by products, brands, categories
     *
     * @param string $option
     * @param int $userId
     * @return void
     */
    public function getStatisticByProduct($option, $userId)
    {
        $query = Product::join('order_product', 'products.id', '=', 'order_product.product_id')
            ->join('orders', 'orders.id', '=', 'order_product.order_id');
        if ($option == 'product') {
            $query->Select('products.id', 'products.name')
                ->groupBy('products.name', 'products.id');
        }
        if ($option == 'brand') {
            $query->Select('brands.id', 'brands.name')
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->groupBy('brands.id', 'brands.name');
        }
        if ($option == 'category') {
            $query->Select('categories.id', 'categories.name')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->groupBy('categories.id', 'categories.name');
        }

        return $query->selectRaw('SUM(order_product.quantity) as total_quantity')
            ->selectRaw('SUM(order_product.quantity*products.price*(1-order_product.discount)) as total_money')
            ->where('products.user_id', $userId)
            ->where('orders.status', config('const.order.delivered'))
            ->orderBy('total_money', 'desc')
            ->get();
    }

    /**
     * Statistic by month in years
     *
     * @param int $userId
     * @return void
     */
    public function getStatisticOfTotalIncomeByMonth($userId)
    {
        return Order::join('order_product', 'orders.id', '=', 'order_product.order_id')
            ->join('products', 'products.id', '=', 'order_product.product_id')
            ->selectRaw('SUM(order_product.quantity*products.price*(1-order_product.discount)) as total_income')
            ->selectRaw('MONTH(orders.created_at) AS month ')
            ->groupBy('month')
            ->where('orders.status', config('const.order.delivered'))
            ->whereRaw('YEAR(orders.created_at) = year(curdate())')
            ->where('products.user_id', $userId)
            ->orderBy('month')
            ->get();
    }
}
