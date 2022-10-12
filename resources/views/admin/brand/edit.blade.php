@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-7">
            <form method="POST" action="{{ route('admin.brands.update', ['brand' => $brand->id]) }}">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') ? old('name') : $brand->name }}" />
                </div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary">Update Brand</button>
            </form>
        </div>
    </div>
</div>
@endsection
