@extends('user.layouts.app')
@section('content')
    <div class="order-container">
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="order-heading">My Order</div>
        <div class="order-status">
            <div class="order-tab custom-tab-active" route="{{ route('user.orders.index') }}" scope="col" data-value="-1">
                All orders
            </div>
            <div class="order-tab" route="{{ route('user.orders.index') }}" scope="col" data-value="0">Pending</div>
            <div class="order-tab" route="{{ route('user.orders.index') }}" scope="col" data-value="1">Confirmed</div>
            <div class="order-tab" route="{{ route('user.orders.index') }}" scope="col" data-value="2">Delivering
            </div>
            <div class="order-tab" route="{{ route('user.orders.index') }}" scope="col" data-value="3">Delivered</div>
            <div class="order-tab" route="{{ route('user.orders.index') }}" scope="col" data-value="4">Cancelled</div>
        </div>
        <div class="order-component">
            <div class="product-orders">
                <table class="table table-order">
                    <thead class="table-thead">
                        <tr>
                            <th>Order ID</th>
                            <th>Orderer's name</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th style="width: 10%">Tool</th>
                        </tr>
                    </thead>
                    <tbody id="tableOrder" class="table-tbody">
                        @if ($orderLists->isEmpty())
                            <tr>
                                <td colspan="5">
                                    <img class="img-no-order" src="{{ asset('assets/user/images/no-order.png') }}">
                                    <p class="text-no-order">No orders yet</p>
                                </td>
                            </tr>
                        @endif
                        @foreach ($orderLists as $order)
                            <tr>
                                <th>{{ $order->id }}</th>
                                <td>{{ $order->fullname }}</td>
                                <td>{{ $order->created_at_label }}</td>
                                <td>
                                    @if ($order->status != 4)
                                        <div class="status">{{ $order->status_label }}</div>
                                    @else
                                        <div class="status status-cancel ">{{ $order->status_label }}</div>
                                    @endif
                                </td>
                                <td style="display: flex; justify-content: space-evenly">
                                    <a href="{{ route('user.orders.show', ['id' => $order->id]) }}">
                                        <button class="ti-eye btn btn-success btn-custom"></button>
                                    </a>
                                    @if ($order->status == 0)
                                        <form onsubmit="return confirm('Are you sure you want to cancel this order?')"
                                            action="{{ route('user.orders.update', ['id' => $order->id]) }}"
                                            method="POST">
                                            {{ csrf_field() }}
                                            @method('PATCH')
                                            <button type="submit" class="ti-na btn btn-danger btn-custom"></button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $orderLists->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
