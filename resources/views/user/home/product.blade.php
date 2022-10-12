@extends('user.home.partials.app')
@section('content')
    <div class="product-area section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-info">
                        <div class="nav-main">
                            <!-- Tab Nav -->
                            @if (Request::route('category'))
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <x-category type="categoryProduct" />
                                </ul>
                            @else
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <x-brand />
                                </ul>
                            @endif
                            <!--/ End Tab Nav -->

                            <ul class="nav nav-tabs">
                                <select name="sort_product" class="form-control select2 sort-product" onchange="sortChange(this)">
                                    <option selected disabled>---- Choose sort ----</option>
                                    <option value="asc">Price: low to high</option>
                                    <option value="desc">Price: hight to low</option>
                                </select>
                            </ul>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <!-- Start Single Tab -->
                            <div class="tab-pane fade show active" id="man" role="tabpanel">
                                <div class="tab-single">
                                    <div class="row" id="sort-product">
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
            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {{ $products->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var query = <?php echo json_encode((object) Request::query()); ?>;
        function sortChange(obj) {
            var sort = obj.value;
            Object.assign(query, {
                arrange : sort
            });
            window.location.href = "{{ route('products.index') }}?" + $.param(query);
        }
    </script>
@endsection
