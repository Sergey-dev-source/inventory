@extends('layout.header')

@section('title')
    create
@endsection

@section('content')
    <div class="content">
        <div class="content_header" style="background-color: #555;">
            <span class="text-white">
                <i class='bx bx-cart-alt'></i>
                Add New  Order
            </span>
            <span class="boxes">
                <button type="button" class="btn btn-success text-white" onclick="history.back();">
                    <i class='bx bxs-chevron-left'></i>
                    back
                </button>
                <a href="#" class="btn btn-success" onclick="document.getElementById('order_create').submit();">
                    <i class='bx bx-chevron-down'></i>
                    save
                </a>
            </span>
        </div>
        <div class="content_body">
            <form action="" method="post" id="order_create">
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
                                <label for="channel">
                                    Sales channel:
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="channel" id="channel" class="form-control">
                                    <option value="">Select channel</option>
                                    @if (!empty($channel))
                                        @foreach ($channel as $item)
                                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                        @endforeach                                        
                                    @endif
                                </select>
                                <div>
                                    <button type="button" class="btn btn-primary text-white" style="font-size: 10px" data-toggle="modal" data-target="#create_channel">
                                        Create Channel
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="costs">Shipping Costs (AFN):</label>
                                <input type="number" name="costs" id="costs" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="req_date">Requested Date:</label>
                                <input  name="req_date" id="req_date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="remarks">Remarks:</label>
                                <textarea  name="remarks" id="remarks" class="form-control" rows="5"> </textarea>
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
                        <div class="p-3 w-75">
                            <div class="form-group">
                                <label for="customer">
                                    Customer Name:
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="customer" id="customer" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="customer">Email: </label>
                                <input type="text" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="street">Street Address:</label>
                                <input type="text" name="street" id="street" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="city">City:</label>
                                <input type="text" name="city" id="city" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="zip">Zip:</label>
                                <input type="text" name="zip" id="zip" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="countries">Countries:</label>
                                <select name="countries" id="countries" class="form-control">
                                    <option value="">Select countries</option>
                                    @foreach ($countries as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group province">
                                <label for="province">State/Province:</label>
                                <input type="text" name="province" id="province" class="form-control">
                            </div>
                            <div class="form-group state">
                                <label for="state" >
                                    State (US Only): 
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="state" id="state" class="form-control"></select>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number:</label>
                                <input type="text" id="phone" name="phone" class="form-control" >
                            </div>
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
<script>
    
    $('#req_date').datetimepicker({
        uiLibrary: 'bootstrap4',
        modal: true,
        footer: true,
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd HH:MM:ss' 
    });
</script>
    <script src="{{ asset('js/page/order.js') }}"></script>
@endsection
