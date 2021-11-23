import axios from "axios";
get_product();

function get_product() {
    axios.get('/ordersline/getproduct')
        .then((response) => {
            set_product(response.data);
        })
}

let set_product = data => {
    let element = '';
    data.forEach(item => {
        element += `
            <option value='${item.product.id}' ${(item.count === 0) ? 'disabled' : ''}>${item.product.name}</option>
        `;
    });
    document.getElementById('orderline_product').innerHTML += element;
}

document.getElementById('orderline_product').addEventListener('change', e => {
    let id = e.target.value;
    axios.get(`/ordersline/getlocation/${id}`)
        .then((response) => {
            setLocation(response.data);
        })
})

let setLocation = data => {
    let element = '<option value="">Select location</option>';
    data.forEach(item => {
        element += `
            <option value='${item.warehouse.id}' >${item.warehouse.name}</option>
        `;
    });
    document.getElementById('orderline_location').innerHTML = element;
}

let id = document.getElementById('order_id').value;
document.querySelectorAll('.orders_line_save').forEach(item => {
    item.addEventListener('click', e => {
        let user_id = document.getElementById('order_user').value;
        let product = document.getElementById('orderline_product').value;
        let location = document.getElementById('orderline_location').value;
        let qty = document.getElementById('orderline_qty').value;
        let price = document.getElementById('orderline_price').value;
        let remarks = document.getElementById('orderline_remarks').value;
        axios.post('/ordersLine/store', {
                id: id,
                user_id: user_id,
                product: product,
                location: location,
                qty: qty,
                price: price,
                remarks: remarks
            }, {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then((response) => {
                document.getElementById('orderline_product_error').innerHTML = '';
                document.getElementById('orderline_location_error').innerHTML = '';
                document.getElementById('orderline_qty_error').innerHTML = '';
                document.getElementById('orderline_price_error').innerHTML = '';
                if (response.data.action === 'error') {

                    let error = response.data.msg;
                    if (error.product !== undefined) {
                        document.getElementById('orderline_product_error').innerHTML = `<div class='bg-danger text-white p-1'>${error.product[0]}</div>`;
                    }
                    if (error.location !== undefined) {
                        document.getElementById('orderline_location_error').innerHTML = `<div class='bg-danger text-white p-1'>${error.location[0]}</div>`;
                    }
                    if (error.qty.length !== undefined) {
                        document.getElementById('orderline_qty_error').innerHTML = `<div class='bg-danger text-white p-1'>${error.qty[0]}</div>`;
                    }
                    if (error.price.length !== undefined) {
                        document.getElementById('orderline_price_error').innerHTML = `<div class='bg-danger text-white p-1'>${error.price[0]}</div>`;
                    }
                } else if (response.data.action === 'success') {
                    document.getElementById('orderline_product').value = '';
                    document.getElementById('orderline_location').value = '';
                    document.getElementById('orderline_qty').value = '';
                    document.getElementById('orderline_price').value = '';
                    document.getElementById('orderline_remarks').value = '';

                    let ordersLine = response.data.msg;

                    let element = `
                        <tr>
                            <td>${ordersLine.product}</td>
                            <td>${ordersLine.location}</td>
                            <td>${ordersLine.count}</td>
                            <td>${ordersLine.price}</td>
                            <td>${(ordersLine.commet!==null)? ordersLine.commet : ''}</td>
                        </tr>
                    `;
                    document.getElementById('result').innerHTML += element
                    let element_order = `
                        <tr>
                            <td> ${ordersLine.product}</td>
                            <td> ${ordersLine.location}</td>
                            <td>${ordersLine.count}</td>
                            <td>${ordersLine.price}</td>
                            <td>${ordersLine.total}</td>
                            <td>${(ordersLine.commet!==null) ? ordersLine.commet : ''}</td>
                            <td><button type="button" class="btn btn-danger">Delete</button></td>
                        </tr>
                    `;
                    document.getElementById('order_tbody').innerHTML += element_order
                    let tot = document.getElementById('tot').innerText;
                    let sum = Number(tot) + ordersLine.total;
                    document.getElementById('tot').innerText = sum;
                    if (e.target.getAttribute('data-types') !== null) {
                        document.querySelector('.orders_line_abs').style.display = 'none';
                        document.getElementById('result').innerHTML = '';
                    }
                }

            })
            .catch(error => {
                // console.log(error.response.data);
            })
    })
})

document.querySelectorAll('.delete_order').forEach(item => {
    item.addEventListener('click', e => {
        let id = e.target.getAttribute('data-id')
        axios.post('/ordersLine/destroy', { id: id })
            .then((response) => {
                if (response.data.action === 'success') {
                    window.location.reload()
                }
            })
    })
})