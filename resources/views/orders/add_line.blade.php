<div class = "orders_line_rel">
    <div class="orders_line_title">
        <span>
            <i class='bx bx-cart'></i>
            Add Order > Line  Order #
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
                            <select class="form-control" id="orderline_product">
                                <option value="">Select product</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-control" id="orderline_location">
                                <option value="">Select location</option>
                            </select>
                        </td>
                        <td>
                            <input type="number" class="form-control" id="orderline_qty">
                        </td>
                        <td>
                            <input type="number" class="form-control" id="orderline_price">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="orderline_remarks">
                        </td>
                        <td>
                            <button type="button" id="orders_line_save" class="btn btn-success">
                                <i class='bx bx-plus-medical' ></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="orderLineTotal">
                
            </div>
            <div class="orderLineSave">
                <button type="button" class="btn btn-warning">Save&Another</button>
                <button type="button" class="btn btn-success">Save&close</button>
                <button type="button" class="btn btn-danger orders_line_close">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/page/order_line.js') }}"></script>