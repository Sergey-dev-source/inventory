@extends('layout.header')

@section('title')
    Inventory
@endsection

@section('content')

    <div class="content">
        <div class="content_header bg-danger">
            <span class="text-white">
                <i class='bx bx-at'></i>
                Locations
            </span>
            <span style="position: relative">
                <button type="button" class="btn  text-white" style="background-color: #666" onclick="history.back();">
                    <i class='bx bxs-chevron-left'></i>
                    back
                </button>
            </span>
        </div>

        <div class="content_body">
            <table id="locations">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>status</th>
                        <th>actions</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>

@endsection
@section('scripts')
    <script>
        let id = 0;
    </script>
    <script src="{{ asset('js/page/inventory.js') }}"></script>
@endsection


<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('inventory.create') }}" method="post" id="inv_product">
                    @csrf
                    <div class="form-group">
                        <label for="pr"> Product</label>
                        <select class="custom-select" id="pr" name="product">
                            <option value="">Select Product</option>
                            @if(!empty($product))
                                @foreach($product as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="loc">Location</label>
                        <select class="custom-select" name="location" id="loc">
                            <option value="">Select Location</option>
                            @if(!empty($location))
                                @foreach($location as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cou">Count</label>
                        <input type="number" id="cou" name="count" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('inv_product').submit()">Save</button>
            </div>
        </div>
    </div>
</div>
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

    
@endsection
