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
                <button type="button" class="btn btn-success" onclick="history.back();">
                    <i class='bx bxs-chevron-left'></i>
                    back
                </button>
                <a href="#" class="btn btn-success" onclick="document.getElementById('form').submit();">
                    <i class='bx bx-chevron-down'></i>
                    save
                </a>
            </span>
        </div>
        <div class="content_body">
            <div>
                <form action="{{ route('product_store') }}" method="post" enctype="multipart/form-data" id="form">
                    @csrf
                   

                   
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
