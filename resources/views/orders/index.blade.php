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
    <div class="content_body" style="padding: 5px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="p-5">
                        <label>Filter by: </label>
                        <select class="custom-select" style="width: 50%" id="filter_channal">
                            <option value="">Select channel</option>
                            @foreach ($channel as $item)
                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <table  class="table text-center" >
            <thead>
                <thead >
                   <tr class="border">
                    <th class="border">
                        <a class = 'ord' data-sort = 'id'>
                            Order:
                            <i class='bx bxs-sort-alt'></i>
                        </a>
                    </th>
                    <th class="border">
                        <a class = 'ord' data-sort = 'customer'>
                            Custommer
                            <i class='bx bxs-sort-alt'></i>
                        </a>
                    </th>
                    <th class="border">
                        <a class='ord' data-sort = 'channels'>
                            channel
                            <i class='bx bxs-sort-alt'></i>
                        </a>
                    </th>
                    <th class="border">
                        <a class = 'ord' data-sort = 'users'>
                            created by
                            <i class='bx bxs-sort-alt'></i>
                        </a>
                    </th>
                    <th class="border">
                        status
                        <i class='bx bxs-sort-alt'></i>
                    </th>
                    <th class="border">
                        action
                    </th>
                   </tr>
                </thead>
                <tbody id="order">

                </tbody>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/page/order_index.js') }}"></script>
@endsection