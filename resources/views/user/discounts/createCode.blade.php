@extends('user.layouts.app')
@section('content')
    <div class="container-xl px-4 mt-4">
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">Create new code for discount</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.discounts.storeNewCode', ['id' => $discount->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row gx-3 mb-3">
                                <div class="col-md-3">
                                    <label class="small mb-1" for="inputUsername">Code</label>
                                    <input class="form-control" id="inputUsername" type="text" name="code">
                                </div>
                                <div class="col-md-2">
                                    <label class="small mb-1" for="inputDiscountProductId">DiscountProductId</label>
                                    <input class="form-control" id="inputDiscountProductId" type="text" name="discount_id"
                                        value="{{ $discount->id }}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label class="small mb-1" for="inputEmail">Rate</label>
                                    <input class="form-control" type="number" name="rate">
                                </div>
                                <div class="col-md-3">
                                    <label class="small mb-1" for="inputPhoneNumber">Product Name</label>
                                    <select class="form-control" name="product_id">
                                        <option value="">Please Select</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" class="btn btn-primary" value="Create new code" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/user/css/profile-user.css') }}">
    @endpush
@endsection
