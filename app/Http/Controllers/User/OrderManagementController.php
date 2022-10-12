<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\OrderManagementRepositoryInterface;
use Illuminate\Http\Request;

class OrderManagementController extends Controller
{
    private $orderManagementRepository;

    public function __construct(OrderManagementRepositoryInterface $orderManagementRepository)
    {
        $this->orderManagementRepository = $orderManagementRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orderBy = 'id';
        $isAsc = 'asc';
        $offset = 10;
        $limit = 5;
        if ($request->has(['type'])) {
            $orders = $this->orderManagementRepository->getAllByStatusAndUserId([
                'status' => $request->type, 
                'user_id' => auth()->id()
            ], $orderBy, $isAsc, $offset, $limit);

            return view('user.orders.table_order_management', compact('orders'))->render();
        }
        $orders = $this->orderManagementRepository->getAllByStatusAndUserId([
            'status' => config('const.order.pending'), 
            'user_id' => auth()->id()
        ], $orderBy, $isAsc, $offset, $limit);

        return view("user.orders.index", compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(request $request, $id)
    {
        $order = $this->orderManagementRepository->getById($request->id);

        return view('user.orders.order_detail', compact('order'))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $status = $request->status;
        if ($status != config('const.order.cancelled')) {
            switch ($status) {
                case 0:
                    $status =  config('const.order.confirmed');
                    break;
                case 1:
                    $status = config('const.order.delivering');
                    break;
                case 2:
                    $status = config('const.order.delivered');
                    break;
                default:
                    break;
            }
            $this->orderManagementRepository->update(['status' => $status], ['id' => $id]);

            return back()->with('success', __('messages.order.update-success'));
        }
        $this->orderManagementRepository->update(['status' => config('const.order.pending')], ['id' => $id]);

        return back()->with('success', __('messages.order.restore-success'));
    }

    /**
     * Update order status to cancelled
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->orderManagementRepository->update(['status' => config('const.order.cancelled')], ['id' => $id]);

        return back()->with('success', __('messages.order.delete-success'));
    }
}
