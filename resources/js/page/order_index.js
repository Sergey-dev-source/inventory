import axios from "axios";

let sort = 'id';
let sort_i = 'ASC';
let channels_id = '';

let getOrder = () => {
    let url = `/order/getOrder?sort=${sort}&sort_i=${sort_i}`;
    if (channels_id !== '') {
        url = url + `&channels_id=${channels_id}`
    }
    axios.get(url)

    .then((r) => {
        setOrder(r.data);
    })
}

let setOrder = data => {
    let element = '';
    if (data.length > 0) {
        data.forEach(item => {
            element += `
        <tr>
            <td class="border">
                ${item.id}
            </td>
            <td class="border">
                ${item.customer}
            </td>
            <td class="border">
                ${item.channels}
            </td>
            <td class="border">
                ${item.users}
            </td>
            <td class="border">
                
            </td>
            <td class="border">
                <div class='more' style="margin: auto"> 
                    <div class='p_ic'>
                        <i class='bx bx-dots-horizontal-rounded'></i>
                    </div>
                    <div class='p_abs' >
                        <ul>
                            <li >
                                <a href='/order/detail/${item.id}' >
                                    <i class='bx bx-search-alt'></i>
                                    Details
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </td>
        </tr>
        `

        });
    } else {
        element = `
        <tr>
            <td colspan = '6' class="border">
                nout result 
            </td>
        </tr>
        `
    }
    document.querySelector('#order').innerHTML = element;
}

document.querySelectorAll('.ord').forEach(item => {
    let sort = item.getAttribute('data-sort');
    item.addEventListener('click', () => orderSort(sort))
})

let orderSort = e => {
    sort = e;
    if (sort_i == 'ASC') {
        sort_i = 'DESC';
    } else {
        sort_i = 'ASC';
    }
    getOrder();
}

document.querySelector('#filter_channal').addEventListener('change', (e) => {
    channels_id = e.target.value;
    getOrder();
})

getOrder()