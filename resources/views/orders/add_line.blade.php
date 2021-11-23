<div class = "orders_line_rel">
    <div class="orders_line_title">
        <span>
            <i class='bx bx-cart'></i>
            Add Order > Line  Order # {{ $order['id'] }}  
        </span>
        <span class="orders_line_close">
            <i class='bx bx-x' ></i>
        </span>
    </div>
    <div class="orders_line_body">
        <div class="w-100 ">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product <span class="text-danger">*</span></th>
                        <th>Location <span class="text-danger">*</span></th>
                        <th>Qty <span class="text-danger">*</span></th>
                        <th>Unit price <span class="text-danger">*</span></th>
                        <th>Remarks</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>    
                            <input type="hidden" id="order_id" value="{{ $order['id'] }}">
                            <input type="hidden" id="order_user" value="{{ $order['channels_user'] }}">
                            <select class="form-control" id="orderline_product">
                                <option value="">Select product</option>
                            </select>
                            <div id="orderline_product_error"></div>
                        </td>
                        <td>
                            <select class="form-control" id="orderline_location">
                                <option value="">Select location</option>
                            </select>
                            <div id="orderline_location_error"></div>
                        </td>
                        <td>
                            <input type="number" class="form-control" id="orderline_qty">
                            <div id="orderline_qty_error"></div>
                        </td>
                        <td>
                            <input type="number" class="form-control" id="orderline_price">
                            <div id="orderline_price_error"></div>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="orderline_remarks">
                        </td>
                        <td>
                            <button type="button" class="btn btn-success orders_line_save" >
                                <i class='bx bx-plus-medical' ></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table id="result" class="table"></table>
            <div class="orderLineTotal">
                <div>Totals</div>
                <div><span id="tot">{{ $totals }}</span>({{ $curency['symbol'] }})</div>
            </div>
            <div class="orderLineSave">
                <button type="button" class="btn btn-warning orders_line_save" >Save&Another</button>
                <button type="button" class="btn btn-success orders_line_save" data-types="true">Save&close</button>
                <button type="button" class="btn btn-danger orders_line_close">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/page/order_line.js') }}"></script>