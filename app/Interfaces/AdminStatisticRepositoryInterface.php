<?php

namespace App\Interfaces;

interface AdminStatisticRepositoryInterface
{
    /**
     * get total income that are sold in brands or categories
     */
    public function statisticByOption(string $table);

    /**
     * get quantity of the total order or the cancel order 
     */
    public function statisticByOrder(string $option);

    /**
     * get total income by month when $option = 'income'
     * get products that are sold in large to small quantities and total income when $option = 'amount'
     */
    public function statisticByProduct(string $option);
}
