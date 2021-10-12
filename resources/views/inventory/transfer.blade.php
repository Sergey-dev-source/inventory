@extends('layout.header')

@section('title')
    Inventory
@endsection

@section('content')
    <div class="content">
        <div class="content_header">
            <span>
                <i class='bx bx-barcode-reader'></i>
                Inventory transfer
            </span>
            <span style="position: relative">
               <button type="button" class="btn btn-success" onclick="history.back();">
                    <i class="bx bxs-chevron-left"></i>
                    Back
                </button>

            </span>
        </div>
        <div class="content_body">
            <div class="row">
                <div class="col-md-3">
                    <form action="{{ route('inventory.save.transfer') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Inventory Product</label>
                            <select class="form-control" name="product">
                                <option value="{{ $inventory['product']['id'] }}">
                                    {{ $inventory['product']['name'] }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Location from</label>
                            <select class="form-control" name="location_from">
                                <option value="{{ $inventory['warehouse']['id'] }}">
                                    {{ $inventory['warehouse']['name'] }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Available count</label>
                            <div  class="p-1 text-center bg-success text-white" style="width: 10%;border-radius: 7px;">{{ $inventory['count'] }}</div>
                        </div>
                        <div class="form-group">
                            <label>Location to</label>
                            <select class="form-control" name="location_to">
                                <option value="">Select location</option>
                                @foreach($location as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Count</label>
                            <input type="number" class="form-control" name="qount">
                        </div>
                        <button class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/page/inventory.js') }}"></script>
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
            <div class="warn_close" onclick="document.getElementById('error').style.display = 'none'">
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
            <div class="warn_close" onclick="document.getElementById('success').style.display = 'none'">
                <i class='bx bx-x'></i>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div id="error">
            <div class="warn_icon">
                <i class='bx bxs-error-alt'></i>
            </div>
            <div class="warn_text">
                <div>{{session('error')}}</div>
            </div>
            <div class="warn_close" onclick="document.getElementById('success').style.display = 'none'">
                <i class='bx bx-x'></i>
            </div>
        </div>
    @endif
@endsection
