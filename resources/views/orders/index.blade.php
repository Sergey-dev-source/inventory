@extends('layout.header')

@section('title')Orders @endsection

@section('content')
<div class="content">
    <div class="content_header">
        <span class="text-white">
            <i class='bx bxs-cart'></i> 
            Order list
        </span>
        <span>
            <a href="{{route('orders.create')}}" class="btn btn-success ">
                <i class='bx bx-plus'></i>
                Add New order
            </a>
        </span>
    </div>
    <div class="content_body">
        <table id="order_table">
            <thead>
                <thead>
                    <th>
                        Order:
                    </th>
                    <th>
                        Custommer
                    </th>
                    
                </thead>
            </thead>
        </table>
    </div>
</div>
@endsection