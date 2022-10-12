@extends('user.layouts.app')
@section('content')
    <div class="container-xl px-4 mt-4">
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">Discount Details</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.discounts.update', ['id' => $discount->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row gx-3 mb-3">
                                <div class="col-md-4">
                                    <label class="small mb-1" for="inputUsername">Discount Name</label>
                                    <input class="form-control" id="inputUsername" type="text" name="name"
                                        value="{{ $discount->name }}">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="status">Status : {{ $discount->status }}</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="0">Active</option>
                                        <option value="1">Expired</option>
                                        <option value="2">Scheduled</option>
                                    </select>
                                    @error('status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputEmail">From :
                                        {{ $discount->from_label }}</label>
                                    <input class="form-control" type="date" name="from" value="">
                                    @error('from')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhoneNumber">To :
                                        {{ $discount->to_label }}</label>
                                    <input class="form-control" type="date" name="to" value="">
                                    @error('to')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Save changes" />
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
