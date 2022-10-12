@foreach ($brands as $brand)
    <li class="nav-item"><a class="{{ Request::route('id') == $brand->id ? 'nav-link active' : '' }}"
        href="{{ route('home.brand', ['id' => $brand->id]) }}">{{ $brand->name }}</a>
    </li>
@endforeach
