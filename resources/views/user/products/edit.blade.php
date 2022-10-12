@extends('user.layouts.app')
@section('content')
    <script type="text/javascript">
        /**
         * Show multiple image when choose image
         */
        $(document).ready(function() {
            $('#multiple-image').change(function(event) {
                var files = event.target.files;
                console.log(files);
                var result = $("#showImage");
                result.empty();
                $.each(files, function(i, file) {
                    var imgpath = URL.createObjectURL(file);
                    result.add("<img class='new-image' src='" + imgpath + "'>").appendTo(
                        '#showImage');
                });
            });

            /**
             * remove image when click button remove image
             */
            $('.btn-remove-img').bind('click', function(e) {
                var dataProduct = $(this).data('product');
                var dataIndex = $(this).data('index');
                var img_item = $(this).parent();
                $('#checkbox-image-' + dataProduct + '-' + dataIndex).attr('checked', true);
                console.log($('#checkbox-image-' + dataProduct + '-' + dataIndex));
                img_item.remove()
            });
        });
    </script>
    <!-- Start Contact -->
    <section id="contact-us" class="contact-us section">
        <div class="container">
            <div class="contact-head">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="form-main">
                            <div class="title">
                                <h3>Edit product</h3>
                            </div>
                            @if (Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form class="form" method="post"
                                action="{{ route('user.products.update', ['id' => $product->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Name<span>*</span></label>
                                            <input name="name" value="{{ $product->name }}" type="text">
                                        </div>
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Price<span>*</span>($)</label>
                                            <input name="price" value="{{ $product->price }}" type="text">
                                        </div>
                                        @error('price')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Category<span>*</span></label>
                                            <div>
                                                <select name="category">
                                                    @foreach ($categories as $item)
                                                        <option {{ $product->category_id == $item->id ? 'selected' : '' }}
                                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @error('category')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Brand<span>*</span></label>
                                            <div>
                                                <select name="brand">
                                                    @foreach ($brands as $item)
                                                        <option {{ $product->brand_id == $item->id ? 'selected' : '' }}
                                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @error('brand')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Image<span>*</span></label>
                                            <input id="multiple-image" type="file" name="imageNew[]" multiple="multiple">
                                        </div>
                                        <div id="showImage" class="mt-20">
                                        </div>
                                        @error('imageNew')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        @error('imageNew.*')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @if ($product->image)
                                        <div class="col-12">
                                            <label>Old Image</label>
                                            <table class="table">
                                                <tr>
                                                    @foreach ($product->image as $item)
                                                        <th id="table-old-image">
                                                            <div id="old-img-{{ $product->id }}" class="mt-20">
                                                                <span data-product="{{ $product->id }}"
                                                                    data-index="{{ $loop->index }}" id="span-old-image"
                                                                    class="btn-remove-img btn-link fa fa-times fz-20">
                                                                </span>
                                                                <img class="new-image"
                                                                    src="{{ asset('storage/products/' . $item) }}"
                                                                    alt="">
                                                            </div>
                                                        </th>
                                                    @endforeach
                                                </tr>
                                                <tr id="tr-old-image">
                                                    @foreach ($product->image as $item)
                                                        <td id="table-old-image">
                                                            <input
                                                                id="checkbox-image-{{ $product->id }}-{{ $loop->index }}"
                                                                class="checkbox" name="imageDelete[]" type="checkbox"
                                                                value="{{ $item }}">
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            </table>
                                        </div>
                                    @endif
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Description<span>*</span></label>
                                            <input name="description" value="{{ $product->description }}" type="text"
                                                textarea>
                                        </div>
                                        @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Quantity<span>*</span></label>
                                            <input name="quantity" value="{{ $product->quantity }}" type="number">
                                        </div>
                                        @error('quantity')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group button">
                                            <button type="submit" class="btn2"><a class="btn1">UPDATE</a></button>
                                            <a href="{{ route('user.products.index') }}" type="button"
                                                class="btn1"><span>BACK</span></a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Contact -->
@endsection
