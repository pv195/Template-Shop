<?php

namespace App\Repositories;

use App\Interfaces\DiscountRepositoryInterface;
use App\Models\Discount;
use App\Models\DiscountProduct;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DiscountRepository implements DiscountRepositoryInterface
{

    /**
     * get all discounts and paginate
     *
     * @return void
     */
    public function getDiscountsAndPaginate()
    {
        return Discount::orderBy('id', 'desc')->paginate(10);
    }

    /**
     * get all discounts
     *
     * @return void
     */
    public function getAllDiscounts()
    {
        return Discount::all();
    }

    /**
     * create Discount 
     *
     * @param array
     * @return mixed
     */
    public function createDiscount(array $attributes)
    {
        return Discount::create($attributes);
    }

    /**
     * create DiscountProduct 
     *
     * @param array
     * @return mixed
     */
    public function createDiscountProduct(array $attributes)
    {
        return DiscountProduct::create($attributes);
    }

    /**
     * Get Discount by id 
     *
     * @param int
     */
    public function getDiscountById($discountId)
    {
        return Discount::findOrFail($discountId);
    }

     /**
     * Get DiscountProduct by id 
     *
     * @param int
     */
    public function getDiscountProductById($discountProductId)
    {
        return DiscountProduct::findOrFail($discountProductId);
    }

    /**
     * Update Discount 
     *
     * @return mixed
     */
    public function updateDiscount(array $attributes, $id)
    {
        return Discount::whereId($id)->update($attributes);
    }

    /**
     * delete Discount by id 
     *
     * @param int
     */
    public function deleteDiscount($discountId)
    {
        $discount = $this->getDiscountById($discountId);
        $result = DB::transaction(function () use ($discount) {
            $discount->discountProducts()->delete();

            return $discount->delete();
        });

        return $result;
    }

    /**
     * delete DiscountProduct by id 
     *
     * @param int
     */
    public function deleteDiscountProduct($discountProductId)
    {
        return DiscountProduct::destroy($discountProductId);
    }

    /**
     * get DiscountProduct on Discount by discountId 
     *
     * @param int
     */
    public function getDiscountProductOnDiscount($discountId)
    {
        return DiscountProduct::where('discount_id', $discountId)->orderBy('id', 'desc')->paginate(10);
    }

     /**
     * get the product which be applied discount by discountProductId 
     *
     * @param int
     */
    public function getProductBeAppliedDiscount($discountProductId)
    {
        return Product::where('id', $discountProductId)->orderBy('id', 'desc');
    }

    /**
     * get Discount_product by code 
     *
     * @return void
     */
    public function getAllDiscountProducts()
    {
        return DiscountProduct::all();
    }

    /**
     * get Discount_product by code 
     *
     * @return void
     */
    public function getDiscountByCode($code)
    {
        return DiscountProduct::where('code', $code)->first();
    }

    /**
     * get discounts by discountId
     *
     * @return void
     */
}
