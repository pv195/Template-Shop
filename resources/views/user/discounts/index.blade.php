@extends('user.layouts.app')
@section('content')
    <div class="container">
        <div class="row flex-lg-nowrap">
            <div class="col">
                <div class="row flex-lg-nowrap">
                    <div class="col mb-3">
                        <div class="e-panel card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h6 class="mr-2"><span>Discount</span></h6>
                                </div>
                                <div class="e-table">
                                    <div class="table-responsive table-lg mt-3">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="max-width">Name</th>
                                                    <th class="sortable">From</th>
                                                    <th class="sortable">To</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($discounts as $key => $discount)
                                                    <tr>
                                                        <td class="text-nowrap align-middle">{{ $discount->name }}</td>
                                                        <td class="text-nowrap align-middle">
                                                            <span>{{ $discount->from_label }}</span>
                                                        </td>
                                                        <td class="text-nowrap align-middle">
                                                            <span>{{ $discount->to_label }}</span>
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            <span>{{ $discount->status }}</span>
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            <a href="{{ route('user.discounts.show', ['id' => $discount->id]) }}" title="show">
                                                                <i class="fas fa-eye text-success fa-lg"></i>
                                                            </a>
                                                            <a href="{{ route('user.discounts.edit', ['id' => $discount->id]) }}">
                                                                <i class="fas fa-edit fa-lg"></i>
                                                            </a>
                                                            <form action="{{ route('user.discounts.destroyDiscount', ['id' => $discount->id]) }}" method="POST">
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
                                        {!! $discounts->links('pagination::bootstrap-4') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center px-xl-3">
                                    <button class="btn btn-success btn-block" type="button" data-toggle="modal"
                                        data-target="#modalNewDiscount">New Discount</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalNewDiscount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="container-xl px-4 mt-4">
                        <hr class="mt-0 mb-4">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">Discount Details</div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('user.discounts.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row gx-3 mb-3">
                                                <div class="col-md-4">
                                                    <label class="small mb-1" for="inputUsername">Discount Name</label>
                                                    <input class="form-control" id="inputUsername" type="text" name="name">
                                                    @error('name')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="small mb-1" for="status">Status</label>
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
                                                    <label class="small mb-1" for="inputEmail">From</label>
                                                    <input class="form-control" type="date" name="from">
                                                    @error('from')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputPhoneNumber">To</label>
                                                    <input class="form-control" type="date" name="to">
                                                    @error('to')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-primary" value="Create new discount" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
