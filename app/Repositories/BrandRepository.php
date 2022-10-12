<?php

namespace App\Repositories;

use App\Interfaces\BrandRepositoryInterface;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;

class BrandRepository implements BrandRepositoryInterface
{
    /**
     * get all brands and paginate
     *
     * @return void
     */
    public function getBrandsAndPaginate()
    {
        return Brand::orderBy('id', 'desc')->paginate(10);
    }

    /**
     * get all brands
     *
     * @return void
     */
    public function getAllBrands()
    {
        return Brand::all();
    }

    /**
     * get,search,sort brands
     * @return mixed
     */
    public function searchBrand()
    {
        $brands = Brand::query();
        $brands->when(request('search'), function($query) {
            return $query->where('name', 'LIKE', '%' . request('search') . '%');
        });
        $brands->when(request('sort'), function($query) {
            return $query->orderBy('name', request('sort'));
        });

        return $brands->paginate(config('paginate.brand'));
    }

    /**
     * create Brand 
     *
     * @param array
     * @return mixed
     */
    public function createBrand(array $attributes)
    {
        return Brand::create($attributes);
    }

    /**
     * Get Brand by id 
     *
     * @param int
     */
    public function getBrandById($brandId)
    {
        return Brand::findOrFail($brandId);
    }

    /**
     * Update Brand 
     *
     * @return mixed
     */
    public function updateBrand(array $attributes, $id)
    {
        return Brand::whereId($id)->update($attributes);
    }

    /**
     * delete Brand by id 
     *
     * @param int
     */
    public function deleteBrand($brandId)
    {
        $brand = $this->getBrandById($brandId);
        $result = DB::transaction(function () use ($brand) {
            $brand->products()->delete();

            return $brand->delete();
        });

        return $result;
    }
}
