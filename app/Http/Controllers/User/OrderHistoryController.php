<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\OrderRepositoryInterface;

class OrderHistoryController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('statusId')) {
            $orderLists = $this->orderRepository->getOrders($request->statusId);

            return view('user.orders_history.table_order', compact('orderLists'))->render();
        } 
        $orderLists = $this->orderRepository->getOrders('-1');  
   
        return view('user.orders_history.index', compact('orderLists'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderDetails = $this->orderRepository->getOrderDetails($id);
    
        return view('user.orders_history.show', compact('orderDetails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $this->orderRepository->updateOrder(['status' => config('const.order.cancelled')], $id);

        return back()->with('success', __('messages.cancel.success'));
    }
}
