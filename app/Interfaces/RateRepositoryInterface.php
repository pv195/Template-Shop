<?php

namespace App\Interfaces;

interface RateRepositoryInterface
{
    public function createRate(array $attributes);
    public function getRateById($rateId);
    public function updateRate(array $conditions, array $attributes);
    public function checkUserBuyProduct($productId, $userId);
    public function checkUserRated($productId, $userId);
    public function getAvgRate($productId);
}
