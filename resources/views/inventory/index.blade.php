@extends('layout.header')

@section('title')
    Inventory
@endsection

@section('content')

    <div class="content">
        <div class="content_header">
            <span>
                <i class='bx bx-barcode-reader'></i>
                Inventory list
            </span>
            <span style="position: relative">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                    <i class='bx bx-plus'></i>
                    Add Inventory Location
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Location</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="locform" method="post" action="{{ route('location.create') }}">
                                    @csrf
                                      <div class="form-group">
                                            <label for="nam">Name</label>
                                            <input type="email" name="name" class="form-control" id="nam" >
                                      </div>
                                      <div class="form-check">
                                          <input type="checkbox" name="status" checked class="form-check-input" id="status" value="1">
                                          <label class="form-check-label" for="status">Status</label>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="document.getElementById('locform').submit()">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                 <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
                         aria-expanded="false" aria-controls="collapseExample">
                       <i class='bx bx-dots-horizontal-rounded'></i>
                </button>
                <div class="collapse" id="collapseExample" style="z-index: 9999">
                    <div class="list-group">
                        <button type="button" class="list-group-item list-group-item-action" data-toggle="modal"
                                data-target="#exampleModal1">
                            <i class='bx bx-plus'></i>
                            Add Invetory Product
                        </button>

                    
                        <a href="{{ route('location.index') }}" class="list-group-item list-group-item-action">
                            <i class='bx bx-at'></i>
                            Manage Locations
                        </a>
                    </div>
                </div>
            </span>
        </div>

        <div class="content_body">
            <table id="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Sku</th>
                    <th>Product name</th>
                    <th>Warehouse name</th>
                    <th>Count</th>
                    <th>Last Trans.</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>

        </div>
    </div>
    <!-- Modal -->

@endsection
@section('scripts')
    <script>
        let id = {{ (isset($id)) ? $id : 0 }};
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
@csrf
@include('inventory.ajax')
