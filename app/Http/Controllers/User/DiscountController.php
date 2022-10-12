<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DiscountRequest;
use App\Http\Requests\DiscountProductRequest;
use App\Interfaces\DiscountRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\User;
use Carbon\Carbon;
use Mail;

class DiscountController extends Controller
{
    private $discountRepository;
    private $productRepository;

    public function __construct(
        DiscountRepositoryInterface $discountRepository,
        ProductRepositoryInterface $productRepository)
    {
        $this->discountRepository = $discountRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $discounts = $this->discountRepository->getDiscountsAndPaginate();

        return view('user.discounts.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.discounts.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscountRequest $request)
    {
        $discount = $this->discountRepository->createDiscount($request->validated());
        if ($discount) {
            return redirect()->route('user.discounts.index')->with('msg', __('messages.create.success'));
        }

        return redirect()->route('user.discounts.index')->with('fail', __('messages.create.fail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $discount = $this->discountRepository->getDiscountById($id);
        $discountProducts = $this->discountRepository->getDiscountProductOnDiscount($id);

        return view('user.discounts.detailDiscount', compact('discount', 'discountProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discount = $this->discountRepository->getDiscountById($id);

        return view('user.discounts.edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DiscountRequest $request, $id)
    {
        $discount = $this->discountRepository->updateDiscount($request->validated(), $id);
        if ($discount) {
            return redirect()->route('user.discounts.index')->with('msg', __('messages.create.success'));
        }

        return redirect()->route('user.discounts.index')->with('fail', __('messages.create.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyDiscount($id)
    {
        $result = $this->discountRepository->deleteDiscount($id);
        if ($result) {
            return redirect()->route('user.discounts.index')->with('msg', __('messages.delete.success'));
        }

        return redirect()->route('user.discounts.index')->with('fail', __('messages.delete.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyDiscountProduct($discountId, $discountProductId)
    {
        $result = $this->discountRepository->deleteDiscountProduct($discountProductId);
        if ($result) {
            return redirect()->route('user.discounts.show', 
            ['id' => $discountId, 'discountProductId' => $discountProductId])->with('msg', __('messages.delete.success'));
        }

        return redirect()->route('user.discounts.show', 
        ['id' => $discountId, 'discountProductId' => $discountProductId])->with('fail', __('messages.delete.fail'));
    }

    /**
     * Create a new code for discount
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createNewCode($discountId)
    {
        $products = $this->productRepository->getAllProducts();
        $discount = $this->discountRepository->getDiscountById($discountId);
        $discountProducts = $this->discountRepository->getDiscountProductOnDiscount($discountId);
        
        return view('user.discounts.createCode', 
        ['products' => $products, 'discountProducts' => $discountProducts, 'discount' => $discount]);
    }

    /**
     * Store a new code for discount
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeNewCode(DiscountProductRequest $request, $discountId)
    {
        $discountProducts = $this->discountRepository->createDiscountProduct($request->validated());
        if ($discountProducts) {
            return redirect()->route('user.discounts.storeNewCode', 
            ['id' => $discountId])->with('msg', __('messages.create.success'));
        }

        return redirect()->route('user.discounts.storeNewCode', 
        ['id' => $discountId])->with('fail', __('messages.create.fail'));
    }

    /**
     * Send a discount via email to user
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendCouponViaEmail($discountId)
    {
        $users = User::where('role', '0')->get();
        $discount = $this->discountRepository->getDiscountById($discountId);
        $discountProducts = $this->discountRepository->getDiscountProductOnDiscount($discountId);
        $from = Carbon::parse($discount->from)->format('d-m-Y');
        $to = Carbon::parse($discount->to)->format('d-m-Y');
        $titleMail = "Voucher for discount program : ".$discount->name.' from : '.$from.' -> to : '.$to;
        $data = [];
        foreach($users as $user){
            $data['email'][] = $user->email;
        }
        $data['discount'] = $discount;
        $data['discountProducts'] = $discountProducts;
        Mail::send('user.discounts.sendCouponEmail', $data, function($message) use ($titleMail, $data){
            $message->to($data['email'])->subject($titleMail);
            $message->from($data['email'], $titleMail); 
        });

        return view('user.discounts.detailDiscount', compact('discount', 'discountProducts'));
    }
}
