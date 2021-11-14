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