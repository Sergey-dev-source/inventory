@extends('layout.header')

@section('title')
    create
@endsection

@section('content')
<?php $x = 'ok'; ?>
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
            <div class="d-flex justify-content-around ">
                <div class="" style='padding: 0;width: 49%; box-shadow: 0 3px 6px rgb(0 0 0 / 16%), 0 3px 6px rgb(0 0 0 / 22%);'>
                    <div class="w-100 pt-2 pb-2" style="background-color: #f3c200">
                        <span class="text-white p-3">
                            <i class='bx bx-cog'></i>
                            Order details
                        </span>
                    </div>
                    <div class="p-3">
                        <div class="row mt-2">
                            <div class="col-md-6">Order #:</div>
                            <div class="col-md-6">{{ $order['id'] }}</div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">Order Date & Time:</div>
                            <div class="col-md-6">{{ $create_order}}</div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">Reference Order:</div>
                            <div class="col-md-6">{{ $order['reference']}}</div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">Additional Reference Order:</div>
                            <div class="col-md-6">{{ $order['additional']}}</div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">Sales Channel:</div>
                            <div class="col-md-6">{{ $order['channels']}}</div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">Shipping Costs ({{ $curency['name'] }}):</div>
                            <div class="col-md-6">{{ $order['costs']}}</div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">Requested Date:</div>
                            <div class="col-md-6">{{ $requestedDate}}</div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">Remarks:</div>
                            <div class="col-md-6">{{ $order['remarks']}}</div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">Order status:</div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                </div>
                <div class="" style='padding: 0;width: 49%; box-shadow: 0 3px 6px rgb(0 0 0 / 16%), 0 3px 6px rgb(0 0 0 / 22%);'>
                    <div class="w-100 pt-2 pb-2 " style="background-color: #e26a6a">
                        <span class="text-white p-3">
                            <i class='bx bxs-truck'></i>
                            Shipping Address
                        </span>
                    </div>
                    <div class="p-3 w-75">
                        <div class="row mt-2">
                            <div class="col-md-6">Customer:</div>
                            <div class="col-md-6">{{ $order['customer'] }}</div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">Email:</div>
                            <div class="col-md-6">{{ $order['email'] }}</div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">Address:</div>
                            <div class="col-md-6">{{ $order['street'] }}</div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">City:</div>
                            <div class="col-md-6">{{ $order['city'] }}</div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">Zip:</div>
                            <div class="col-md-6">{{ $order['zip'] }}</div>
                        </div>
                        @if (!empty($order['usa_states']))
                            <div class="row mt-2">
                                <div class="col-md-6">State:</div>
                                <div class="col-md-6">{{ $order['usa_states'] }}</div>
                            </div>
                        @else
                            <div class="row mt-2">
                                <div class="col-md-6">State/Province:</div>
                                <div class="col-md-6">{{ $order['state_provincy'] }}</div>
                            </div>
                        @endif
                        <div class="row mt-2">
                            <div class="col-md-6">Country:</div>
                            <div class="col-md-6">{{ $order['country'] }}</div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">Phone:</div>
                            <div class="col-md-6">{{ $order['Phone'] }}</div>
                        </div>
                    </div>
                </div>                 
            </div>  
            <div class="mt-4 w-100 p-2">
                <div class="w-100 bg-danger p-2 pl-5 pr-5 align-items-center text-white d-flex justify-content-between">
                    <span>
                        <i class="bx bx-cog"></i>
                        Order line
                    </span>
                    <button type="button" id="addLine" class="btn btn-success ">Add line</button>
                </div>
                <div class="w-100">
                    <table class="table">
                        <thead>
                            <th>Product</th>
                            <th>Location</th>
                            <th>Qty</th>
                            <th>Price ({{ $curency['symbol'] }})</th>
                            <th>Total</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </thead>
                        <tbody id="order_tbody">
                            @if (!empty($orderLine))
                                @foreach ($orderLine as $item)
                                    <tr>
                                        <td>{{ $item['product'] }}</td>
                                        <td>{{ $item['location'] }}</td>
                                        <td>{{ $item['count'] }}</td>
                                        <td>{{ $item['price'] }}</td>
                                        <td>{{ $item['total'] }}</td>
                                        <td>{{ $item['commet'] }}</td>
                                        <td><button type="button" data-id="{{ $item['id'] }}" class="btn btn-danger delete_order">Delete</button></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('abs')
    <div class="orders_line_abs">
        @include('orders.add_line')
    </div>
@endsection

@section('scripts')
<script src="{{ asset('js/page/order_line.js') }}"></script> 
    <script>
        let checks = '{{ $status_orderline }}';
        
        $(function (){
            if(checks === 'order'){
                
                setTimeout(() => {
                    $('.orders_line_abs').show()    
                },500 );
            }
            $('#addLine').on('click',function() {
                $('.orders_line_abs').show()
            })
            $('.orders_line_close').on('click',function() {
                $('.orders_line_abs').hide()
            })
        })
    </script>
@endsection
