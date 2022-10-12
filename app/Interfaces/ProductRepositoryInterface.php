<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    public function getProductById($productId);
    public function getAllProducts();
    public function getProductsByCategory($categoryId);
    public function getProductsByBrand($brandId);
    public function getNewProducts();
    public function searchProducts();
    public function searchUserProducts();
    public function createProduct(array $attributes);
    public function deleteProduct($productId);
    public function updateProduct($productId, array $newDetails);
    public function getProductByIds(array $ids);
}
