<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface
{
    public function getAllCategories();
    public function getCategoriesAndPaginate();
    public function createCategory(array $attributes);
    public function getCategoryById($categoryId);
    public function updateCategory(array $attributes, $id);
    public function deleteCategory($categoryId);
    public function searchCategory();
}
