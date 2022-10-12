<tr>
    <td class="td">Order id</td>
    <td>{{ $order->id }}</td>
</tr>
<tr>
    <td class="td">Product's name</td>
    <td>{{ $order->name }}</td>
</tr>
<tr>
    <td class="td">Quantity</td>
    <td>{{ $order->quantity }}</td>
</tr>
<tr>
    <td class="td">Price</td>
    <td>${{ $order->price }}</td>
</tr>
<tr>
    <td class="td">Discount</td>
    <td>{{ $order->discount }}%</td>
</tr>
<tr>
    <td class="td">Status</td>
    @if ($order->status == 4)
        <td><span class="manager-status cancel">{{ $order->status_label }}</span></td>
    @else
        <td><span class="manager-status">{{ $order->status_label }}</span></td>
    @endif
</tr>
<tr>
    @php
        $image = json_decode($order->image);
    @endphp
    <td class="td">Product's image</td>
    <td>
        <div class="card-img-management">
            <img class="" src="{{ asset('storage/products/' . $image[0]) }}" alt="">
            <img class="img-top" src="{{ asset('storage/products/' . $image[1]) }}" alt="">
        </div>
    </td>
</tr>
<tr>
    <td class="td">Total</td>
    <td class="money">{{ number_format($order->total, 2, '.', '.') }} VND</td>
</tr>
