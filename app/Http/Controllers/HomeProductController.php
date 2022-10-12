<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\RateRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\BrandRepositoryInterface;
use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;

class HomeProductController extends Controller
{
    private $productRepository;
    private $rateRepository;
    private $userRepository;
    private $commentRepository;
    private $categoryRepository;
    private $brandRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        UserRepositoryInterface $userRepository,
        CommentRepositoryInterface $commentRepository,
        RateRepositoryInterface $rateRepository,
        CategoryRepositoryInterface $categoryRepository,
        BrandRepositoryInterface $brandRepository
    ) {
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
        $this->commentRepository = $commentRepository;
        $this->rateRepository = $rateRepository;
        $this->categoryRepository = $categoryRepository;
        $this->brandRepository = $brandRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = $this->productRepository->searchProducts();

        return view('user.home.product', ['products' => $products]);
    }

    /**
     * Rate product
     *
     * @return \Illuminate\Http\Response
     */
    public function rate(Request $request)
    {
        $productId = $request->productId;
        $userId = Auth::id();
        $checkRated = $this->rateRepository->checkUserRated($productId, $userId);
        if ($checkRated) {
            $rate = $this->rateRepository->updateRate(['product_id' => $productId, 'user_id' => $userId], ['rate' => $request->rate]);
            if ($rate) {
                return __('messages.update.success');
            }

            return __('messages.update.fail');
        }
        $checkBuy = $this->rateRepository->checkUserBuyProduct($productId, $userId);
        if ($checkBuy) {
            $values = [
                'user_id' => $userId,
                'product_id' => $productId,
                'rate' => $request->rate
            ];
            $rate = $this->rateRepository->createRate($values);
            if ($rate) {
                return __('messages.rate.success');
            }

            return __('messages.rate.fail');
        }

        return __('messages.rate.notBuy');
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
    public function show($id)
    {
        $avgRate = round($this->rateRepository->getAvgRate($id));
        $product = $this->productRepository->getProductById($id);
        $categories = $this->categoryRepository->getAllCategories();
        $brands = $this->brandRepository->getAllBrands();

        return view('user.home.detailProduct', [
            'categories' => $categories,
            'brands' => $brands,
            'product' => $product,
            'productSeller' =>   $this->userRepository->getUserById($product->user_id),
            'parentComments' => $this->commentRepository->getParentCommentByIdProduct($id),
            'replyComments' => $this->commentRepository->getReplyCommentByIdProduct($id),
            'avgRate' => $avgRate
        ]);
    }
}
