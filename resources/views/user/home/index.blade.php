@extends('user.layouts.app')
@section('content')
    <!-- Slider Area -->
    <section class="hero-slider">
        <div class="single-slider">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-9 offset-lg-3 col-12">
                        <div class="text-inner">
                            <div class="row">
                                <div class="col-lg-7 col-12">
                                    <div class="hero-text">
                                        <h1><span style="color: rgb(190, 138, 138);">UP TO 50% OFF </span>Shirt For Man</h1>
                                        <h3 class="text-sup" style="color: rgb(190, 138, 138); ">SupremeTech Eshop <br> You can buy anything</h3>
                                        <div class="button">
                                            <a href="{{ route('products.index') }}" class="btn">Shop Now!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="small-banner section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-banner">
                        <img src="{{ asset('assets/user/images/mini-banner1.jpg') }}" alt="#">
                        <div class="content">
                            <p>Man's Collectons</p>
                            <h3>Summer travel <br> collection</h3>
                            <a href="#">Discover Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-banner">
                        <img src="{{ asset('assets/user/images/mini-banner2.jpg') }}" alt="#">
                        <div class="content">
                            <p>Bag Collectons</p>
                            <h3>Awesome Bag <br> 2020</h3>
                            <a href="#">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="single-banner tab-height">
                        <img src="{{ asset('assets/user/images/mini-banner3.jpg') }}" alt="#">
                        <div class="content">
                            <p>Flash Sale</p>
                            <h3>Mid Season <br> Up to <span>40%</span> Off</h3>
                            <a href="#">Discover Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="product-area section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>New Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-info">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="man" role="tabpanel">
                                <div class="tab-single">
                                    <div class="row">
                                        @foreach ($products as $key => $product)
                                            <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                                                @php
                                                    $images = json_decode($products[$key]->image);
                                                @endphp
                                                <div class="single-product">
                                                    <div class="product-img">
                                                        <a href="{{ route('products.show', ['id' => $product->id]) }}">
                                                            <img class="default-img"
                                                                src="{{ asset('storage/products/' . $images[0]) }}"
                                                                alt="#">
                                                            <img class="hover-img"
                                                                src="{{ asset('storage/products/' . $images[1]) }}"
                                                                alt="#">
                                                        </a>
                                                        <div class="button-head">
                                                            <div class="product-action-2">
                                                                <a title="Add to cart" id="add"
                                                                    route="{{ route('cart.store') }}">Add to cart</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-content">
                                                        <h3><a href="product-details.html">{{ $product->name }}</a></h3>
                                                        <div class="product-price">
                                                            <span>${{ $product->price }}</span>
                                                            <p id="idProduct" hidden>{{ $product->id }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="midium-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="single-banner">
                        <img src="{{ asset('assets/user/images/mini-banner1.jpg') }}" alt="#">
                        <div class="content">
                            <p>Man's Collectons</p>
                            <h3>Man's items <br>Up to<span> 50%</span></h3>
                            <a href="#">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="single-banner">
                        <img src="{{ asset('assets/user/images/mini-banner2.jpg') }}" alt="#">
                        <div class="content">
                            <p>shoes women</p>
                            <h3>mid season <br> up to <span>70%</span></h3>
                            <a href="#" class="btn">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Midium Banner -->
@endsection
