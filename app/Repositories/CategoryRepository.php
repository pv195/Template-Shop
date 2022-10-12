<?php

namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * get all categories and paginate
     *
     * @return mixed
     */
    public function getCategoriesAndPaginate()
    {
        return Category::orderBy('id', 'desc')->paginate(10);
    }

    /**
     * get all categories
     *
     * @return mixed
     */
    public function getAllCategories()
    {
        return Category::all();
    }

    /**
     * get,search,sort category
     * @return mixed
     */
    public function searchCategory()
    {
        $categories = Category::query();
        $categories->when(request('search'), function($query) {
            return $query->where('name', 'LIKE', '%' . request('search') . '%');
        });
        $categories->when(request('sort'), function($query) {
            return $query->orderBy('name', request('sort'));
        });

        return $categories->paginate(config('paginate.category'));
    }
    
    /**
     * create Category 
     *
     * @param array
     * @return mixed
     */
    public function createCategory(array $attributes)
    {
        return Category::create($attributes);
    }

    /**
     * Get Category by id 
     *
     * @param int
     */
    public function getCategoryById($categoryId)
    {
        return Category::findOrFail($categoryId);
    }

    /**
     * Update Category 
     *
     * @return mixed
     */
    public function updateCategory(array $attributes, $id)
    {
        return Category::whereId($id)->update($attributes);
    }

    /**
     * delete Category by id 
     *
     * @param int
     */
    public function deleteCategory($categoryId)
    {
        $category = $this->getCategoryById($categoryId);
        $result = DB::transaction(function () use ($category) {
            $category->products()->delete();

            return $category->delete();
        });

        return $result;
    }
}
