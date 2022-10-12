@if ($orders->isEmpty())
    <tr>
        <td colspan="6">
            <img class="custom-image" src="{{ asset('assets/user/images/no-order.png') }}" alt="">
            <p class="no-order">No order yet</p>
        </td>
    </tr>
@endif
@foreach ($orders as $order)
    <tr class="custom_row">
        <td>{{ $order->id }}</td>
        <td>{{ $order->fullname }}</td>
        <td>{{ $order->phone }}</td>
        <td>{{ $order->address }}</td>
        @if ($order->status == 4)
            <td><span class="manager-status cancel">{{ $order->status_label }}</span></td>
        @else
            <td><span class="manager-status">{{ $order->status_label }}</span></td>
        @endif
        <td>{{ $order->note }}</td>
        <td style="justify-content: space-evenly;display: flex;">
            @if ($order->status == 0 || $order->status == 1 || $order->status == 2)
                <form action="{{ route('user.orders-management.update', ['id' => $order->id, 'status' => $order->status]) }}"
                    method="POST">
                    {{ csrf_field() }}
                    @method('PATCH')
                    <button type="submit" class="btn btn-success ti-check"></button>
                </form>
            @endif
            @if ($order->status == 4)
                <form action="{{ route('user.orders-management.update', ['id' => $order->id, 'status' => $order->status]) }}"
                    method="POST">
                    {{ csrf_field() }}
                    @method('PATCH')
                    <button type="submit" class="btn btn-warning ti-back-left"
                        onclick="return confirm('Are you want restore this order ?')">
                    </button>
                </form>
            @endif
            @if ($order->status == 0)
                <form action="{{ route('user.orders-management.destroy', ['id' => $order->id]) }}" method="POST">
                    {{ csrf_field() }}
                    @method('PATCH')
                    <button type="submit" class="btn btn-danger ti-trash"
                        onclick="return confirm('Are you want cancel this order ?')">
                    </button>
                </form>
            @endif
            <button data-toggle="modal" data-target="#ModalDetail" data-id="{{ $order->id }}"
                route="{{ route('user.orders-management.show', ['id' => $order->id]) }}"
                class="btn btn-primary ti-eye orderDetail"></button>
        </td>
    </tr>
@endforeach
<script src="{{ asset('assets/user/js/order-management.js') }}"></script>
