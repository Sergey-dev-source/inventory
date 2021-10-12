@extends('layout.header')

@section('title')
    Product
@endsection

@section('content')
    <div class="content">
        <div class="content_header">
            <span>
                <i class='bx bx-barcode-reader'></i>
                Product list
            </span>
            <span>
                <a href="{{route('product_create')}}">
                    <i class='bx bx-plus'></i>
                    Add New product
                </a>
            </span>
        </div>

        <div class="content_body">
            <table id="table">
                <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th>image</th>
                    <th>Name</th>
                    <th>Sku</th>
                    <th>Uom</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>

        </div>
    </div>

@endsection
@section('scripts')


    <script src="{{ asset('js/page/product_index.js') }}"></script>
    {{--    <script  src="../../js/app.js" ></script>--}}
@endsection



