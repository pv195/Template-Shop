@if ($orderLists->isEmpty())
    <tr>
        <td colspan="5">
            <img class="img-no-order" src="{{ asset('assets/user/images/no-order.png') }}">
            <p class="text-no-order">No orders yet</p>
        </td>
    </tr>
@endif
@foreach ($orderLists as $order)
    <tr>
        <td>{{ $order->id }}</td>
        <td>{{ $order->fullname }}</td>
        <td>{{ $order->created_at_label }}</td>
        <td>
            @if ($order->status != 4)
                <div class="status">{{ $order->status_label }}</div>
            @else
                <div class="status status-cancel ">{{ $order->status_label }}</div>
            @endif
        </td>
        <td style="display: flex; justify-content: space-evenly">
            <a href="{{ route('user.orders.show', ['id' => $order->id]) }}">
                <button class="ti-eye btn btn-success btn-custom"></button>
            </a>
            @if ($order->status == 0)
                <form onsubmit="return confirm('Are you sure you want to cancel this order?')"
                    action="{{ route('user.orders.update', ['id' => $order->id]) }}" method="POST">
                    {{ csrf_field() }}
                    @method('PATCH')
                    <button type="submit" class="ti-na btn btn-danger btn-custom"></button>
                </form>
            @endif
        </td>
    </tr>
@endforeach
