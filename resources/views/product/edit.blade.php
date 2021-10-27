@extends('layout.header')

@section('title')
    Edit
@endsection

@section('content')
    <div class="content">
        <div class="content_header">
            <span>
                <i class='bx bx-barcode-reader'></i>
               Edit product
            </span>
            <span class="boxes">
                <button type="button" onclick="history.back();">
                    <i class='bx bxs-chevron-left'></i>
                    back
                </button>
                <a href="#" onclick="document.getElementById('upd').submit();" class="btn btn-success ">
                    <i class='bx bx-chevron-down'></i>
                    save
                </a>
            </span>
        </div>
        <div class="content_body">
            <div class="form_list">
                <ul>
                    <li id="select_basic" class="list_active">Basic</li>
                    <li id="select_attributes">Attributes</li>
                </ul>
                <form action="{{ route('product_update') }}" method="post" enctype="multipart/form-data" id="upd">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product['id'] }}">
                    <div id="form_basic">
                        <div class="form_input">
                            <label>Name</label>
                            <input type="text" name="name" value="{{ $product['name'] }}" onchange="product_name(this)">
                            <span class="req">
                                Product name, cannot be longer than 15 characters.
                            </span>
                            <div id="req_count"></div>
                        </div>
                        <div class="form_input">
                            <label>Description</label>
                            <textarea name="description">{{ $product['description'] }}</textarea>
                        </div>
                        <div class="form_input">
                            <label>Category</label>
                            <select name="category" id="sel_cat" >
                                <option value="">Select...</option>
                                @if(!empty($category))
                                    @foreach($category as $item)
                                        <option @if (!empty($product['category'] && $item['name'] == $product['category']))
                                        selected
                                    @endif  value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form_input">
                            <label>Sku</label>
                            <input type="text" name="sku" value="{{ $product['sku'] }}" onchange="sku_name(this)">
                            <span class="req">
                                Sku, cannot be longer than 10 characters.
                            </span>
                            <div id="req_count1"></div>
                        </div>
                        <div class="form_input">
                            <label>Bin</label>
                            <select name="bin" id="bin_select">
                                <option value="">Select...</option>
                                @if(!empty($bin))
                                    @foreach($bin as $item)
                                        <option @if(!empty($product['bin']) && $product['bin'] == $item['name'])selected @endif value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form_input">
                            <label>Uom</label>
                            <select id="uom_select" name="uom" style="text-transform: capitalize">
                                <option value="">Select...</option>
                               @foreach($uom as $i)
                                    <option @if(!empty($product['uom']) && $product['uom'] == $i)selected @endif  value="{{ $i }}">{{ $i }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form_input">
                            <label>Image</label>
                            <label for="img" class="img">
                                <i class='bx bx-upload'></i>
                                Select image
                            </label>
                            <input type="file" accept="image/png, image/gif, image/jpeg, image/jpg " style="display: none;" id="img" name="image">
                        </div>
                    </div>

                    <div id="form_attributes">
                        <div class="form_input">
                            <label>weight</label>
                            <input type="number" value="{{ $product['weight'] }}" name="weight">
                        </div>
                        <div class="form_input">
                            <label>width</label>
                            <input type="number" value="{{ $product['width'] }}" name="width">
                        </div>
                        <div class="form_input">
                            <label>height</label>
                            <input type="number" value="{{ $product['height'] }}" name="height">
                        </div>
                        <div class="form_input">
                            <label>Color</label>
                            <select name="color" id="color_select">
                                <option value="">Select...</option>
                                @if(!empty($color))
                                    @foreach($color as $item)
                                        <option  @if(!empty($product['color']) && $product['color'] == $item['name'])selected @endif value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form_input">
                            <label>Size</label>
                            <select name="size" id="size_select">
                                <option value="">Select...</option>
                                @if(!empty($size))
                                    @foreach($size as $item)
                                        <option  @if(!empty($product['size']) && $product['size'] == $item['name'])selected @endif value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('abs')
    @if($errors->any())
        <div id="error">
            <div class="warn_icon">
                <i class='bx bx-error-alt'></i>
            </div>
            <div class="warn_text">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
            <div class="warn_close" onclick="document.getElementById('error').style.display = 'none'" >
                <i class='bx bx-x'></i>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div id="success">
            <div class="warn_icon">
                <i class='bx bx-check-double'></i>
            </div>
            <div class="warn_text">
                <div>{{session('success')}}</div>
            </div>
            <div class="warn_close" onclick="document.getElementById('success').style.display = 'none'" >
                <i class='bx bx-x'></i>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('js/page/product.js') }}"></script>
@endsection

<script>
    function product_name(e) {
        let length = e.value.length;
        let color = 'green';
        if (length > 15)
            color = 'red'
        document.getElementById('req_count').innerHTML = `<div style="background-color: ${color}">YOU TYPE ${length} OUT OF 15 CHARS AVAILABLE</div>`

    }

    function sku_name(e) {
        let length = e.value.length;
        let color = 'green';
        if (length > 10)
            color = 'red'
        document.getElementById('req_count1').innerHTML = `<div style="background-color: ${color}">YOU TYPE ${length} OUT OF 10 CHARS AVAILABLE</div>`

    }


</script>

