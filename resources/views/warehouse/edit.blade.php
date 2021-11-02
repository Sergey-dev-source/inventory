@extends('layout.header')

@section('title')
    create
@endsection

@section('content')
    <div class="content">
        <div class="content_header" style="background-color: #555;">
            <span class="text-white">
                <i class='bx bx-cart-alt'></i>
                Edit Location
            </span>
            <span class="boxes">
                <button type="button" class="btn btn-success text-white" onclick="history.back();">
                    <i class='bx bxs-chevron-left'></i>
                    back
                </button>
                <a href="#" class="btn btn-success" onclick="document.getElementById('warehouse').submit();">
                    <i class='bx bx-chevron-down'></i>
                    save
                </a>
            </span>
        </div>
        <div class="content_body">
            <form action="{{ route('location.update') }}" method="post" id="warehouse">
                @csrf 
                <input type="hidden" id="id" name="id" value="{{ $warehouse['id'] }}" class="form-control">
                <div class="">
                    <div class="" style='padding: 0;width: 49%; box-shadow: 0 3px 6px rgb(0 0 0 / 16%), 0 3px 6px rgb(0 0 0 / 22%);'>
                        <div class="w-100 pt-2 pb-2 bg-secondary">
                            <span class="text-white p-3">
                                <i class='bx bx-cog'></i>
                                Details
                            </span>
                        </div>
                        <div class="p-3 w-75">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name" value="{{ $warehouse['name'] }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <input type="checkbox" id="status" {{ ($warehouse['status'] === 1) ? "checked" : "" }} name="status" value="1">
                            </div>
                        </div>
                    </div>            
                
                </div>  
            
            </form>
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
@endsection
