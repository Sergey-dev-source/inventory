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
        <div class="content_body">
            <form action="{{ route('product_store') }}" method="post" enctype="multipart/form-data" id="form">
                @csrf 
                <div class="d-flex justify-content-around ">
                    <div class="" style='padding: 0;width: 49%; box-shadow: 0 3px 6px rgb(0 0 0 / 16%), 0 3px 6px rgb(0 0 0 / 22%);'>
                        <div class="w-100 pt-2 pb-2 bg-secondary">
                            <span class="text-white p-3">
                                <i class='bx bx-cog'></i>
                                Order details
                            </span>
                        </div>
                        <div class="p-3 w-75">
                            <div class="form-group">
                                <label for="reference">Reference Order:</label>
                                <input type="text" id="reference" name="reference" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="additional">Additional Reference Order:</label>
                                <input type="text" id="reference" name="additional" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="channel">Sales channel</label>
                                <select name="channel" id="channel" class="form-control">
                                    <option value="">Select channel</option>
                                    @if (!empty($channel))
                                        @foreach ($channel as $item)
                                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                        @endforeach                                        
                                    @endif
                                </select>
                                <div>
                                    <button type="button" class="btn btn-success" style="font-size: 10px" data-toggle="modal" data-target="#create_channel">
                                        Create Channel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="" style='padding: 0;width: 49%; box-shadow: 0 3px 6px rgb(0 0 0 / 16%), 0 3px 6px rgb(0 0 0 / 22%);'>
                        <div class="w-100 pt-2 pb-2 bg-secondary">
                            <span class="text-white p-3">
                                <i class='bx bxs-truck'></i>
                                Shipping Address
                            </span>
                        </div>
                    </div>                 
                
                </div>  
            
            </form>
        </div>
    </div>
@endsection
@section('abs')
<div class="modal fade" id="create_channel" tabindex="-1" role="dialog" aria-labelledby="create_channelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="create_channelLabel">Create sale channel</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="chanal_name">Name</label>
                <input type="text" id="chanal_name" name="chanal_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="chanal_description">Description:</label>
                <input type="text" id="chanal_description" name="chanal_description" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="save_channel">Save </button>
        </div>
      </div>
    </div>
  </div>
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
    <script src="{{ asset('js/page/order.js') }}"></script>
@endsection
