<?php

namespace App\Interfaces;

interface BrandRepositoryInterface
{
    public function getBrandsAndPaginate();
    public function getAllBrands();
    public function createBrand(array $attributes);
    public function getBrandById($brandId);
    public function updateBrand(array $attributes, $id);
    public function deleteBrand($brandId);
    public function searchBrand();
}
