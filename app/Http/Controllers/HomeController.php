<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\ProductRepositoryInterface;

class HomeController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        if ($request->has('search')) {
            $search = trim($request->search);
            if (empty($search)) {
                $products = $this->productRepository->getAllProducts();
            } else {
                $products = $this->productRepository->searchProducts($search);
            }

            return view('user.home.product', ['products' => $products]);
        }
        $products = $this->productRepository->getNewProducts();
      
        return view('user.home.index', ['products' => $products]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showProductsByCategory($id)
    {
        $products = $this->productRepository->getProductsByCategory($id);

        return view('user.home.product', ['products' => $products]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showProductsByBrand($id)
    {
        $products = $this->productRepository->getProductsByBrand($id);

        return view('user.home.product', ['products' => $products]);
    }
}
