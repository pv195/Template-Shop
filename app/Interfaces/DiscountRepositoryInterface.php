<?php

namespace App\Interfaces;

interface DiscountRepositoryInterface
{
    public function getDiscountsAndPaginate();
    public function getAllDiscounts();
    public function createDiscount(array $attributes);
    public function createDiscountProduct(array $attributes);
    public function getDiscountById($discountId);
    public function updateDiscount(array $attributes, $id);
    public function deleteDiscount($discountId);
    public function deleteDiscountProduct($discountProductId);
    public function getDiscountProductOnDiscount($discountId);
    public function getProductBeAppliedDiscount($discountProductId);
    public function getAllDiscountProducts();
    public function getDiscountByCode($code);
}
