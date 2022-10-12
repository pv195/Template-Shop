@extends('admin.layouts.app')
@section('content')
    <form id="search" action="{{ route('admin.users.index') }}" method="GET"
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div>
            <p class="h2">Search Users</p>
        </div>
        <div class="input-group">
            <input name="search" type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
    <table class="table table-striped">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <thead>
            <tr>
                <th>
                    Name
                    <div class="btn-group-vertical">
                        <a data-sort="asc" class="btn btn-xs btn-link sort-search p-0 m-0">
                            <i class="fas fa-sort-up"></i>
                        </a>
                        <a data-sort="desc" class="btn btn-xs btn-link sort-search p-0 m-0">
                            <i class="fas fa-sort-down"></i>
                        </a>
                    </div>
                </th>
                <th>
                    Image
                </th>
                <th>
                    Email
                </th>
                <th>
                    Phone
                </th>
                <th>
                    Address
                </th>
                <th>
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $key => $user)
                <tr role="row">
                    <td>{{ $user->name }}</td>
                    <td><img src="{{ asset('storage/users/' . $user->image) }}" /></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->address }}</td>
                    <td style="display: flex;">
                        <form action="{{ route('admin.users.destroy', ['id' => $user->id]) }}" method="post">
                            {{ csrf_field() }}
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <td colspan="8">
                <a href="{{ route('admin.users.create') }}"><button class="btn btn-primary">Add User</button></a>
                {!! $users->appends(Request::except('page'))->links() !!}
            </td>
        </tfoot>
    </table>
@endsection
@section('js')
    @include('admin.layouts.i18n')
    <script>
        var query = <?php echo json_encode((object) Request::only(['search','sort'])); ?>;

        $('.sort-search').click(function()
        {
            var sort = $(this).attr('data-sort');
            console.log(sort);
            Object.assign(query, {
                sort: sort
            });
            window.location.href = "{{ route('admin.users.index') }}?" + $.param(query);
        })
    </script>
@endsection
