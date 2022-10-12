@extends('user.layouts.app')
@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="search-filter">
        <div class="search-filter_item">
            <input type="text" id="search" placeholder="Enter name" name="search"
                value="{{ Request::has('search') ? Request::query('search') : '' }}">
        </div>
        <div class="search-filter_item">
            <select name="filter_quantity" id="filter_category" class="form-control search-filter_select">
                <option hidden>---- Choose category ----</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ Request::query('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="search-filter_item">
            <select name="filter_quantity" id="filter_brand" class="form-control search-filter_select">
                <option hidden>---- Choose brand ----</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" {{ Request::query('brand') == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="search-filter_item">
            <select name="filter_quantity" id="filter_quantity" class="form-control search-filter_select"
                route="{{ route('user.products.index') }}">
                <option selected disabled>---- Choose filter ----</option>
                <option value="1-20" {{ Request::query('quantity') == '1-20' ? 'selected' : '' }}> 1-20 </option>
                <option value="21-100" {{ Request::query('quantity') == '21-100' ? 'selected' : '' }}> 21-100 </option>
            </select>
        </div>
        <div class="search-filter_item">
            <button onclick="search()" class="btn btn-primary">Search</button>
        </div>
    </div>
    <table class="table table-striped table-product">
        <thead>
            <tr>
                <th>
                    Name
                    <div class="btn-group-vertical">
                        <a data-type="name-asc" class=" btn-xs btn-link sort p-0">
                            <i class="fas fa-sort-up"></i>
                        </a>
                        <a data-type="name-desc" class=" btn-xs btn-link sort p-0">
                            <i class="fas fa-sort-down"></i>
                        </a>
                    </div>
                </th>
                <th>
                    Price
                    <div class="btn-group-vertical">
                        <a data-type="price-asc" class=" btn-xs btn-link sort p-0">
                            <i class="fas fa-sort-up"></i>
                        </a>
                        <a data-type="price-desc" class=" btn-xs btn-link sort p-0">
                            <i class="fas fa-sort-down"></i>
                        </a>
                    </div>
                </th>
                <th>Category</th>
                <th>Brand</th>
                <th>Description</th>
                <th>
                    Quantity
                    <div class="btn-group-vertical">
                        <a data-type="quantity-asc" class=" btn-xs btn-link sort p-0">
                            <i class="fas fa-sort-up"></i>
                        </a>
                        <a data-type="quantity-desc" class=" btn-xs btn-link sort p-0">
                            <i class="fas fa-sort-down"></i>
                        </a>
                    </div>
                </th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->brand->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td class="d-flex flex-row">
                        <div class="p-2">
                            <a href="{{ route('user.products.edit', ['id' => $product->id]) }}">
                                <button class="btn btn-primary">Edit</button></a>
                        </div>
                        <div class="p-2">
                            <form action="{{ route('user.products.destroy', ['id' => $product->id]) }}" method="post">
                                {{ csrf_field() }}
                                @method('delete')
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <td colspan="8">
                <a href="{{ route('user.products.create') }}"><button class="btn btn-primary">Add product</button></a>
            </td>
        </tfoot>
    </table>
    <div>
        {{ $products->appends(Request::except('page'))->links() }}
    </div>

@endsection
@section('js')
    <script>
        var query = <?php echo json_encode((object) Request::only(['search', 'arrange', 'quantity', 'category', 'brand'])); ?>;
        $('.sort').click(function() {
            Object.assign(query, {
                arrange: $(this).data('type')
            });
            window.location.href = "{{ route('user.products.index') }}?" + $.param(query);
        })
        $("#filter_quantity").change(function() {
            Object.assign(query, {
                quantity: $(this).children("option:selected").val()
            });
        });
        $("#filter_category").change(function() {
            Object.assign(query, {
                category: $(this).children("option:selected").val()
            });
        });
        $("#filter_brand").change(function() {
            let filter = $(this).children("option:selected").val();
            Object.assign(query, {
                brand: filter
            });
        });

        function search() {
            let search = $('#search').val();
            if (search != '') {
                Object.assign(query, {
                    search: $('#search').val()
                });
            }
            window.location.href = "{{ route('user.products.index') }}?" + $.param(query);
        }
    </script>
@endsection
