<?php

namespace App\Interfaces;

interface UserStatisticRepositoryInterface
{
    public function getStatisticByProduct($option, $userId);
    public function getStatisticOfTotalIncomeByMonth($userId);
}
