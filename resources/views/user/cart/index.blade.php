@extends('user.layouts.app')
@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Shopping Summery -->
                    <table class="table shopping-summery">
                        <thead>
                            <tr class="main-hading">
                                <th>PRODUCT</th>
                                <th>NAME</th>
                                <th class="text-center">UNIT PRICE</th>
                                <th class="text-center">QUANTITY</th>
                                <th class="text-center">TOTAL</th>
                                <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalCart = 0;
                            @endphp
                            @foreach ($products as $product)
                                <tr>
                                    @php
                                        $images = json_decode($product->image);
                                        $sum = $product->price * $product->quantity;
                                        $totalCart += $sum;
                                    @endphp
                                    <td class="image" data-title="No"><img
                                            src="{{ asset('storage/products/' . $images[0]) }}" alt="#"></td>
                                    <td class="product-des" data-title="Description">
                                        <p class="productId">{{ $product->id }}</p>
                                        <p class="product-name">{{ $product->name }}</p>
                                        <p class="product-des">{{ $product->description }}</p>
                                    </td>
                                    <td class="price" data-title="Price">
                                        <span class="productPrice">{{ $product->price }}</span>
                                    </td>
                                    <td class="qty" data-title="Qty">
                                        <!-- Input Order -->
                                        <div class="input-group">
                                            <div class="button minus">
                                                <button route="{{ route('cart.update') }}"
                                                    class="btn btn-primary btn-number down" data-type="minus">
                                                    <i class="ti-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="input-number quantity" data-min="1" data-max="100"
                                                value="@php echo $product->quantity; @endphp">
                                            <div class="button plus">
                                                <button route="{{ route('cart.update') }}"
                                                    class="btn btn-primary btn-number up" data-type="plus">
                                                    <i class="ti-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <!--/ End Input Order -->
                                    </td>
                                    <td class="total-amount" data-title="Total">
                                        <span class="totalCart">{{ $sum }}</span>
                                    </td>
                                    <td class="action" data-title="Remove"><i class="ti-trash remove-icon delete"
                                            route="{{ route('cart.update') }}"></i></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!--/ End Shopping Summery -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Total Amount -->
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-5 col-12">
                                <div class="left">
                                    <div class="coupon">
                                        <form action="{{ route('cart.coupon') }}" method="GET">
                                            <input name="coupon" placeholder="Enter Your Coupon" type="text">
                                            <button type="submit" class="btn">Apply</button>
                                        </form>
                                    </div>
                                    <div class="checkbox">
                                        <label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox">
                                            Shipping (+10$)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-7 col-12">
                                <div class="right">
                                    <ul>
                                        <li>Cart Subtotal<span class="subTotal">{{ $totalCart }}</span></li>
                                        <li>Shipping<span>Free</span></li>
                                        <li>You Save<span>$0</span></li>
                                        <li class="last">You Pay<span></span></li>
                                    </ul>
                                    <div>
                                        <a href="{{ route('cart.checkout') }}" class="btn">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total Amount -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Shopping Cart -->
@endsection
