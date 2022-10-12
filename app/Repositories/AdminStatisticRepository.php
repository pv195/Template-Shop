<?php

namespace App\Repositories;

use App\Interfaces\AdminStatisticRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AdminStatisticRepository implements AdminStatisticRepositoryInterface
{
    /**
     * get total income that are sold in brands or categories
     */
    public function statisticByOption(string $table)
    {
        $tableId = 'category_id';
        if ($table == 'brands') {
            $tableId = 'brand_id';
        }

        return DB::table($table)
            ->leftJoin('products', $table . '.id', '=', 'products.' . $tableId)
            ->leftJoin('order_product', 'products.id', '=', 'order_product.product_id')
            ->leftJoin('orders', 'orders.id', '=', 'order_product.order_id')
            ->select($table . '.name')
            ->selectRaw('COALESCE(SUM(order_product.quantity*products.price*(1-order_product.discount)), 0)  as total')
            ->whereNull('orders.status')
            ->orWhere('orders.status', config('const.order.delivered'))
            ->groupBy($table . '.name')
            ->orderBy('total', 'desc')
            ->get();
    }

    /**
     * get total income by month when $option = 'income'
     * get products that are sold in large to small quantities and total income when $option = 'amount'
     */
    public function statisticByProduct(string $option)
    {
        return DB::table('products')->join('order_product', 'products.id', '=', 'order_product.product_id')
            ->join('orders', 'orders.id', '=', 'order_product.order_id')
            ->when($option == 'income', function ($query) {
                return $query->selectRaw('SUM(order_product.quantity*products.price*(1-order_product.discount)) as total')
                    ->selectRaw('MONTH(order_product.created_at) as month')
                    ->whereRaw('YEAR(order_product.created_at) = year(curdate())')
                    ->where('orders.status', config('const.order.delivered'))
                    ->groupBy('month');
            })->when($option == 'amount', function ($query) {
                return $query->select('products.id', 'products.name', 'products.quantity')
                    ->selectRaw('SUM(order_product.quantity) as sold_quantity')
                    ->selectRaw('SUM(order_product.quantity*products.price*(1-order_product.discount)) as total')
                    ->where('orders.status', config('const.order.delivered'))
                    ->groupBy('products.id')
                    ->orderBy('total', 'desc');
            })->get();
    }

    /**
     * get quantity of the total order or the cancel order 
     */
    public function statisticByOrder(string $option)
    {
        return DB::table('orders')
            ->selectRaw('count(*) as total')
            ->selectRaw('MONTH(created_at) as month')
            ->whereRaw('YEAR(created_at) = year(curdate())')
            ->when($option == 'cancel', function ($query, $role) {
                return $query->where('orders.status', config('const.order.cancelled'));
            })
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();
    }
}
