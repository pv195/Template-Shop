@extends('user.layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/rate/css/rate.css') }}">
@endpush
@section('content')
    <!-- Start Detail Product -->
    <section class="blog-single section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="blog-single-main">
                        <div class="row">
                            <div class="col-12">
                                <div class="image">
                                    @foreach ($product->image as $item)
                                        <img class="img-detail-product" src="{{ asset('storage/products/' . $item) }}"
                                            alt="#">
                                    @endforeach
                                </div>
                                <div class="blog-detail">
                                    <h2 class="blog-title">{{ $product->name }} - ${{ $product->price }}</h2>
                                    <div class="rate">
                                        <div class="vote"
                                            route="{{ route('products.rate', ['id' => $product->id]) }}"
                                            id="{{ $product->id }}">
                                            @for ($i = 1; $i < 6; $i++)
                                                @php
                                                    $ratings_over = '';
                                                    if ($i <= $avgRate) {
                                                        $ratings_over = 'ratings_over';
                                                    }
                                                @endphp
                                                <div value_rate="{{ $i }}"
                                                    class="star_{{ $i }} ratings_stars {{ $ratings_over }}">
                                                </div>
                                            @endfor
                                            <span class="rate-np">{{ $avgRate }}</span>
                                        </div>
                                        <input id="authenticated" type="hidden" value="{{ Auth()->check() }}">
                                    </div>
                                    <div class="blog-meta">
                                        <span class="author">
                                            <a href="#">
                                                <i class="fa fa-user"></i>{{ $productSeller->name }}</a>
                                            <a href="#"><i class="fa fa-calendar"></i>{{ $product->created_at }}</a>
                                            <a href="#"><i class="fa fa-comments"></i>Comment
                                                ({{ count($product->comments) }})
                                            </a>
                                        </span>
                                    </div>
                                    <div class="content">
                                        <blockquote>
                                            <i class="fa fa-quote-left"></i>{{ $product->description }}
                                        </blockquote>
                                    </div>
                                    <a title="Add to cart" class="btn btn-success" id="addCart"
                                        route="{{ route('cart.store') }}"> <i class="fa fa-shopping-cart"></i>
                                        Add to cart
                                    </a>
                                    <p id="idProduct" hidden>{{ $product->id }}</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="comments">
                                    <h3 class="comment-title">Comment ({{ count($product->comments) }})</h3>
                                    @if (Session::has('success'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if (Session::has('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    @foreach ($parentComments as $item)
                                        @if ($item->parent_id == 0)
                                            <div class="single-comment">
                                                <img src="{{ asset('storage/users/' . $item->user->image) }}" alt="#">
                                                <div class="content">
                                                    <h4>{{ $item->user->name }}
                                                        <span>At {{ $item->created_at }}</span>
                                                    </h4>
                                                    @if (Auth::id() == $item->user_id)
                                                        <span class="action-comment"><i class="fas fa-ellipsis-h"></i>
                                                            <div class="action-option">
                                                                <ul>
                                                                    <li class="edit-parent-comment">Edit</li>
                                                                    <input type="hidden" id="productId" value={{ $item->id }}>
                                                                    <form action="{{ route('products.comments.destroy', ['id' => $item->id]) }}" method="post">
                                                                        {{ csrf_field() }}
                                                                        @method('delete')
                                                                        <input type="hidden" name="userId" value={{ Auth::id() }}>
                                                                        <button type="submit" class="li-delete">
                                                                            <li>Delete</li>
                                                                        </button>
                                                                    </form>
                                                                </ul>
                                                            </div>
                                                        </span>
                                                    @endif
                                                    <p id="{{ $item->id }}" class="parent-comment">
                                                        {{ $item->content }}</p>
                                                    <div id="form-{{ $item->id }}" class="form-parent-edit">
                                                        <form method="POST" action="{{ route('products.comments.update', ['id' => $item->id]) }}">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input class="text-comment" name="content" value="{{ $item->content }}">
                                                            <input type="hidden" name="userId" value={{ Auth::id() }}>
                                                            <span class="comment-parent-save">
                                                                <input type="submit" value="SAVE">
                                                            </span>
                                                        </form>
                                                        <span class="cancel-parent-comment">
                                                            <button class="cancel-parent-comment">CANCEL</button>
                                                        </span>
                                                    </div>
                                                    <div class="button">
                                                        <input type="hidden" id="userName"
                                                            value="{{ $item->user->name }}" />
                                                        <input type="hidden" id="parentId" value="{{ $item->id }}" />
                                                        <a id="replyButton" class="btn">
                                                            <i class="fa fa-reply" aria-hidden="true"></i>Reply
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @foreach ($replyComments as $replyItem)
                                            @if ($replyItem->parent_id == $item->id)
                                                <!-- Single Comment -->
                                                <div class="single-comment left">
                                                    <img src="{{ asset('storage/users/' . $replyItem->user->image) }}" alt="#">
                                                    <div class="content">
                                                        <h4>{{ $replyItem->user->name }}
                                                            <span>At {{ $replyItem->created_at }}</span>
                                                        </h4>
                                                        @if (Auth::id() == $replyItem->user_id)
                                                            <span class="action-comment"><i class="fas fa-ellipsis-h"></i>
                                                                <div class="action-option">
                                                                    <ul>
                                                                        <li class="edit-comment">Edit</li>
                                                                        <input type="hidden" id="productId"
                                                                            value={{ $replyItem->id }}>
                                                                        <form
                                                                            action="{{ route('products.comments.destroy', ['id' => $replyItem->id]) }}"
                                                                            method="post">
                                                                            {{ csrf_field() }}
                                                                            @method('delete')
                                                                            <input type="hidden" name="userId" value={{ Auth::id() }}>
                                                                            <button type="submit" class="li-delete">
                                                                                <li>Delete</li>
                                                                            </button>
                                                                        </form>
                                                                    </ul>
                                                                </div>
                                                            </span>
                                                        @endif
                                                        <p id="{{ $replyItem->id }}" class="child-comment">
                                                            {{ $replyItem->content }}</p>
                                                        <div id="form-{{ $replyItem->id }}" class="form-parent-edit">
                                                            <form method="POST"
                                                                action="{{ route('products.comments.update', ['id' => $replyItem->id]) }}">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input class="text-rpl-comment" name="content"
                                                                    value="{{ $replyItem->content }}">
                                                                <input type="hidden" name="userId" value={{ Auth::id() }}>
                                                                <span class="comment-save">
                                                                    <input type="submit" value="SAVE">
                                                                </span>
                                                            </form>
                                                            <span class="cancel-comment">
                                                                <button class="cancel-rpl-comment">CANCEL</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Single Comment -->
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="reply">
                                    <div class="reply-head">
                                        <div class="row">
                                            @if (Auth::check())
                                                <div class="col-12">
                                                    <h2 class="reply-title">New Comment</h2>
                                                    <form class="form" method="POST"
                                                        action="{{ route('products.comments.store') }}">
                                                        @csrf
                                                        <div class="form-group">
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $product->id }}" />
                                                            <input type="hidden" id="parent_id" name="parent_id"
                                                                value="0" />
                                                            <input type="hidden" name="user_id"
                                                                value="{{ Auth::id() }}" />
                                                            <textarea name="content"
                                                                placeholder="Write your comment!!!"></textarea>
                                                            @error('content')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group button">
                                                                <button type="submit" class="btn">Post
                                                                    comment</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            @else
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <textarea name="content" readonly
                                                            placeholder="Please login to comment!!!"></textarea>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                {{ $parentComments->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="main-sidebar">
                        <!--/ End Single Widget -->
                        <div class="single-widget category">
                            <h3 class="title">Categories</h3>
                            <ul class="categor-list">
                                @foreach ($categories as $category)
                                    <li>
                                        <a
                                            href="{{ route('home.category', ['id' => $category->id]) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="single-widget category">
                            <h3 class="title">Brands</h3>
                            <ul class="categor-list">
                                @foreach ($brands as $brand)
                                    <li>
                                        <a
                                            href="{{ route('home.brand', ['id' => $brand->id]) }}">{{ $brand->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Detail Product -->
@endsection
@section('js')
    <script src="{{ asset('assets/user/js/detail-product.js') }}"></script>
    @include('user.layouts.i18n')
    <script src="{{ asset('assets/rate/js/jquery-1.9.1.min.js') }}"></script>
    <script src="{{ asset('assets/rate/js/rate.js') }}"></script>
@endsection
