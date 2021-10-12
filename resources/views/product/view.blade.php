@extends('layout.header')

@section('title')view @endsection
@section('content')
    <div class="content">
        <div class="content_header">
            <span>
                <i class='bx bx-barcode-reader'></i>
                Product list
            </span>
            <span>
                <button type="button" class="btn btn-success"  onclick="history.back();">
                    <i class='bx bxs-chevron-left'></i>
                    Back
                </button>
            </span>
        </div>
        <div class="content_inner">
            <div class="product_image">
                <div class="product_image_header">
                    <i class='bx bx-camera'></i>
                    Product Image
                </div>
                <div class="product_image_body">
                    @if(!empty($product['image']))
                        <img src="{{ asset('images/product/'.$product['image']) }}" alt="">
                    @else
                        <img src="{{ asset('images/imagecomingsoon_4.jpg') }}" alt="">
                        <div class="upl_pr">
                            <label for="upl_pr">
                                <i class='bx bx-upload'></i>
                                Upload image
                            </label>
                            <input type="file"  id="upl_pr" data-arg="{{ $product['id'] }}" style="display: none">
                        </div>
                    @endif
                </div>

            </div>
            <div class="product_barcode">
                {!! DNS2D::getBarcodeHTML($product['sku'], 'QRCODE'); !!}
            </div>
        </div>
        <div class="content_body">
            <div class="view">
                <div class="view_title">Name</div>
                <div class="view_value">{{ $product['name'] }}</div>
            </div>
            <div class="view">
                <div class="view_title">Description</div>
                <div class="view_value">{{ $product['description'] }}</div>
            </div>
            <div class="view">
                <div class="view_title">Category</div>
                <div class="view_value">{{ $product['category'] }}</div>
            </div>
            <div class="view">
                <div class="view_title">Sku</div>
                <div class="view_value">{{ $product['sku'] }}</div>
            </div>
            <div class="view">
                <div class="view_title">Bin</div>
                <div class="view_value">{{ $product['bin'] }}</div>
            </div>
            <div class="view">
                <div class="view_title">Uom</div>
                <div class="view_value">{{ $product['uom'] }}</div>
            </div>
            <div class="view">
                <div class="view_title">Weight</div>
                <div class="view_value">{{ $product['weight'] }}</div>
            </div>
            <div class="view">
                <div class="view_title">Width</div>
                <div class="view_value">{{ $product['width'] }}</div>
            </div>
            <div class="view">
                <div class="view_title">Color</div>
                <div class="view_value">{{ $product['Color'] }}</div>
            </div>
            <div class="view">
                <div class="view_title">Size</div>
                <div class="view_value">{{ $product['sizes'] }}</div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/page/product_index.js') }}"></script>
@endsection
