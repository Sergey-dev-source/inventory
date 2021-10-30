@extends('layout.header')

@section('title')
    create
@endsection

@section('content')
    <div class="content">
        <div class="content_header">
            <span>
                <i class='bx bx-barcode-reader'></i>
                Add New  Order
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
        <form action="{{ route('product_store') }}" method="post" enctype="multipart/form-data" id="form">
            @csrf 
            <div class="container-fluid" style="box-shadow: 0 3px 6px rgb(0 0 0 / 16%), 0 3px 6px rgb(0 0 0 / 22%);">
                <div class="row">
                    <div class="" style='padding: 0'>
                        <div class="w-100 pt-2 pb-2 bg-secondary">
                            <h3></h3>
                        </div>
                    </div>
                    <div class="" style='padding: 0'>
                        <div class="w-100 pt-2 pb-2 bg-info"></div>
                    </div>                 
                
                </div>  
            </div>
        </form>
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
    
@endsection
