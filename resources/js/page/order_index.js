import axios from "axios";

let sort = 'id';
let sort_i = 'ASC';
let getOrder = () => {
    let url = `/order/getOrder?sort=${sort}&sort_i=${sort_i}`;

    axios.get(url)

    .then((r) => {
            console.log(r)
            setOrder(r.data);
        })
        .catch((error) => {
            // console.log(error)
        })
}

let setOrder = data => {
    let element = '';
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
                action
            </td>
        </tr>
        `
        document.querySelector('#order').innerHTML = element;
    });
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

getOrder()