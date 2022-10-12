@extends('/admin.layouts.app')
@section('content')
    <form method="POST" action="{{route('admin.users.store')}}" style="margin-left: 40%" enctype="multipart/form-data">
        @csrf
        <div class="col-6">
            <label for="exampleFormControlInput1" class="form-label">ID</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="id" value=""
                readonly />
        </div>
        <div class="col-6">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="name"
                value="" />
            @error('name')
                <div class="alert alert-danger">{{ $message}}</div>
            @enderror
        </div>
        <div class="col-6">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" name="email"
                value="" />
            @error('email')
                <div class = "alert alert-danger">{{ $message}}</div>
            @enderror
        </div>
        <div class="col-6">
            <label for="exampleFormControlInput1" class="form-label">Image</label>
            <input type="file" name="image" accept="image/*" class="form-control" id="exampleFormControlInput1" 
                value="" />
            @error('image')
                <div class = "alert alert-danger">{{ $message}}</div>
            @enderror
        </div>
        <div class="col-6">
            <label for="exampleFormControlInput1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleFormControlInput1" name="password"
                value="" />
            @error('password')
                <div class = "alert alert-danger">{{ $message}}</div>
            @enderror
        </div>
        
        <div class="col-6">
            <label for="exampleFormControlInput1" class="form-label">Phone</label>
            <input type="number" class="form-control" id="exampleFormControlInput1" name="phone"
                value="" />
            @error('phone')
                <div class = "alert alert-danger">{{ $message}}</div>
            @enderror
        </div>
        <div class="col-6">
            <label for="exampleFormControlInput1" class="form-label">Address</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="address"
                value="" />
            @error('address')
                <div class = "alert alert-danger">{{ $message}}</div>
            @enderror
        </div>
        <div class="col-6">
            <label for="exampleFormControlInput1" class="form-label">Role</label>
            <select class="form-control" name="role">
                <option value="2" selected="selected">Operator</option>
            </select>
            @error('role')
                <div class = "alert alert-danger">{{ $message}}</div>
            @enderror
        </div>
        <input type="submit" class="btn btn-success" style="margin: 8% 19%; width: 15%" value="Create" />
    </form>
@endsection
