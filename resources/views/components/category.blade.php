@foreach ($categories as $category)
    <li class="{{ $typeClass() }}"><a class="{{ Request::route('id') == $category->id ? 'nav-link active' : '' }}"
        href="{{ route('home.category', ['id' => $category->id]) }}">{{ $category->name }}</a>
    </li>
@endforeach
