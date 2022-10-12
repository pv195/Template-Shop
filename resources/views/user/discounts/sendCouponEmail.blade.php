<div class="row gx-3 mb-3">
    <div class="table-responsive table-lg mt-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="max-width">Code</th>
                    <th class="sortable">Rate</th>
                    <th class="sortable">Product name</th>
                    <th class="sortable">Product Price</th>
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
                        <td class="text-nowrap align-middle">
                            <span>{{ $discountProduct->product->price }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
