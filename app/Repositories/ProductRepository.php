<?php

namespace App\Repositories;

use App\Models\Product;
use App\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Get all products
     *
     * @return mixed
     */
    public function getAllProducts()
    {
        return Product::where('user_id', '!=', auth()->id())->orderBy('id', 'desc')->paginate(config('const.paginate.products'));
    }

    /**
     * Get products by category
     *
     * @param int $categoryId
     * @return void
     */
    public function getProductsByCategory($categoryId)
    {
        return Product::where('user_id', '!=', auth()->id())->where('category_id', $categoryId)->paginate(config('const.paginate.products'));
    }

    /**
     * Get products by brand
     *
     * @param int $categoryId
     * @return void
     */
    public function getProductsByBrand($brandId)
    {
        return Product::where('user_id', '!=', auth()->id())->where('brand_id', $brandId)->paginate(config('const.paginate.products'));
    }

    /**
     * Get new products
     *
     * @return mixed
     */
    public function getNewProducts()
    {
        return Product::take(12)->where('user_id', '!=', auth()->id())->orderBy('id', 'desc')->get();
    }

    /**
     * search product by attribute
     *

     * @return void
     */
    public function searchProducts()
    {
        $products = Product::where('user_id', '!=', auth()->id());
        $products->when(request('search'), function ($query) {
            return $query->where('name', 'LIKE', '%' . request('search') . '%');
        });
        $products->when(request('arrange'), function ($query) {
            return $query->orderBy('name', request('arrange'));
        });

        return $products->paginate(config('paginate.product'));
    }

    /** Get product by id
     *
     * @param int  $productId
     * @return mixed
     */
    public function getProductById($productId)
    {
        $product = Product::findOrFail($productId);
        $product->image = json_decode($product->image);

        return $product;
    }

    /**
     * Delete product by id
     *
     * @param int  $productId
     * @return mixed
     */
    public function deleteProduct($productId)
    {
        $product = Product::where('id', $productId);

        return $product->delete();
    }

    /**
     * Create product 
     *
     * @param array $newDetails
     * @return mixed
     */
    public function createProduct(array $newDetails)
    {
        return Product::create($newDetails);
    }

    /**
     * Update product by id
     *
     * @param int $productId
     * @param array $newDetails
     * @return mixed
     */
    public function updateProduct($productId, array $newDetails)
    {
        return Product::whereId($productId)->update($newDetails);
    }

    /**
     * get,search,filter,sort product
     *
     * @return void
     */
    public function searchUserProducts()
    {
        $products = Product::where('user_id', auth()->id());
        $products->when(request('search'), function ($query) {
            return $query->where('name', 'LIKE', '%' . request('search') . '%');
        });
        $products->when(request('arrange'), function ($query) {
            $arrange = explode('-', request('arrange'));

            return $query->orderBy($arrange[0], $arrange[1]);
        });
        $products->when(request('quantity'), function ($query) {
            $quantity = explode('-', request('quantity'));

            return $query->whereBetween('quantity', $quantity);
        });
        $products->when(request('brand'), function ($query) {
            return $query->where('brand_id', request('brand'));
        });
        $products->when(request('category'), function ($query) {
            return $query->where('category_id', request('category'));
        });

        return $products->paginate(config('paginate.product'));
    }

    /** 
     * get product by ids
     * @param array $ids
     * @return mixed
     */
    public function getProductByIds(array $ids)
    {
        return Product::WhereIn('id', $ids)->get();
    }
}
