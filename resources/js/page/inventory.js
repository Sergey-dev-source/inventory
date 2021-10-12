
$(document).ready( function () {
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/inventory/filter',

        columns: [
            {
                data: 'id',
                name: 'id',
            },
            {
                data: 'product.sku',
                name: 'product.sku',
            },
            {
                data: 'product.name',
                name: 'product.name',
            },
            {
                data: 'warehouse.name',
                name: 'warehouse.name',
            },
            {
                data: 'count',
                name: 'count',
                render: function( data, type, full, meta ) {
                    let color = '';
                    if (data <= 30) {
                        color = 'bg-danger';
                    } else if (data <= 60) {
                            color = 'bg-warning';
                    } else {
                        color = 'bg-success';
                    }
                    return `<div class="${color} text-white w-25 text-center p-2">${data}</div>`;
                }
            },{
                data: 'id',
                name: 'id',
                render: function (data, type, full, meta) {
                    return `<button type="button" data-arg="${data}" value="1" class="btn btn-success text-white" onclick="ed(this)">+1</button>
                <button type="button" data-arg="${data}" value="-1" class="btn btn-danger text-white mi" onclick="ed(this)">-1</button>`
                }
            },{
                data: 'product.id',
                name: 'product.id',
                render: function (data, type, full, metta) {
                    return `
                        <div class='more'>

                                    <div class='p_ic'>
                                        <i class='bx bx-dots-horizontal-rounded'></i>
                                    </div>
                                    <div class='p_abs'>
                                        <ul>
                                            <li>
                                                <a href='/product/view/${data}'>
                                                    <i class='bx bx-search-alt'></i>
                                                    View Product detail
                                                </a>
                                            </li>
                                            <li>
                                                <a href="/inventory/transfer/ ${full.id}">
                                                    <i class='bx bxs-ship'></i>
                                                     Location Transfer
                                                </a>
                                            </li>
                                            <li>
                                                <a href=''>
                                                    <i class='bx bx-trash' ></i>
                                                    Delete Inventory product
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                    `
                }
            },
        ]
    });

} );



