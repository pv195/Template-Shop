<?php

namespace App\Interfaces;

interface OrderManagementRepositoryInterface
{
    public function getAllByStatusAndUserId(array $conditions, $orderBy, $isAsc, $offset, $limit);
    public function update(array $attributes, array $conditions);
    public function getById($id);
}
