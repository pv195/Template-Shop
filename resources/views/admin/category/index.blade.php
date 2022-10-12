@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-8">
                        <h6 class="m-0 font-weight-bold text-primary">Category</h6>
                    </div>
                    <div class="col-4">
                        <a href="{{ route('admin.categories.create') }}"><button class="btn btn-primary">Add
                                category</button></a>
                    </div>
                </div>
                <div class="row">
                    @if (session('msg'))
                        <div class="alert alert-success">
                            {{ session('msg') }}
                        </div>
                    @endif
                    @if (session('fail'))
                        <div class="alert alert-danger">
                            {{ session('fail') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <form method="GET" action="{{ route('admin.categories.index') }}"
                                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control bg-light border-1 small"
                                        placeholder="Search ..." value="@isset($search){{ $search }}@endisset">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row" id="categoryTable">
                                <div class="col-sm-12">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr role="row">
                                                <th>Name
                                                    <div class="btn-group-vertical">
                                                        <a data-sort="asc" class="btn btn-xs btn-link sort-search p-0 m-0">
                                                            <i class="fas fa-sort-up"></i>
                                                        </a>
                                                        <a data-sort="desc" class="btn btn-xs btn-link sort-search p-0 m-0">
                                                            <i class="fas fa-sort-down"></i>
                                                        </a>
                                                    </div>
                                                </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td>{{ $category->name }}</td>
                                                    <td class="d-flex justify-content-right">
                                                        <a
                                                            href="{{ route('admin.categories.edit', ['category' => $category->id]) }}">
                                                            <button class="btn btn-success">Edit</button></a>
                                                        <form onsubmit="return confirm(trans('messages.delete.category'))"
                                                            action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-12">
                                    {{ $categories->appends(Request::except('page'))->links('pagination::bootstrap-4') }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@section('js')
    @include('admin.layouts.i18n')
    <script>
        var query = <?php echo json_encode((object) Request::only(['search', 'sort'])); ?>;

        $('.sort-search').click(function() {
            var sort = $(this).attr('data-sort');
            console.log(sort);
            Object.assign(query, {
                sort: sort
            });
            window.location.href = "{{ route('admin.categories.index') }}?" + $.param(query);
        })
    </script>
@endsection
