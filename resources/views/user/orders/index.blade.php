@extends('user.layouts.app')
@section('content')
    <div class="order_management_container">
        <div class="heading-order-management">List order</div>
        @if (session()->has('success'))
            <div class="alert alert-success order-alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="order_status">
            <div class="status_product" route="{{ route('user.orders-management.index') }}" data-type="0">Pending</div>
            <div class="status_product" route="{{ route('user.orders-management.index') }}" data-type="1">Confirmed</div>
            <div class="status_product" route="{{ route('user.orders-management.index') }}" data-type="2">Delivering</div>
            <div class="status_product" route="{{ route('user.orders-management.index') }}" data-type="3">Delivered</div>
            <div class="status_product" route="{{ route('user.orders-management.index') }}" data-type="4">Cancelled</div>
        </div>
    </div>
    <div class="list_order">
        <table class="table_list_order table" id="tableListOrder">
            <thead>
                <tr class="custom_row">
                    <th scope="col">Order id</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Status</th>
                    <th scope="col">Note</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="container_list_order">
                @if ($orders->isEmpty())
                    <tr>
                        <td colspan="6">
                            <img class="custom-image" src="{{ asset('assets/user/images/no-order.png') }}" alt="">
                            <p class="no-order">No order yet</p>
                        </td>
                    </tr>
                @endif
                @foreach ($orders as $order)
                    <tr class="custom_row">
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->fullname }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->address }}</td>
                        @if ($order->status == 4)
                            <td><span class="manager-status cancel">{{ $order->status_label }}</span></td>
                        @else
                            <td><span class="manager-status">{{ $order->status_label }}</span></td>
                        @endif
                        <td>{{ $order->note }}</td>
                        <td style="justify-content: space-evenly;display: flex;">
                            @if ($order->status == 0 || $order->status == 1 || $order->status == 2)
                                <form
                                    action="{{ route('user.orders-management.update', ['id' => $order->id, 'status' => $order->status]) }}"
                                    method="POST">
                                    {{ csrf_field() }}
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success ti-check btn-order-management"></button>
                                </form>
                            @endif
                            @if ($order->status == 4)
                                <form
                                    action="{{ route('user.orders-management.update', ['id' => $order->id, 'status' => $order->status]) }}"
                                    method="POST">
                                    {{ csrf_field() }}
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-warning ti-back-left"
                                        onclick="return confirm('Are you want restore this order ?')">
                                    </button>
                                </form>
                            @endif
                            @if ($order->status == 0)
                                <form action="{{ route('user.orders-management.destroy', ['id' => $order->id]) }}"
                                    method="POST">
                                    {{ csrf_field() }}
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-danger ti-trash"
                                        onclick="return confirm('Are you want cancel this order ?')">
                                    </button>
                                </form>
                            @endif
                            <button data-toggle="modal" data-target="#ModalDetail" data-id="{{ $order->id }}"
                                route="{{ route('user.orders-management.show', ['id' => $order->id]) }}"
                                class="btn btn-primary ti-eye orderDetail"></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="ModalDetail" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="title-order">Order detail</h3>
                <div class="modal-header">
                    <button type="button" class="close button-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body body">
                    <table class="details"></table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/user/js/order-management.js') }}"></script>
@endsection
