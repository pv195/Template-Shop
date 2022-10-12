@extends('user.layouts.app')
@section('content')
    <div>
        <div class="view-detail">
            <div class="title">
                <div>
                    <a href="{{ route('user.orders.index') }}" class="ti-angle-left btn-back">
                        <span class="btn-back">BACK</span>
                    </a>
                </div>
                <div class="order-info">
                    <span class="order-id">ORDER ID. {{ $orderDetails->id }}</span>
                    <span>|</span>
                    <span class="status">order {{ $orderDetails->status_label }}</span>
                </div>
            </div>
        </div>
        <div class="stepper" id="{{ $orderDetails->status }}">
            <div class="stepper__step">
                <div class="stepper__step-icon ti-receipt stepper__step-icon-success"></div>
                <div class="stepper__step-text pending">order pending</div>
            </div>
            @if ($orderDetails->status != 4)
                <div class="stepper__step">
                    <div class="stepper__step-icon ti-check"></div>
                    <div class="stepper__step-text confirmed">order confirmed</div>
                </div>
                <div class="stepper__step">
                    <div class="stepper__step-icon ti-truck"></div>
                    <div class="stepper__step-text delivering">order delivering</div>
                </div>
                <div class="stepper__step">
                    <div class="stepper__step-icon ti-package"></div>
                    <div class="stepper__step-text delivered">order delivered</div>
                </div>
            @else
                <div class="stepper__step">
                    <div class="stepper__step-icon ti-na stepper__step-icon-success"></div>
                    <div class="stepper__step-text cancelled">order cancelled</div>
                </div>
            @endif
            <div class="stepper__line">
                <div class="stepper__line-background"></div>
                <div class="stepper__line-foreground"></div>
            </div>
        </div>
        <div class="line-background"></div>
        <div class="content-order">
            <div class="custom-title-order">Delivery Address</div>
            <div class="order-detail">
                <div class="name">{{ $orderDetails->fullname }}</div>
                <div class="phone">Phone: {{ $orderDetails->phone }}</div>
                <div class="address">Address: {{ $orderDetails->address }}</div>
            </div>
            <table class="table-product-order">
                <thead>
                    <tr class="table-header">
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Discount</th>
                        <th>Provisional</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @php
                        $totalBillAmount = 0;
                    @endphp
                    @foreach ($orderDetails->orderProducts as $order)
                        @php
                            $images = json_decode($order->product->image);
                        @endphp
                        <tr>
                            <td>
                                <div class="product-item">
                                    <img src="{{ asset('storage/products/' . $images[0]) }}">
                                    <div class="product-info">
                                        <a class="product-name"
                                            href="{{ route('products.show', ['id' => $order->product_id]) }}">{{ $order->product->name }}</a>
                                    </div>
                                </div>
                            </td>
                            <td>${{ $order->product->price }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->discount }}%</td>
                            @php
                                $total = 0;
                                $total = $order->product->price * $order->quantity - ($order->product->price * $order->quantity * $order->discount) / 100;
                                $totalBillAmount += $total;
                            @endphp
                            <td>${{ $total }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="order-total">Order Total</td>
                        <td class="total-bill-amount">${{ $totalBillAmount }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
