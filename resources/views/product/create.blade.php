@extends('layout.header')

@section('title')
    create
@endsection

@section('content')
    <div class="content">
        <div class="content_header">
            <span>
                <i class='bx bx-barcode-reader'></i>
               Create product
            </span>
            <span class="boxes">
                <button type="button" onclick="history.back();">
                    <i class='bx bxs-chevron-left'></i>
                    back
                </button>
                <a href="#" onclick="document.getElementById('form').submit();">
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
                <form action="{{ route('product_store') }}" method="post" enctype="multipart/form-data" id="form">
                    @csrf
                    <div id="form_basic">
                        <div class="form_input">
                            <label>Name</label>
                            <input type="text" name="name" onchange="product_name(this)">
                            <span class="req">
                                Product name, cannot be longer than 15 characters.
                            </span>
                            <div id="req_count"></div>
                        </div>
                        <div class="form_input">
                            <label>Description</label>
                            <textarea name="description"> </textarea>
                        </div>
                        <div class="form_input">
                            <label>Category</label>
                            <select name="category" id="sel_cat">
                                <option value="">Select...</option>
                                @if(!empty($category))
                                    @foreach($category as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="form_create">
                                <button type="button" class="shows" data-arg='category'>Create Category</button>
                            </div>
                        </div>
                        <div class="form_input">
                            <label>Sku</label>
                            <input type="text" name="sku" onchange="sku_name(this)">
                            <span class="req">
                                Sku, cannot be longer than 10 characters.
                            </span>
                            <div id="req_count1"></div>
                        </div>
                        <div class="form_input">
                            <label>Bin</label>
                            <select name="bin" id="bin_select">
                                <option value="">Select...</option>
                                @if(!empty($category))
                                    @foreach($bin as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="form_create">
                                <button type="button" class="shows" data-arg='bin'>Create Bin</button>
                            </div>
                        </div>
                        <div class="form_input">
                            <label>Uom</label>
                            <select id="uom_select" name="uom">
                                <option value="">Select...</option>
                                <option value="quantity">Quantity</option>
                                <option value="kilogram">Kilogram</option>
                                <option value="box">Box</option>
                            </select>
                        </div>
                        <div class="form_input">
                            <label>Image</label>
                            <label for="img" class="img">
                                <i class='bx bx-upload'></i>
                                Select image
                            </label>
                            <input type="file" style="display: none;" id="img" name="image">
                        </div>
                    </div>

                    <div id="form_attributes">
                        <div class="form_input">
                            <label>weight</label>
                            <input type="number" name="weight">
                        </div>
                        <div class="form_input">
                            <label>width</label>
                            <input type="number" name="width">
                        </div>
                        <div class="form_input">
                            <label>height</label>
                            <input type="number" name="height">
                        </div>
                        <div class="form_input">
                            <label>Color</label>
                            <select name="color" id="color_select">
                                <option value="">Select...</option>
                                @if(!empty($color))
                                    @foreach($color as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="form_create">
                                <button type="button" class="shows" data-arg='color'>Create Color</button>
                            </div>
                        </div>
                        <div class="form_input">
                            <label>Size</label>
                            <select name="size" id="size_select">
                                <option value="">Select...</option>
                                @if(!empty($size))
                                    @foreach($size as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="form_create">
                                <button type="button" class="shows" data-arg='size'>Create Size</button>
                            </div>
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
    <div class="crete" id="category">
        <div class="crete_rel">
            <button type="button" class="close" onclick="document.getElementById('category').style.display = 'none'">
                <i class='bx bx-x'></i>
            </button>
            <div class="create_header">
                Create New Category
            </div>
            <div class="create_form_input">
                <label>Name</label>
                <input type="text" class="category_input">
            </div>
            <div class="create_form_input">
                <label>Description</label>
                <textarea class="category_textarea"></textarea>
            </div>
            <button type="button" id="submit">Create</button>
        </div>
    </div>
    <div class="crete" id="bin">
        <div class="crete_rel">
            <button type="button" class="close" onclick="document.getElementById('bin').style.display = 'none'">
                <i class='bx bx-x'></i>
            </button>
            <div class="create_header">
                Create New Bin
            </div>
            <div class="create_form_input">
                <label>Name</label>
                <input type="text" class="bin_input">
            </div>

            <button type="button" id="submit_bin">Create</button>
        </div>
    </div>
    <div class="crete" id="color">
        <div class="crete_rel">
            <button type="button" class="close" onclick="document.getElementById('color').style.display = 'none'">
                <i class='bx bx-x'></i>
            </button>
            <div class="create_header">
                Create New Color
            </div>
            <div class="create_form_input">
                <label>name</label>
                <input type="text" class="color_name">
            </div>
            <div class="create_form_input">
                <label>Html code</label>
                <input type="color" class="color_code">
            </div>

            <button type="button" id="submit_color">Create</button>
        </div>
    </div>

    <div class="crete" id="size">
        <div class="crete_rel">
            <button type="button" class="close" onclick="document.getElementById('size').style.display = 'none'">
                <i class='bx bx-x'></i>
            </button>
            <div class="create_header">
                Create New size
            </div>
            <div class="create_form_input">
                <label>name</label>
                <input type="number" class="size_name">
            </div>
            <button type="button" id="submit_size">Create</button>
        </div>
    </div>
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

