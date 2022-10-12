@extends('user.layouts.app')
@section('content')
    <div class="container-xl px-4 mt-4">
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">Discount Details</div>
                    <div class="card-body">
                        <div class="row gx-3 mb-3">
                            <div class="col-md-3">
                                <div class="text-center px-xl-3">
                                    <a href="{{ route('user.discounts.createNewCode', ['id' => $discount->id]) }}">
                                        <button class="btn btn-success btn-block" type="button" data-toggle="modal">New Code</button></a>
                                </div>
                            </div>
                            @if ($discount->status == '0')
                                <div class="col-md-4">
                                    <div class="text-center px-xl-3">
                                        <a href="{{ route('user.discounts.sendCouponViaEmail', ['id' => $discount->id]) }}">
                                            <button class="btn btn-success btn-block" type="button" data-toggle="modal">Send Coupon For Users</button></a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-3">
                                <label class="small mb-1" for="inputUsername">Discount Name</label>
                                <input class="form-control" id="inputUsername" type="text" name="code"
                                    value="{{ $discount->name }}">
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1" for="inputEmail">From</label>
                                <input class="form-control" type="text" name="from"
                                    value="{{ $discount->from_label }}">
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1" for="inputPhoneNumber">To</label>
                                <input class="form-control" type="text" name="to" step=1
                                    value="{{ $discount->to_label }}">
                            </div>
                            <div class="col-md-3">
                                <label class="small mb-1" for="inputLocation">Status</label>
                                <input class="form-control" id="inputLocation" type="text" name="status"
                                    value="{{ $discount->status }}">
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="table-responsive table-lg mt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="max-width">Code</th>
                                            <th class="sortable">Rate</th>
                                            <th class="sortable">Product name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($discountProducts as $key => $discountProduct)
                                            <tr>
                                                <td class="text-nowrap align-middle">{{ $discountProduct->code }}</td>
                                                <td class="text-nowrap align-middle">
                                                    <span>{{ $discountProduct->rate }}</span>
                                                </td>
                                                <td class="text-nowrap align-middle">
                                                    <span>{{ $discountProduct->product->name }}</span>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <form action="{{ route('user.discounts.destroyDiscountProduct',
                                                     ['id' => $discount->id, 'discountProductId' => $discountProduct->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="delete">
                                                            <i class="fas fa-trash fa-lg text-danger"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {!! $discountProducts->links('pagination::bootstrap-4') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/user/css/profile-user.css') }}">
    @endpush
@endsection
