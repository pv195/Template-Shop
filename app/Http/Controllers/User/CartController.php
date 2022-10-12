<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\CheckoutRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\DiscountRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private $productRepository;
    private $checkoutRepository;
    private $userRepository;
    private $discountRepository;

    public function __construct(ProductRepositoryInterface $productRepository, CheckoutRepositoryInterface $checkoutRepository, UserRepositoryInterface $userRepository, DiscountRepositoryInterface $discountRepository)
    {
        $this->productRepository = $productRepository;
        $this->checkoutRepository = $checkoutRepository;
        $this->userRepository = $userRepository;
        $this->discountRepository = $discountRepository;
    }

    /**
     * Add products to cart
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $id = $request->id;
        $product = $this->productRepository->getProductById($id);
        $cart = session()->get('cart');
        if (!$cart) {
            $cart[$id] = [
                "quantity" => 1,
            ];
            session()->put('cart', $cart);
        } else {
            if (isset($cart[$id])) {
                if ($product->quantity <= $cart[$id]['quantity']) {
                    return  __('messages.addCart.max-quantity');
                }
                $cart[$id]['quantity'] += 1;
                session()->put('cart', $cart);
            } else {
                $cart[$id] = [
                    "quantity" => 1,
                ];
                session()->put('cart', $cart);
            }
        }

        return  __('messages.addCart.success');
    }

    /**
     * show products in page cart
     *
     * @param Request $request
     */
    public function show(Request $request)
    {
        $products = array();
        if (session()->has('cart')) {
            $cart = session()->get('cart');
            $ids = array_keys($cart);
            $products = $this->productRepository->getProductByIds($ids);
            foreach ($products as $key => $product) {
                if (in_array($product['id'], $ids)) {
                    $product['quantity'] = $cart[$product['id']]['quantity'];
                }
            }
        }

        return view('user.cart.index', ['products' => $products]);
    }

    /**
     * update quantity of products in page cart
     *  
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request)
    {
        $cart = session()->get('cart');
        foreach ($cart as $key => $value) {
            if ($key == $request->id) {
                $cart[$key]['quantity'] = $request->quantity;
                session()->put('cart', $cart);
                if ($request->quantity == 0) {
                    unset($cart[$request->id]);
                    session()->put('cart', $cart);
                }
            }
        }
    }

    /**
     * change price of products
     * 
     * @param Request $request
     * @return mixed
     */
    public function applyCoupon(Request $request)
    {
        $products = array();
        if (session()->has('cart')) {
            $cart = session()->get('cart');
            $ids = array_keys($cart);
            $products = $this->productRepository->getProductByIds($ids);
            $allDiscount = $this->discountRepository->getAllDiscountProducts();
            foreach ($products as $key => $product) {
                $product['quantity'] = $cart[$product['id']]['quantity'];
                foreach ($allDiscount as $value) {
                    if ($value['code'] == $request->coupon) {
                        if ($product['id'] == $value['product_id']) {
                            $discount = $this->discountRepository->getDiscountById($value['discount_id']);
                            if ($discount['status'] == config('const.discount.active')) {
                                $product['price'] = $product['price'] - ($product['price'] *  $value['rate'] / 100);
                                $code = session()->get('code');
                                $code[$product['id']] = [
                                    "code" => $value['code'],
                                ];
                                session()->put('code', $code);
                            }
                        }
                    }
                }
            }
        }

        return view('user.cart.index', ['products' => $products]);
    }

    /**
     * get user order 
     * 
     * @return mixed
     */
    private function getUserOrder($user)
    {
        return [
            'user_id' => $user->id,
            'status' => '0',
            'note' => null,
            'fullname' => $user->name,
            'address' => $user->address,
            'phone' => $user->phone
        ];
    }

    /**
     * checkout cart 
     * 
     * @param Request $request
     * @return mixed
     */
    public function checkout(Request $request)
    {
        if (session()->has('cart')) {
            $cart = session()->get('cart');
            $ids = array_keys($cart);
            $products = $this->productRepository->getProductByIds($ids);
            $check = 0;
            foreach ($products as $key => $product) {
                if ($product['quantity'] < $cart[$product['id']]['quantity']) {
                    $check = 1;

                    return redirect('/cart')->with('message', __('messages.checkout.quantity'));
                }
            }
            if ($check == 0) {
                $userId = auth::id();
                $user = $this->userRepository->getUserById($userId);
                $userOrder = $this->getUserOrder($user);
                $order = $this->checkoutRepository->checkoutOrder($userOrder);
                $allDiscounts = $this->discountRepository->getAllDiscountProducts();
                foreach ($cart as $key => $value) {
                    $product = $this->productRepository->getProductById($key);
                    $product->quantity = $product->quantity - $value['quantity'];
                    $updateProduct = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'user_id' => $product->user_id,
                        'category_id' => $product->category_id,
                        'brand_id' => $product->brand_id,
                        'image' => $product->image,
                        'description' => $product->description,
                        'quantity' => $product->quantity
                    ];
                    $this->productRepository->updateProduct($key, $updateProduct);
                    $rate = 0;
                    if (session()->has('code')) {
                        $code = session()->get('code');
                        foreach ($code as $id => $code) {
                            if ($key == $id) {
                                foreach ($allDiscounts as $discount) {
                                    if ($discount['code'] == $code['code']) {
                                        $rate = $discount['rate'];
                                    }
                                }
                            }
                        }
                    }
                    $productOrder = [
                        'order_id' => $order->id,
                        'product_id' => $key,
                        'quantity' => $value['quantity'],
                        'discount' => $rate
                    ];
                    $this->checkoutRepository->checkoutOrderProduct($productOrder);
                }
            }
            $request->session()->forget('code');
            $request->session()->forget('cart');

            return redirect('/cart')->with('message', __('messages.checkout.success'));
        }

        return redirect('/cart')->with('message', __('messages.checkout.fail'));
    }
}
